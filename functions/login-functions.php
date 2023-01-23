<?php

include 'signup-functions.php';

// Log in the user with either userid or email address 
function loginUser($connection, $uid, $password) {
    $uidExists = userNameExists($connection, $uid);
    $emailExists = emailExists($connection, $uid);
    if (!($uidExists || $emailExists)) {
        header("Location: ../login.php?login=baduid");
        exit();
    }

    if ($uidExists) {
        $pwdHash = $uidExists['user_pwd'];
    } else {
        $pwdHash = $emailExists['user_pwd'];
    }
    
    $checkPwd = password_verify($password, $pwdHash);
    if ($checkPwd == false) {
        header("Location: ../login.php?login=wronglogin");
        exit();
    } elseif ($checkPwd = true) {
        session_start();
        if ($uidExists) {
            $_SESSION['userid'] = $uidExists['user_id'];
            $_SESSION['useruid'] = $uidExists['user_uid'];
            $_SESSION['useremail'] = $uidExists['user_uid'];
        } else {
            $_SESSION['userid'] = $emailExists['user_id'];
            $_SESSION['useruid'] = $emailExists['user_uid'];
            $_SESSION['useremail'] = $emailExists['user_uid'];
        }
        header("Location: ../index.php?login=success");
        exit();
    }
}