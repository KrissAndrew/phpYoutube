<?php
    include_once 'dbh.inc.php';

    //  mysqli_real_escape_string() protects from injection attacks
    if (isset($_REQUEST['submit']))
    {   $firstname = mysqli_real_escape_string($connection, $_REQUEST['first']);
        $lastname = mysqli_real_escape_string($connection, $_REQUEST['last']);
        $email = mysqli_real_escape_string($connection, $_REQUEST['email']);
        $uid = mysqli_real_escape_string($connection, $_REQUEST['uid']);
        $password = mysqli_real_escape_string($connection, $_REQUEST['pwd']);
        date_default_timezone_set('Australia/Brisbane');
        $createdAt = date('Y-m-d H:i:s');

        // Check for errors - First ensure no empy fields
        if ( empty($firstname) || empty($lastname) || empty($email) || empty($uid) || empty($password)) {
            header("Location: ../signup.php?signup=empty&firstname=$firstname&lastname=$lastname&uid=$uid&email=$email");
            exit();
        // Ensure email is valid
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../signup.php?signup=invalidemail&firstname=$firstname&lastname=$lastname&uid=$uid");
            exit();
        // Ensure first and last name only contain letters
        } elseif (!preg_match("/^[a-zA-Z]*$/", $firstname) || !preg_match("/^[a-zA-Z]*$/", $lastname)) {
            header("Location: ../signup.php?signup=char&uid=$uid&email=$email");
            exit();
        } else {
            $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd, date_created)
            VALUES (?, ?, ?, ?, ?, '$createdAt');";
            $stmt = mysqli_stmt_init($connection);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "Sql Error";
            } else {
                $pwdHash = password_hash($password, PASSWORD_DEFAULT);
                password_verify($password, $pwdHash);
                mysqli_stmt_bind_param($stmt, "sssss", $firstname, $lastname, $email, $uid, $pwdHash);
                mysqli_stmt_execute($stmt);
                header("Location: ../index.php?signup=success");
            }
        }
    }

