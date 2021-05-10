<?php 
session_start();
mt_srand(time() + (double)microtime()*1000000 + getmygid());

$imgsDB = mysqli_connect("localhost", "test", "test", "test") or die(mysqli_error($imgsDB));
mysqli_query($imgsDB, "SET NAMES 'utf8'");

function mysqli_resultArray($link, $query){
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    for ($array = []; $row = mysqli_fetch_assoc($result); $array[] = $row);
    return $array;
}

function addPhotoToDB($link, $file, $user="1", $title ="", $description = ""){
    if(!file_exists(realpath($file))) throw new Exception("Can't find image file on the server");
    
    mysqli_query($link, "INSERT INTO img SET path='".mysqli_real_escape_string($link, $file)."', user_id='".mysqli_real_escape_string($link, $user)."', title='".mysqli_real_escape_string($link, $title)."', description='".mysqli_real_escape_string($link, $description)."'");
    if(mysqli_error($link)) throw new Exception(mysqli_error($link));
}

function randomFileName($path, $extension){
    do {
        $name = md5(uniqid() . mt_rand());
        $file = $name . $extension;
    } while (file_exists($path . $file));

    return $file;
}

function saveFile($dirname, $filename, $tempname){
    $pathtodir = realpath($dirname)."\\";
    $fullname = randomFileName($pathtodir , ".".strtolower(substr(strrchr($filename, '.'), 1)));

    move_uploaded_file($tempname, $pathtodir.$fullname);

    if(file_exists($pathtodir.$fullname)){
        return "$dirname/$fullname";
    } else {
        return false;
    }
}

function saveUploadedPhotoToDB($link, $dirname, $filename, $tempname, $user, $title, $description){
    $newfile = saveFile($dirname, $filename, $tempname);
    
    if($newfile != false){
        addPhotoToDB($link, $newfile, $user, $title, $description);
    }

    return $newfile;
}

function deletePhoto($link, $photoId, $hash){
    $user = mysqli_resultArray($link, "SELECT * FROM users WHERE password='".mysqli_real_escape_string($link, $hash)."'")[0];

    if(isset($user['id'])){
        $img = mysqli_resultArray($link, "SELECT * FROM img WHERE id=".mysqli_real_escape_string($link, $photoId))[0];
        
        if($user['status_id'] == 2 || (isset($img['user_id']) && $img['user_id'] == $user['id'])){
            unlink($img['path']);
            mysqli_query($link, "DELETE FROM img WHERE id=".$img['id']);
        } else{
            throw new Exception("Failed to find this image, maybe it already deleted");
        }
    } else{
        throw new Exception("Access denied");
    }
}

function createNewUser($link, $username, $password, $email){
    $user = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM users WHERE username='".mysqli_real_escape_string($link, $username)."' OR password='".mysqli_real_escape_string($link, password_hash($password, PASSWORD_DEFAULT))."' OR email='".mysqli_real_escape_string($link, $email)."'"));
    if (!empty($user)) {
        throw new Exception("Username or email already taken");
    }

    mysqli_query($link, "INSERT INTO users SET username='".mysqli_real_escape_string($link, $username)."', password='".mysqli_real_escape_string($link, password_hash($password, PASSWORD_DEFAULT))."', email='".mysqli_real_escape_string($link, $email)."'");
    if(mysqli_error($link)) throw new Exception(mysqli_error($link));
}

function message($text, $redirectionsBeforeDestroy=1, $type="ordinary"){
    $messages =& $_SESSION['messages'];
    $messages[] = ['text' => $text,'redirections' => $redirectionsBeforeDestroy, 'type' => $type, 'redirections-done' => 0];
}

