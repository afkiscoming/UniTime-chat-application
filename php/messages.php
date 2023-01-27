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
        <section class="users">
            <header>
                <?php
                include "config.php";
                $sql = mysqli_query($conn, "SELECT * FROM users WHERE usersUniqueId = {$_SESSION['usersUniqueId']}");
                if(mysqli_num_rows($sql) > 0)
                {
                    $row = mysqli_fetch_assoc($sql);
                }
                ?>
                <div class="content">

                    <img src="../images/uploaded-profile-photos/<?php echo $row['usersProfilePhoto'] ?>" alt="">
                    <div class="details">
                        <span> <?php echo $row['usersFirstName'] . " " . $row['usersLastName'] ?> </span>
                        <p> <?php echo $row['usersStatus'] ?> </p>
                    </div>
                </div>
                <a href="../php/logout.php?logout_id=<?php echo $row['usersUniqueId']; ?>" class="logout">Logout</a>
            </header>
            <div class="search">
                <span class="text">Select an user to chat</span>
                <input id="search-bar" type="text" placeholder="Enter name to search...">
                <button id="search-button"><i class="fas fa-search"></i></button>
            </div>

            <div id="users-list" class="users-list">


            </div>
        </section>
    </div>



<script src="../js/messages.js">

</script>

<?php
include "footer.php";
?>
