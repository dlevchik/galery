<div class="registration">
    <div class="container">
        <p>Our free online image gallery is ad-free space where with a few clicks you can share your photography or art with the world!</p>
        <p>Just few steps from becoming a part of our family:</p>
        <?php if(!isset($_SESSION["auth"])) { ?>
        <form method="POST" id="registrationForm">
            <h2>New user registration</h2>
            <div class="fields">
                <input type="text" name="username" placeholder="Username" autocomplete="username" reguired>
                <input type="email" name="email" placeholder="e-mail" autocomplete="email" reguired>
                <input type="password" name="password" placeholder="Password" autocomplete="current-password" reguired>
                <input type="password" placeholder="Confirm password" id="confirmation" autocomplete="current-password" reguired>
                <input type="submit" class="button" name="registration" value="Registration">
                <p>or you can <a href="" id="regLogin" class="signIn">sign in</a> if you already have an account</p>
            </div>
        </form>
        <?php } else{?>
            <h2>You already authorized. Welcome back, <?= $_SESSION['auth']['username'] ?>!</h2>
        <?php } ?>
    </div>
</div>