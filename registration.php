<?php
    require_once "assets/model.php";
    require_once "assets/auth.php";

    $main = "registration";

    if(isset($_POST['registration'])){
        try{
            createNewUser($imgsDB, $_POST['username'], $_POST['password'], $_POST['email']);
            userLogin($imgsDB, $_POST['username'], $_POST['password'], $_POST['email']);
            message("Welcome to our family, ".$_POST['username'], 2, "success");
        } catch (Exception $e) {
            message($e->getMessage(), 2, "error");
        }

        header("Location: http://{$_SERVER['SERVER_NAME']}");
    }

    require_once "assets/view.php";