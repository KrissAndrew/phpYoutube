<?php
    include_once 'dbh.inc.php';
    require_once '../functions/login-functions.php';

    //  mysqli_real_escape_string() protects from injection attacks
    if (isset($_REQUEST['submit']))
    {
        $uid = mysqli_real_escape_string($connection, $_REQUEST['uid']);
        $password = mysqli_real_escape_string($connection, $_REQUEST['pwd']);
        // Check for errors - First ensure no empy fields
        if ( empty($uid) || empty($password)) {
            header("Location: ../login.php?login=empty&uid=$uid");
            exit();
        }
        loginUser($connection, $uid, $password);
    } else {
        header("Location: ../login.php");
        exit();
    }
