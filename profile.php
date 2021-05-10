<?php 
    require_once "assets/model.php";
    require_once "assets/auth.php";

    if(isset($_GET['user'])){
        if(!empty($_GET['user'])){
            $user = mysqli_resultArray($imgsDB, "SELECT * FROM users WHERE id=".$_GET['user'])[0];
        }
        
        if(!empty($user)){
            $main = "profile";

            $imgs = mysqli_resultArray($imgsDB, "SELECT * FROM img WHERE user_id=".$_GET['user']);
        } else{
            $main = "404";
        }
    } else{
        if(isset($_SESSION['auth'])){
            header("Location: http://{$_SERVER['SERVER_NAME']}{$_SERVER['SCRIPT_NAME']}?user=".$_SESSION['auth']['id']);
        } else{
            $main = "404";
        }
    }

    if(isset($_POST['newUsername']) && isset($_SESSION['auth'])){
        if (!empty(mysqli_fetch_assoc(mysqli_query($imgsDB, "SELECT * FROM users WHERE username='".mysqli_real_escape_string($imgsDB, $_POST['newUsername'])."'")))) {
            message("Username already taken", 2, "error");
        } else{ 
            mysqli_query($imgsDB, "UPDATE users SET username='".mysqli_real_escape_string($imgsDB, $_POST['newUsername'])."' WHERE id=".$_SESSION['auth']['id']);

            message("Username successfully updated", 2, "success");
            header("Location: http://{$_SERVER['SERVER_NAME']}{$_SERVER['SCRIPT_NAME']}?user=".$_SESSION['auth']['id']);
        }
    }

    if(isset($_POST['newDescription']) && isset($_SESSION['auth'])){
        mysqli_query($imgsDB, "UPDATE users SET description='".mysqli_real_escape_string($imgsDB, $_POST['newDescription'])."' WHERE id=".$_SESSION['auth']['id']);

        message("Profile description successfully updated", 2, "success");
        header("Location: http://{$_SERVER['SERVER_NAME']}{$_SERVER['SCRIPT_NAME']}?user=".$_SESSION['auth']['id']);
    }

    if(isset($_FILES['newProfilePic']) && isset($_SESSION['auth'])){
        $newPic = saveFile("profile-pics", $_FILES['newProfilePic']['name'], $_FILES['newProfilePic']['tmp_name']);
        $oldPic = mysqli_resultArray($imgsDB, "SELECT `profile-pic` FROM `users` WHERE id = ".$_SESSION['auth']['id'])[0]['profile-pic'];

        if($newPic != false){
            mysqli_query($imgsDB, "UPDATE `users` SET `profile-pic` = '".mysqli_real_escape_string($imgsDB, $newPic)."' WHERE id = ".$_SESSION['auth']['id']);
            
            if(!mysqli_error($imgsDB) && $oldPic != "profile-pics/default-picture.jpg" && $oldPic != "profile-pics/admin.jpg"){
                unlink($oldPic);
            }
        }

        message("Profile picture successfully updated", 2, "success");
        header("Location: http://{$_SERVER['SERVER_NAME']}{$_SERVER['SCRIPT_NAME']}?user=".$_SESSION['auth']['id']);
    }

    if(isset($_POST['DOsettings']) && isset($_SESSION['auth'])){
        $updatedUser = mysqli_resultArray($imgsDB, "SELECT * FROM `users` WHERE id = ".$_SESSION['auth']['id'])[0];

        if(trim($updatedUser['email']) != trim($_POST['newEmail'])){
            if (empty(mysqli_fetch_assoc(mysqli_query($imgsDB, "SELECT * FROM users WHERE email='".mysqli_real_escape_string($imgsDB, $_POST['newEmail'])."'")))) {
                mysqli_query($imgsDB, "UPDATE `users` SET `email` = '".mysqli_real_escape_string($imgsDB, $_POST['newEmail'])."' WHERE id = ".$_SESSION['auth']['id']);

                message("Email successfully updated", 2, "success");
            } else{
                message("Email already taken", 2, "error");
            }
        }

        if(!empty($_POST['OldPassword']) && !empty($_POST['NewPassword'])){
            if(password_verify($_POST['OldPassword'], $updatedUser['password'])){
                mysqli_query($imgsDB, "UPDATE `users` SET `password` = '".mysqli_real_escape_string($imgsDB, password_hash($_POST['NewPassword'], PASSWORD_DEFAULT))."' WHERE id = ".$_SESSION['auth']['id']);

                userLogOut();
                message("Password successfully updated", 2, "success");
                header("Location: http://{$_SERVER['SERVER_NAME']}");
            } else{
                message("Current password is incorrect", 2, "error");
            }
        }

        header("Location: http://{$_SERVER['SERVER_NAME']}{$_SERVER['SCRIPT_NAME']}?user=".$_SESSION['auth']['id']);
    }

    require_once "assets/view.php";