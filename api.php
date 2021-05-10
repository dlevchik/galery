<?php
    require_once "assets/model.php";

    if(isset($_FILES['image'])){
        $str = "it works! ".date("h:i:s")."\n";
        foreach ($_POST as $key => $value) {
            $str .= "$key: $value\n";   
        }

        $filename = saveUploadedPhotoToDB($imgsDB, "img", $_FILES['image']['name'], $_FILES['image']['tmp_name'], $_POST['user_id'], $_POST['title'], $_POST['description']);
        $str .= $filename;
        
        file_put_contents("log.txt", $str);
    }