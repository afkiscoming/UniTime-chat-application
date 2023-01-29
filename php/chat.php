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
    <section class="chat-area">
        <header>
            <?php
            $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE usersUniqueId = {$user_id}");
            if(mysqli_num_rows($sql) > 0)
            {
                $result = mysqli_fetch_assoc($sql);
            }

            $_SESSION['result_chat'] = $result['usersUniqueId'];

//            global $result_chat;
//            $result_chat = $result['usersUniqueId'];
            ?>

            <a href="messages.php" class="back-icon"> <i class="fas fa-arrow-left"></i></a>
            <a href="user-profile.php?user_id=<?php echo $result['usersUniqueId']?>" class="chat-profile" style="display: flex">
                <img src="../images/uploaded-profile-photos/<?php echo $result['usersProfilePhoto'] ?>" alt="">
                <div class="details">
                    <span> <?php echo $result['usersFirstName'] . " " . $result['usersLastName'] ?> </span>
                    <p> <?php echo $result['usersStatus'] ?> </p>
                </div>
            </a>

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

    <script src="../js/chat.js"></script>

    <?php
    include "footer.php";
    ?>
