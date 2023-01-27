<?php
session_start();
if(isset($_SESSION['usersUniqueId'])){
    header("location: ../php/messages.php");
}
?>

<?php
include "header.php";
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

            <div class="link">Haven't signed up yet? <a href="../php/signup.php">Signup now</a> </div>
        </section>
    </div>

    <script src="../js/pass-show-hide.js"></script>
    <script src="../js/login.js"></script>

<?php
include "footer.php";
?>