<?php

session_start();
if(isset($_SESSION['usersUniqueId']))
{
    include "config2.php";
    $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    if(!empty($message))
    {
        $sql = mysqli_query($conn, "INSERT INTO messages (incomingMessageId, outgoingMessageId, message)
                                            VALUES ({$incoming_id},{$outgoing_id}, '{$message}')") or die();
    }
}
else
{
    header("../login2.php");
}