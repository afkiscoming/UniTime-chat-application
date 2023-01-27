<?php

while($row = mysqli_fetch_assoc($sql))
{
    $sql2 = "SELECT * FROM messages WHERE (incomingMessageId = {$row['usersUniqueId']} OR outgoingMessageId = {$row['usersUniqueId']})
            AND (outgoingMessageId = {$outgoing_id} OR incomingMessageId = {$outgoing_id}) ORDER BY messageId DESC LIMIT 1";

    $query2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($query2);
    if(mysqli_num_rows($query2) >0)
    {
        $result = $row2['message'];
    }
    else
    {
        $result = "No message available";
    }
    //trimming message if lenght is  more than 28
    (strlen($result) >26) ? $message = substr($result, 0 ,26).'...' : $message = $result;
    //you text
    if(isset($row2['outgoingMessageId'])){
        ($outgoing_id == $row2['outgoingMessageId']) ? $you = "You: " : $you = "";
    }else{
        $you = "";
    }
    // check if the user online or not
    ($row['usersStatus'] == "Offline") ? $offline = "offline" : $offline = "";

    $output .= '<a href="chat2.php?user_id='.$row['usersUniqueId'].'">
                    <div class="content">
                        <img src="../images/uploaded-profile-photos/'.$row['usersProfilePhoto'].'" alt="">
                        <div class="details">
                            <span>'. $row['usersFirstName']. " ". $row['usersLastName']. '</span>
                            <p>'.$you.$message.'</p>
                        </div>
                    </div>
                    <div class="status-dot '.$offline.'">
                        <i class="fas fa-circle"></i>
                    </div>
                    </a>';
}