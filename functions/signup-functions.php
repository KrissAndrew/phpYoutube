<?php

// Functions related to user sign up

/**
 * Returns true if any of the specified variables are empty.
 * Intent is to ensure proper completion of sign up form.
 * @param string $firstname String containing users first name.
 * @param string $lastname String containing users last name.
 * @param string $email String containing users email address.
 * @param string $uid String containing the provided username.
 * @param string $password String containing the users provided password.
 * @return bool True is any of the provided fields are empty, otherwise false.
 */
function emptyUserSignup($firstname, $lastname, $email, $uid, $password) {
    if (empty($firstname) || empty($lastname) || empty($email) || empty($uid) || empty($password)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Returns true if the provided name is valid as per regex specified.
 * Intent is to ensure names contain only characters.
 * @param string $name String containing the name to be checked.
 * @return bool True if the provided name is valid, otherwise false.
 */
function validName($name) {
    if (preg_match("/^[a-zA-Z]*$/", $name)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Returns true if the provided username is valid as per regex specified.
 * Intent is to ensure usernames contain only characters and numbers.
 * @param string $name String containing the name to be checked.
 * @return bool True if the provided username is valid, otherwise false.
 */
function validUid($uid) {
    if (preg_match("/^[a-zA-Z0-9]*$/", $uid)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Returns true if the provided email is valid as per the filter specified.
 * @param string $email String containing the email to be validated.
 * @return bool True if the provided email is valid, otherwise false.
 */
function validEmail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

// DB Related Functions //

/**
 * Check the database for existance of provided username.
 * @param mysqli $connection mysqli object containing database connection.
 * @param string $uid String containing the provided username.
 * @return bool True if the provided username is found within the DB, otherwise false.
 */
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

/**
 * Check the database for existance of provided email address.
 * @param mysqli $connection mysqli object containing database connection.
 * @param string $email String containing the provided email address.
 * @return bool True if the provided email address is found within the DB, otherwise false.
 */
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

/**
 * Executes the provided SQL statement to determine existance of provided variable within the db.
 * @param mysqli $connection mysqli object containing database connection.
 * @param mysqli_stmt $stmt mysqli_stmt object containing the statement to bind and execute.
 * @return row|false Returns the row containing the provided data, otherwise false.
 */
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

/**
 * Insert new user information into the database.
 * @param mysqli $connection mysqli object containing database connection.
 * @param string $firstname String containing users first name.
 * @param string $lastname String containing users last name.
 * @param string $email String containing users email address.
 * @param string $uid String containing the provided username.
 * @param string $password String containing the users provided password.
 */
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

function profileImg($connection, $uid) {
    $sql = "SELECT * FROM users WHERE user_uid =".$uid."AND user_first =";
}