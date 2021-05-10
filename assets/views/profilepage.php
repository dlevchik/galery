<div class="profilepage">
    <div class="container">
        <?php if(isset($_SESSION['auth']) && ($_SESSION['auth']['id'] == $user['id'])){?>
            <button id="profileOptionsButton" class="profileOptionsButton">&#9881;</button>
        <?php } ?>
        <div class="profile-info">
            <picture class="profilePic">
                <img src="<?= htmlspecialchars($user['profile-pic']) ?>" alt="<?= htmlspecialchars($user['username']) ?>">
            
                <?php if(isset($_SESSION['auth']) && ($_SESSION['auth']['id'] == $user['id'])){?>
                    <form method="POST" action="<?=$_SERVER['SCRIPT_NAME']?>" class="newProfilePicForm" id="newProfilePicForm" enctype="multipart/form-data">
                        <input type="file" name="newProfilePic" id="newProfilePic" hidden>
                        <label for="newProfilePic" class="newProfilePicButton"><span>Change profile picture &#128443;</span></label>
                    </form>
                <?php } ?>
            </picture>
            <div class="profile-text">
                <h2 class="username"> <span id="current-username"><?= htmlspecialchars($user['username']) ?></span>
                    <?php if(isset($_SESSION['auth']) && ($_SESSION['auth']['id'] == $user['id'])){?>
                        <button id="editUsernameButton" class="edit">&#9998;</button>
                        
                        <form class="editForm" id="editUsername" method="POST" hidden>
                            <input type="text" name="newUsername" value="<?= htmlspecialchars($user['username']) ?>">
                            <input type="reset" name="cancell" class="edit editCancell" value="&#10005;">
                            <input type="submit" class="edit editAccept" value="&#10003;">
                        </form>
                    <?php } ?>
                </h2>
                
                <span class="regtime">With us since <time><?= htmlspecialchars($user['registration-time']) ?></time><span>
            </div>
            <div class="description"> <?= htmlspecialchars($user['description']) ?> 
                <?php if(isset($_SESSION['auth']) && ($_SESSION['auth']['id'] == $user['id'])){?>
                    <button id="editDescriptionButton" class="edit">&#9998;</button>

                    <form class="editForm" id="editDescription" method="POST" hidden>
                            <textarea name="newDescription"><?=htmlspecialchars($user['description'])?></textarea>
                            <input type="reset" name="cancell" class="edit editCancell" value="&#10005;">
                            <input type="submit" class="edit editAccept" value="&#10003;">
                    </form>
                <?php } ?>
            </div>
        </div>
        
        <div class="container" id="gallery">

            <?php foreach ($imgs as $item) { extract($item);?>
                <picture class="GalleryItem">
                    <span class="title"><?= htmlspecialchars($title) ?></span>
                    <img src="<?= $path ?>" alt="<?= htmlspecialchars($title) ?>">
                    <p class="description">
                        <?= htmlspecialchars($description) ?>
                    </p>

                    <?php if(isset($_SESSION['auth']) && ($user_id == $_SESSION['auth']['id'] || $_SESSION['auth']['status_id'] == 2)){?>
                        <a class="delete button" href="?del=<?= $id ?>&hash=<?= $_SESSION['auth']['password'] ?>">Delete photo</a>
                    <?php } ?>

                </picture>
            <?php } ?>

        </div>
    </div>
</div>

<div class="modalPicture modalContainer" id="modalPicture">
    <button class="arrow arrow-left">
        &#10094;
    </button>
    <div class="modalContent">
        <div class="container">
            <picture>
                <img src="img/020.jpg" alt="title">
            </picture>
            <div class="info">
                <span class="title">title</span>
                <p class="description">
                    description
                </p>
                <a class="download button" href="img/" download>Download</a>
            </div>
        </div>
    </div>
    <button class="arrow arrow-right">
        &#10095;
    </button>
</div>

<div class="profileOptionsModal modalContainer">
    <div class="modalContent">
        <form method="POST" id="profileOptions" class="profileOptions">
            <h2>Profile Options</h2>
            <table>
                <tr>
                    <td colspan="2">Change email</td>
                </tr>
                <tr>
                    <td>New email:</td>
                    <td><input type="email" name="newEmail" placeholder="e-mail" autocomplete="email" value="<?=htmlspecialchars($user['email'])?>" reguired></td>
                </tr>
                <tr>
                    <td colspan="2">Change password</td>
                </tr>
                <tr>
                    <td>Old password:</td>
                    <td><input type="password" name="OldPassword" placeholder="current Password" autocomplete="off"></td>
                </tr>
                <tr>
                    <td>New password:</td>
                    <td><input type="password" name="NewPassword" placeholder="new Password" autocomplete="new-password"></td>
                </tr>
                <tr>
                    <td><input type="reset" class="button cancelOptions" value="Cancel"></td>
                    <td><input type="submit" class="button saveOptions" name="DOsettings" value="Save Changes"></td>
                </tr>
            </table>
        </form>
    </div>
</div>