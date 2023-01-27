<?php
session_start();
include "config.php";
if (!isset($_SESSION['usersUniqueId'])){
    header("location: ../php/login.php");
}
?>

<?php
include "header.php";
?>

<div class="wrapper">
    <section class="form edit">

        <?php
        include "config.php";
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE usersUniqueId = {$_SESSION['usersUniqueId']}");
        if(mysqli_num_rows($sql) > 0)
        {
            $row = mysqli_fetch_assoc($sql);
        }
        ?>

        <form action="#" enctype="multipart/form-data">
            <div class="profile-edit-img">
                <img src="../images/uploaded-profile-photos/<?php echo $row['usersProfilePhoto'] ?>" alt="">
            </div>

            <div class="error-txt" id="error-txt"></div>
            <div class="name-details">
                <div class="field input">
                    <label>First Name</label>
                    <input id="first-name" type="text" name="first-name" placeholder="First name" required
                    value="<?php echo $row['usersFirstName'] ?>">
                </div>
                <div class="field input">
                    <label>Last Name</label>
                    <input id="last-name" type="text" name="last-name" placeholder="Last name" required
                    value="<?php echo $row['usersLastName'] ?>">
                </div>
            </div>
            <div class="field input">
                <label>Username</label>
                <input id="username" type="text" name="username" placeholder="Username" required
                value="<?php echo $row['usersUsername'] ?>">
            </div>
            <div class="field input">
                <label>Email</label>
                <input id="email" type="text" name="email" placeholder="Email" required
                value="<?php echo $row['usersEmail'] ?>">
            </div>
            <div class="field input">
                <label>Password</label>
                <input id="password" type="password" name="password" placeholder="Password">
                <i id="show-hide-button" class="fas fa-eye"></i>
            </div>
            <div class="field image">
                <label>Select Image</label>
                <input type="file" id="image" name="image">
            </div>
            <div class="field button">
                <input id="update-button" type="submit" value="Update Profile">
            </div>

        </form>
    </section>
</div>

<script src="../js/profile-edit.js"></script>


<?php
include "footer.php";
?>