<?php
session_start();
include "config2.php";
if (!isset($_SESSION['usersUniqueId'])){
    header("location: ../php/login2.php");
}
?>

<?php
include "header2.php";
?>

<div class="wrapper">
    <section class="users">
        <header>
        <?php
            include "config2.php";
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
        <a href="../php/logout2.php?logout_id=<?php echo $row['usersUniqueId']; ?>" class="logout">Logout</a>
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

</div>

<script src="../js/users2.js">

</script>

<?php
include "footer2.php";
?>
