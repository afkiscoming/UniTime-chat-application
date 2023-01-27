<?php
session_start();
if(isset($_SESSION['usersUniqueId'])){
    header("location: ../php/messages.php");
}
?>

<?php
include "header.php";
?>


<!--<section class="signup-form">
    <h2>Sign Up</h2>
    <form action="includes/signup.inc.php" method="post">
        <input type="text" name="first-name" placeholder="First name">
        <input type="text" name="last-name" placeholder="Last name">
        <input type="text" name="username" placeholder="Username">
        <input type="text" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="password-repeat" placeholder="Repeat Password">
        <button type="submit" name="submit">Sign Up</button>
    </form>
</section>
-->

    <div class="wrapper">
        <section class="form signup">
            <h2>Sign Up</h2>
            <form action="#" enctype="multipart/form-data">
                <div class="error-txt" id="error-txt"></div>
                <div class="name-details">
                    <div class="field input">
                        <label>First Name</label>
                        <input id="first-name" type="text" name="first-name" placeholder="First name" required>
                    </div>
                    <div class="field input">
                        <label>Last Name</label>
                        <input id="last-name" type="text" name="last-name" placeholder="Last name" required>
                    </div>
                </div>
                <div class="field input">
                    <label>Username</label>
                    <input id="username" type="text" name="username" placeholder="Username" required>
                </div>
                <div class="field input">
                    <label>Email</label>
                    <input id="email" type="text" name="email" placeholder="Email" required>
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input id="password" type="password" name="password" placeholder="Password" required>
                    <i id="show-hide-button" class="fas fa-eye"></i>
                </div>
                <div class="field image">
                    <label>Select Image</label>
                    <input type="file" id="image" name="image">
                </div>
                <div class="field button">
                    <input id="signup-button" type="submit" value="Start surfing">
                </div>
            </form>

            <div class="link">Already signed up? <a href="../php/login.php">Login now</a> </div>
        </section>
    </div>

    <script src="../js/pass-show-hide.js"> </script>
    <script src="../js/signup.js"> </script>


<?php
include "footer.php";
?>