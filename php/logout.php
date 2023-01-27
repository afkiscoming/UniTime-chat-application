<?php

session_start();

if(isset($_SESSION['usersUniqueId']))   //if user is loggedin then come to this page else go login page
{
    include "config.php";
    $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);

    if(isset($logout_id)) //of logout id is set
    {
        $status = "Offline";
        $sql = mysqli_query($conn, "UPDATE users SET usersStatus = '{$status}' WHERE usersUniqueId = {$_GET['logout_id']}");

        if($sql)
        {
            session_unset();
            session_destroy();
            header("location: ../php/login.php");
        }
    }
    else
    {
        header("location: ../php/messages.php");

    }
}
else
{
    header("location: ../php/login.php");
}