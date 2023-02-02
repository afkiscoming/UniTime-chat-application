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
    <section class="profile-details-section">
        <div class="container">

            <!--            --><?php
            //            include "config.php";
            //            $sql = mysqli_query($conn, "SELECT * FROM users WHERE usersUniqueId = {$_SESSION['usersUniqueId']}");
            //            if(mysqli_num_rows($sql) > 0)
            //            {
            //                $row = mysqli_fetch_assoc($sql);
            //            }
            //            ?>

            <?php
            $outgoing_id2 = $_SESSION['usersUniqueId'];
            $sql2 = mysqli_query($conn, "SELECT * FROM users WHERE NOT usersUniqueId = {$outgoing_id2}");
            $row  = mysqli_fetch_assoc($sql2);

            $resut_chat = $_SESSION['result_chat'];

            $sql = mysqli_query($conn, "SELECT * FROM users WHERE usersUniqueId = {$resut_chat}");
            if(mysqli_num_rows($sql) > 0)
            {
                $row = mysqli_fetch_assoc($sql);
            }
            ?>



            <!--            --><?php
            //            $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
            //            $sql = mysqli_query($conn, "SELECT * FROM users WHERE usersUniqueId = {$user_id}");
            //            if(mysqli_num_rows($sql) > 0)
            //            {
            //                $row = mysqli_fetch_assoc($sql2);
            //            }
            //
            //            ?>


            <div class="profile-details">


                <a href="chat.php?user_id=<?php echo $resut_chat?>" class="back-icon"> <i class="fas fa-arrow-left"></i></a>

                <img src="../images/uploaded-profile-photos/<?php echo $row['usersProfilePhoto'] ?>" alt="">
                <h2>@<?php echo $row['usersUsername'] ?> </h2>

                <hr class="profile-hr">
                <p> <?php echo $row['usersFirstName'] . " " . $row['usersLastName'] ?> </p>
                <hr class="profile-hr">
                <h2>ABOUT</h2>
                <p> <?php echo $row['usersAbout'] ?> </p>

                <hr class="profile-hr">

<!--                --><?php
//                if ($resut_chat != $_SESSION['usersUniqueId'])
//                {
//                    echo '<button id="edit-profile" class="edit-profile" formaction="../php/profile-edit.php" style="display: none"> Edit Profile </button>';
//                }
//                else
//                {
//                    echo '<button id="edit-profile" class="edit-profile" formaction="../php/profile-edit.php"> Edit Profile </button>';
//                }
//                ?>


            </div>
        </div>
    </section>


</div>
<?php
include "footer.php";
?>
