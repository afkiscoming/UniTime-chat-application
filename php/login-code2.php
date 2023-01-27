<?php

include_once "config2.php";

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if (!empty($username) && !empty($password)){
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE usersUsername ='{$username}' AND usersPassword = '{$password}'");

    if(mysqli_num_rows($sql) > 0)
    {
        $row = mysqli_fetch_assoc($sql);
        $status = "Online";

        //updating status if login is successful
        $sql2 = mysqli_query($conn, "UPDATE users SET usersStatus = '{$status}' WHERE usersUniqueId = {$row['usersUniqueId']}");

        if($sql2)
        {
            session_start();
            $_SESSION['usersUniqueId'] = $row['usersUniqueId'];
            echo "success";
        }
        else
        {
        echo "Something went wrong. Please try again!";
        }
    }
    else
    {
        echo "Username or password is wrong!";
    }
}
else
{
    echo "Please fill all the required fields!";
}