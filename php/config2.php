<?php

$conn2 = mysqli_connect("localhost", "root","","chat");

    if(!$conn2)
    {
        echo 'database connected'. mysqli_connect_error();
    }