<?php


# sign-up page functions
# Detect empty input fields for signup form
function emptyUserSignup($firstname, $lastname, $email, $uid, $password) {
    if (empty($firstname) || empty($lastname) || empty($email) || empty($uid) || empty($password)) {
        return true;
    } else {
        return false;
    }
}

# Ensure name input only contains characters
function validName($name) {
    if (preg_match("/^[a-zA-Z]*$/", $name)) {
        return true;
    } else {
        return false;
    }
}

# ensure the username does not contain invalid characters
function validUid($uid) {
    if (preg_match("/^[a-zA-Z0-9]*$/", $uid)) {
        return true;
    } else {
        return false;
    }
}

# Validate provided email address
function validEmail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}


# Db functions - consider another file
function insertUser($connection, $firstname, $lastname, $email, $uid, $password) {
    date_default_timezone_set('Australia/Brisbane');
    $createdAt = date('Y-m-d H:i:s');
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


function userNameExists($connection, $uid) {
    $sql = "SELECT * FROM users WHERE user_uid = ?;";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../signup.php?signup=stmtfail");
        exit();
    } else {
        return exists($stmt, $uid);
    }
    mysqli_stmt_close($stmt);
}

function emailExists($connection, $email) {
    $sql = "SELECT * FROM users WHERE user_email = ?;";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../signup.php?signup=stmtfail");
        exit();
    } else {
        return exists($stmt, $email);
    }
    mysqli_stmt_close($stmt);
}

// Potential changes for a more universal execution statement
// input array of items, creatr custome string based upon length and type of array items e.g. "ssis"
function exists($stmt, $data) {
    mysqli_stmt_bind_param($stmt, "s", $data);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        return $row;
    } else {
        return false;
    }
}

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