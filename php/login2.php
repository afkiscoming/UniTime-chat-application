<?php
session_start();
if(isset($_SESSION['usersUniqueId'])){
    header("location: ../php/users2.php");
}
?>

<?php
include "header2.php";
?>

<div class="wrapper">
    <section class="form login">
        <h2>Login</h2>
        <form action="#">
            <div id="error-txt" class="error-txt"></div>
            <div class="field input">
                <label>Username</label>
                <input type="text" name="username" placeholder="Username">
            </div>
            <div class="field input">
                <label>Password</label>
                <input id="password" type="password" name="password" placeholder="Password">
                <i id="show-hide-button" class="fas fa-eye"></i>
            </div>

            <div class="field button">
                <input id="login-button" type="submit" value="Continue to surf">
            </div>
        </form>

        <div class="link">Haven't signed up yet? <a href="../php/signup2.php">Signup now</a> </div>
    </section>
</div>

<script src="../js/pass-show-hide2.js"></script>
<script src="../js/login2.js"></script>

<?php
include "footer2.php";
?>
