<?php

 include_once "config2.php";

 $first_name = mysqli_real_escape_string($conn, $_POST['first-name']);
 $last_name = mysqli_real_escape_string($conn, $_POST['last-name']);
 $username = mysqli_real_escape_string($conn, $_POST['username']);
 $email = mysqli_real_escape_string($conn, $_POST['email']);
 $password = mysqli_real_escape_string($conn, $_POST['password']);

 if(!empty($first_name) && !empty($last_name) && !empty($username) && !empty($email) && !empty($password))
 {
    if(filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE usersEmail = '{$email}'");
        if(mysqli_num_rows($sql) > 0)   //if email already exists
        {
            echo "This email address already exists!";
        }
        else
        {
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE usersUsername = '{$username}'");
            if(mysqli_num_rows($sql) > 0)   //if  username already exists
            {
                echo "This username already exists!";
            }
            else
            {
                if(isset($_FILES['image']))  //if the profile p uploaded
                {
                    $img_name = $_FILES['image']['name'];   //getting user uploaded image name
                    $img_type = $_FILES['image']['type'];   //getting user uploaded image type
                    $tmp_name = $_FILES['image']['tmp_name'];   //this temp name is used to save/move file in our folder

                    //explode image and get the extension as jpeg/ png
                    $img_explode = explode('.',$img_name);
                    $img_extension = end($img_explode);     //we get only the extension with this

                    $extensions = ['png','jpeg','jpg'];     //our accepted extensions
                    if(in_array($img_extension, $extensions) === true)
                    {
                        $types = ["image/png", "image/jpeg", "image/jpg"];
                        if(in_array($img_type, $types) === true)
                        {
                            $time = time();
                            $new_img_name = $time.$img_name;
                            $target_path = "../images/uploaded-profile-photos/".$new_img_name;

                            if(move_uploaded_file($tmp_name,$target_path))    //if user image moved the folder successfully
                            {
                                $random_id = rand(time(), 100000000);
                                $status = "Online";    //when user signed up their status will be ONLINE
                                $encrypt_pass = password_hash($password, PASSWORD_DEFAULT);

                                $sql_insert_data = mysqli_query($conn, "INSERT INTO users (usersUniqueId,usersFirstName, usersLastName, usersUsername, 
                                                                                            usersEmail, usersPassword, usersProfilePhoto, usersStatus)
                                                                                            VALUES ('{$random_id}','{$first_name}', '{$last_name}', '{$username}', '{$email}',
                                                                                                    '{$password}','{$new_img_name}','{$status}' )");
                                if($sql_insert_data)    //if these data inserted
                                {
                                    $select_sql = mysqli_query($conn, "SELECT * FROM users WHERE usersEmail = '{$email}' OR usersUsername = '{$username}'");
                                    if(mysqli_num_rows($select_sql) > 0){
                                        $result = mysqli_fetch_assoc($select_sql);

                                        session_start();
                                        $_SESSION['usersUniqueId'] = $result['usersUniqueId'];
                                        echo "success";
                                    }else{
                                        echo "This email address or username not Exist!";
                                    }
                                }
                                else
                                {
                                    echo "Something went wrong!";
                                }
                            }
                        }
                        else
                        {
                            echo "Image format is not correct - png, jpg, jpeg!";
                        }
                    }
                    else
                    {
                        echo "Image format is not correct - png, jpg, jpeg!";
                    }
                }
                else
                {
                    //TODO= UPLOAD THE STOCK PP FOR THAT PERSON!!!
                }
            }
        }
    }
    else
    {
        echo "Email address is not valid!";
    }
 }
 else
 {
     echo "Please fill the required fields!";
 }