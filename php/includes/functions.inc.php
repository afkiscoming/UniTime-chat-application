<?php

function emptyInputSignup($firstName, $lastName, $username, $email, $password, $passwordRepeat)
{
    $result;
    if (empty($firstName) || empty($lastName) || empty($username) || empty($email) || empty($password) || empty($passwordRepeat))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function usernameLength($username)
{
    $result;
    if (strlen($username) < 4)
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function invalidUsername($username)
{
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function invalidEmail($email)
{
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function passwordLength($password)
{
    $result;
    if (strlen($password) < 6)
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function passwordMatch($password, $passwordRepeat)
{
    $result;
    if ($password !== $passwordRepeat)
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function usernameExists($conn, $username, $email)
{
    $sql = "SELECT * FROM users WHERE usersUsername = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../signup.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData))
    {
        return $row;
    }
    else
    {
        $result =false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $firstName, $lastName, $username, $email, $password)
{
    $sql = "INSERT INTO users (usersFirstname, usersLastname, usersUsername, usersEmail, usersPassword) VALUES (?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../signup.php?error=stmtFailed");
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss", $firstName, $lastName, $username, $email, $hashedPassword);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    header("location: ../draft.php");
    exit();
}

function emptyInputLogin($username, $password)
{
    $result;
    if (empty($username) || empty($password))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $password)
{
    $usernameExists = usernameExists($conn, $username, $username);

    if ($usernameExists === false)
    {
        header("location: ../login.php?error=wrongLogin");
        exit();
    }

    $passwordHashed = $usernameExists["usersPassword"];
    $checkPassword = password_verify($password, $passwordHashed);

    if ($checkPassword === false)
    {
        header("location: ../login.php?error=wrongPassword");
        exit();
    }
    elseif ($checkPassword === true)
    {
        session_start();
        $_SESSION["userId"] = $usernameExists["usersId"];
        $_SESSION["userUsername"] = $usernameExists["usersUsername"];

        header("location: ../draft.php");
        exit();
    }
}