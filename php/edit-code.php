<?php

include "config.php";

session_start();
include "config.php";
if (!isset($_SESSION['usersUniqueId'])){
    header("location: ../php/login.php");
}

$first_name = mysqli_real_escape_string($conn, $_POST['first-name']);
$last_name = mysqli_real_escape_string($conn, $_POST['last-name']);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$passwordCheck = False;



$sql = mysqli_query($conn, "SELECT * FROM users WHERE usersUniqueId = {$_SESSION['usersUniqueId']}");
if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
}



if(!empty($first_name) && !empty($last_name) && !empty($username) && !empty($email)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $sql = mysqli_query($conn, "SELECT * FROM users WHERE usersUniqueId != {$_SESSION['usersUniqueId']} AND usersEmail = '{$email}'");

        if (mysqli_num_rows($sql) > 0)   //if email already exists
        {
            echo "This email address already exists!";
        }
        else
        {

            $sql = mysqli_query($conn, "SELECT * FROM users WHERE usersUniqueId != {$_SESSION['usersUniqueId']} AND usersUsername = '{$username}'");

            if (mysqli_num_rows($sql) > 0)   //if  username already exists
            {
                echo "This username already exists!";
            }
            else
            {
                if (is_uploaded_file($_FILES['image']['tmp_name']))  //if the profile p uploaded
                {

                    $img_name = $_FILES['image']['name'];   //getting user uploaded image name
                    $img_type = $_FILES['image']['type'];   //getting user uploaded image type
                    $tmp_name = $_FILES['image']['tmp_name'];   //this temp name is used to save/move file in our folder

                    //explode image and get the extension as jpeg/ png
                    $img_explode = explode('.', $img_name);
                    $img_extension = end($img_explode);     //we get only the extension with this

                    $extensions = ['png', 'jpeg', 'jpg'];     //our accepted extensions
                    if (in_array($img_extension, $extensions) === true) {
                        $types = ["image/png", "image/jpeg", "image/jpg"];
                        if (in_array($img_type, $types) === true) {
                            $time = time();
                            $new_img_name = $time . $img_name;
                            $target_path = "../images/uploaded-profile-photos/" . $new_img_name;

                            if (move_uploaded_file($tmp_name, $target_path)) {
                                if ($password != "") {
                                    $passwordCheck = True;
                                }

                                if ($passwordCheck) {
                                    if (strlen($password) >= 6) {
                                        $sql_update_data = mysqli_query($conn, "UPDATE users SET usersFirstName = {'$first_name'}, usersLastName = {'$last_name'}, 
                                                                                            usersUsername = {'$username'}, usersEmail = {'$email'}, usersPassword = {'$password'},
                                                                                            usersProfilePhoto = {'$new_img_name'}
                                                                                            WHERE usersUniqueId = {$_SESSION['usersUniqueId']}");
                                        echo "success";
                                    } else {
                                        echo "Password should be longer than 6 characters!";
                                    }
                                } else {
                                    $sql_update_no_pass_data = mysqli_query($conn, "UPDATE users SET usersFirstName = {'$first_name'}, usersLastName = {'$last_name'}, 
                                                                                            usersUsername = {'$username'}, usersEmail = {'$email'},
                                                                                            usersProfilePhoto = {'$new_img_name'}
                                                                                            WHERE usersUniqueId = {$_SESSION['usersUniqueId']}");
                                    echo "success";
                                }
                            }
                        }
                    }
                }
                else
                {

                    if ($password != "") {
                        $passwordCheck = True;
                    }

                    if ($passwordCheck) {
                        if (strlen($password) >= 6) {
                            $sql_update_no_img_data = mysqli_query($conn, "UPDATE users SET usersFirstName = {'$first_name'}, usersLastName = {'$last_name'}, 
                                                                                            usersUsername = {'$username'}, usersEmail = {'$email'}, usersPassword = {'$password'},
                                                                                            WHERE usersUniqueId = {$_SESSION['usersUniqueId']}");
                            echo "success";
                        } else {
                            echo "Password should be longer than 6 characters!";
                        }
                    } else {

                        $sql_update_no_pass_and_img_data = mysqli_query($conn, "UPDATE users SET usersFirstName = {'$first_name'}, usersLastName = {'$last_name'}, 
                                                                                            usersUsername = {'$username'}, usersEmail = {'$email'},       
                                                                                            WHERE usersUniqueId = {$_SESSION['usersUniqueId']}");
                        echo "success";
                    }
                }
            }
        }

    } else {
        echo "Email address is not valid!";
    }
}
else
{
    echo "Please fill the required fields!";
}
