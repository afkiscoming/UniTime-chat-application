<?php

session_start();
include_once "config2.php";
$outgoing_id = $_SESSION['usersUniqueId'];
$search_term = mysqli_real_escape_string($conn, $_POST['searchTerm']);
$output = "";
$sql = mysqli_query($conn, "SELECT * FROM users WHERE NOT usersUniqueId = {$outgoing_id} AND
                                    (usersFirstName LIKE '%{$search_term}%' OR usersLastName LIKE '%{$search_term}%')");
if (mysqli_num_rows($sql)>0)
{
    include "profile-data2.php";
}
else
{
    $output .= "No user found.";
}
echo $output;