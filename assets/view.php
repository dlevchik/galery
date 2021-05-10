<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Image Gallery</title>
    <link rel="stylesheet" href="/assets/css/style.css?v=<?=time();?>">
</head>
<body>
    <header>
        <?php require_once "assets/views/header.php"?>
    </header>
    <main>
        <?php if($main == "main"){require_once "assets/views/main.php";}?>
        <?php if($main == "registration"){require_once "assets/views/regpage.php";}?>
        <?php if($main == "profile"){require_once "assets/views/profilepage.php";}?>
        <?php if($main == "404"){require_once "assets/views/404.php";}?>
    </main>
    <footer>
        <?php require_once "assets/views/footer.php"?>
    </footer>
    <script src="/assets/script.js?v=<?=time();?>"></script>
</body>
</html>