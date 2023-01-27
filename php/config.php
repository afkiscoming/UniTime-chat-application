<?php

/*$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "php-thesis-draft";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if (!$conn)
{
    die("Connection failed: " . mysqli_connect_error());
}*/

$conn = mysqli_connect("localhost", "root","","chat");

if(!$conn)
{
    echo 'database connected'. mysqli_connect_error();
}