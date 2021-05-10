<?php

function userLogin($link, $username, $password, $email){
    $result = mysqli_resultArray($link, "SELECT * FROM users WHERE username='" .mysqli_real_escape_string($link, $username). "' OR email='" .mysqli_real_escape_string($link, $email). "'")[0];

    if(isset($result['password'])){
        if (password_verify($password, $result['password'])) {
            $auth =& $_SESSION['auth'];
            
            foreach ($result as $key => $value) {
                $auth[$key] = $value;
            }
            
            return;
        } else {
            userLogOut();
            throw new Exception("Wrong password");
        }
    } else {
        userLogOut();
        throw new Exception("User don't found");
    }
}

function userLogOut(){
    $_SESSION = [];
    unset($_COOKIE[session_name()]);
    session_destroy();
    session_start();
}

if(isset($_POST['DOauthorize'])){
    try{
        if(!isset($_SESSION["auth"])){
            userLogin($imgsDB, $_POST['username'], $_POST['password'], $_POST['email']);

            message("Welcome back, ".$_SESSION['auth']['username'], 2, "success");
            header("Location: http://{$_SERVER['SERVER_NAME']}{$_SERVER['SCRIPT_NAME']}");
        } else {
            throw new Exception("Already logged in");
        }
    } catch (Exception $e) {
        message($e->getMessage(), 2, "error");
    }
}

if(isset($_GET['logout'])){
    userLogOut();
    message('Come back soon!', 2);

    header("Location: http://{$_SERVER['SERVER_NAME']}{$_SERVER['SCRIPT_NAME']}");
}   