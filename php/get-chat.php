<?php

session_start();
if(isset($_SESSION['usersUniqueId']))
{
    include "config.php";
    $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $output = "";

    $sql = "SELECT * FROM messages 
         LEFT JOIN users ON users.usersUniqueId = messages.outgoingMessageId
         WHERE (outgoingMessageId = {$outgoing_id} AND incomingMessageId = {$incoming_id}) 
            OR (outgoingMessageId = {$incoming_id} AND incomingMessageId = {$outgoing_id}) ORDER BY messageId";
    $query = mysqli_query($conn, $sql);

    if(mysqli_num_rows($query) >0 )
    {
        while ($row = mysqli_fetch_assoc($query))
        {
            if ($row['outgoingMessageId'] === $outgoing_id)    //if this is equal then he is a msg sender
            {
                $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['message'].'</p>
                                </div>
                            </div>';
            }
            else    //he is msg receiver
            {
                $output .= '<div class="chat incoming">
                                <img src="../images/uploaded-profile-photos/'.$row['usersProfilePhoto'].'" alt="">
                                <div class="details">
                                    <p>'. $row['message'].'</p>
                                </div>
                            </div>';
            }
        }
    }
    echo $output;
}
else
{
    header("../login.php");
}