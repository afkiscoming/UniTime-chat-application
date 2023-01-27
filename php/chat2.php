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
    <section class="chat-area">
        <header>
            <?php
            $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE usersUniqueId = {$user_id}");
            if(mysqli_num_rows($sql) > 0)
            {
                $result = mysqli_fetch_assoc($sql);
            }

            ?>

            <a href="users2.php" class="back-icon"> <i class="fas fa-arrow-left"></i></a>
            <img src="../images/uploaded-profile-photos/<?php echo $result['usersProfilePhoto'] ?>" alt="">
            <div class="details">
                <span> <?php echo $result['usersFirstName'] . " " . $result['usersLastName'] ?> </span>
                <p> <?php echo $result['usersStatus'] ?> </p>
            </div>
        </header>
        <div class="chat-box">



        </div>

        <form action="#" class="typing-area">
            <input type="text" name="outgoing_id" value="<?php echo $_SESSION['usersUniqueId']; ?>" hidden>
            <input type="text" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
            <input id="input-field" name="message" type="text" placeholder="Type your message...">
            <button id="send-button"><i class="fab fa-telegram-plane"></i></button>
        </form>

    </section>

    <script src="../js/chat2.js"></script>

<?php
include "footer2.php";
?>
