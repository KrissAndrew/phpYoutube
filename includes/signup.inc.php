<?php
    // Include for access to db
    include_once '../includes/dbh.inc.php';
    include_once '../functions/user-functions.php';

    //  mysqli_real_escape_string() protects from injection attacks
    if (isset($_REQUEST['submit'])){
        $firstname = mysqli_real_escape_string($connection, $_REQUEST['first']);
        $lastname = mysqli_real_escape_string($connection, $_REQUEST['last']);
        $email = mysqli_real_escape_string($connection, $_REQUEST['email']);
        $uid = mysqli_real_escape_string($connection, $_REQUEST['uid']);
        $password = mysqli_real_escape_string($connection, $_REQUEST['pwd']);
        $passwordrepeat = mysqli_real_escape_string($connection, $_REQUEST['pwdrepeat']);

        // Check for errors - First ensure no empy fields
        if ( emptyUserSignup($firstname, $lastname, $email, $uid, $password)) {
            header("Location: ../signup.php?signup=empty&firstname=$firstname&lastname=$lastname&uid=$uid&email=$email");
            exit();
        // Ensure email is valid
        } elseif (!validEmail($email)) {
            header("Location: ../signup.php?signup=invalidemail&firstname=$firstname&lastname=$lastname&uid=$uid");
            exit();
        // Ensure first and last name only contain letters
        } elseif (!(validName($firstname) || validName($lastname))) {
            header("Location: ../signup.php?signup=char&uid=$uid&email=$email");
            exit();
        } elseif ($password != $passwordrepeat) {
            header("Location: ../signup.php?signup=nomatch&firstname=$firstname&lastname=$lastname&uid=$uid&email=$email");
            exit();
        } elseif (!validUid($uid)) {
            header("Location: ../signup.php?signup=badid&firstname=$firstname&lastname=$lastname&email=$email");
            exit();
        } elseif (userNameExists($connection, $uid)) {
            header("Location: ../signup.php?signup=nameexists&firstname=$firstname&lastname=$lastname&email=$email");
            exit(); 
        } elseif (emailExists($connection, $email)) {
            header("Location: ../signup.php?signup=emailexists&firstname=$firstname&lastname=$lastname&email=$email");
            exit();
        } else {
            insertUser($connection, $firstname, $lastname, $email, $uid, $password);
        }
    }

