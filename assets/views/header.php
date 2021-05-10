<?php
    foreach ($_SESSION['messages'] as $key => $value) {
        $_SESSION['messages'][$key]['redirections-done'] = $value['redirections-done'] + 1;
    }
?>

<div class="container">
    <a href="/" class="mainPageLink"><h1>Free online gallery</h1></a>
    <p>Welcome! Fell free to share your photo</p>

    
        <ul class="message-container" id="message-container">
            <?php foreach ($_SESSION['messages'] as $msgkey => $message) { extract($message);?>

                <li class="<?= htmlspecialchars($type) ?>">
                    <span><?= htmlspecialchars($text) ?></span>
                    <button class="close">&#9746;</button>
                </li>

            <?php  
                if($message['redirections-done'] >= $message['redirections']) unset($_SESSION['messages'][$msgkey]);
            } ?>
        </ul>
    

    <?php if(!isset($_SESSION["auth"])) { ?>

    <div class="buttons">
        <button class="signIn button" id="signIn">Sign in</button><a class="registration button" href="registration.php">Registration</a>
    </div>
    <div class="loginModal modalContainer">
        <div class="modalContent">
            <form method="POST" id="login">
                <input type="email" name="email" placeholder="e-mail" autocomplete="email" reguired>
                <input type="password" name="password" placeholder="Password" autocomplete="current-password" reguired>
                <input type="submit" class="button" name="DOauthorize" value="Log In">
                <a href="" class="forgot">forgot password?</a>
            </form>
        </div>
    </div>

    <?php } else { ?>
        <?php if($main == "main" || $main == "profile") { ?>

        <button class="addPhotoButton" id="addPhotoButton"><span class="plus">&#10010;</span> Post new photo</button>
        
        <?php } ?>
        <p>Greetings, <a href="/profile.php" class="profileLink"><?= htmlspecialchars($_SESSION['auth']['username']) ?></a></p>
        <div class="buttons">
            <a class="signOut button" href="?logout=true">Sign Out</a>
        </div>
    <?php } ?>
</div>

<?php if(isset($_SESSION["auth"]) && ($main == "main" || $main == "profile")) {?>
<div class="addPicture modalContainer" id="addPicture">
    <div class="modalContent">
        <form id ="pictureForm" method="POST">
            <input type="text" name="user_id" value="<?= $_SESSION['auth']['id'] ?>" hidden>
            <div class="drop" id="drop">
                <p>Upload your image using button below or by dragging and dropping files onto the dashed region</p>
                <input type="file" name="image" id="file" accept="image/*" hidden>
                <label for="file" class="button" id="selectButton">Select file</label>
                <picture class="preview" id="preview">
                </picture>
            </div>
            <input type="text" placeholder="title" name="title" required>
            <textarea name="description" id="" cols="30" rows="10" placeholder="description"></textarea>
            <input class="button" type="submit" value="Post a picture" name="send">
        </form>
    </div>
</div>
<?php } ?>