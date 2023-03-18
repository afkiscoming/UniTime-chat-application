<?php
session_start();
include "config.php";
$outgoing_id = $_SESSION['usersUniqueId'];
$matches = array();

if (isset($_POST['user_count'])) {
    $query = "SELECT COUNT(*) AS user_count FROM users";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    echo $row['user_count'];

} elseif (isset($_POST['admin_count'])){
    $query = "SELECT COUNT(*) as admin_count FROM users WHERE userIsAdmin = 1";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    echo $row['admin_count'];

} elseif (isset($_POST['most_messages'])) {
    $query = "SELECT users.usersFirstName, users.usersLastName, users.usersUniqueId, COUNT(messages.outgoingMessageId) AS message_count 
                  FROM messages 
                  JOIN users ON users.usersuniqueid = messages.outgoingMessageId 
                  GROUP BY usersUniqueId 
                  ORDER BY message_count DESC LIMIT 1";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $mostMessages = $row['usersFirstName'] . "," . $row['usersLastName'] . "," . $row['usersUniqueId'] . "|" . $row['message_count'];
        echo $mostMessages;
    } else {
        echo "No messages found.";
    }
} elseif (isset($_POST['recent_match'])) {
    $query = "SELECT matchReceiver, matchedUser, matchCreationTime 
                    FROM matches
                    ORDER BY matchCreationTime DESC 
                    LIMIT 1";

    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $matchCreationTime = strtotime($row['matchCreationTime']);
        $matchCreationTime = date("Y-m-d H:i:s", $matchCreationTime); // Convert timestamp to human-readable format

        $recentMatch = $row['matchReceiver'] . "|" . $row['matchedUser'] . "|" . $matchCreationTime;
        echo $recentMatch;
    } else {
        echo "No match found.";
    }
} else {
    echo "Invalid Request!";
}
