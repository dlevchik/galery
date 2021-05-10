<?php
    require_once "assets/model.php";
    require_once "assets/auth.php";

    // foreach ($imgs as $item) {
    //     addPhotoToDB($imgsDb, "img/$item", "title", "description");
    //     $main .= "<img src=\"img/$item\" alt=\"img/$item\">";
    // }
    $imgs = mysqli_resultArray($imgsDB, "SELECT * FROM img");
    
    if(isset($_GET['del'])){
        try {
            deletePhoto($imgsDB, $_GET['del'], $_GET['hash']);
            message('Photo has been deleted!', 2, "success");
        } catch (Exception $e) {
            message($e->getMessage(), 2, "error");
        }
        header("Location: http://{$_SERVER['SERVER_NAME']}{$_SERVER['SCRIPT_NAME']}");
    }
    
    $main = "main";
    require_once "assets/view.php";