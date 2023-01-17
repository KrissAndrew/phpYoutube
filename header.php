<!-- Including documents makes sense from a reusability standpoint -->
<!-- This is an example of how to do so -->
<?php
    session_start();
    include 'functions/user-functions.php';
    include 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Learning Index Page</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <?php
    if (isset($css) && is_array($css)) {
        foreach ($css as $path) {
            echo '<link rel="stylesheet" type="text/css" href="css/'.$path.'">
';
        }
    }
    ?>
</head>
<body>

<header>
    <div class="wrapper">
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="signup.php">Sign up</a></li>
                <li><a href="login.php">Log in</a></li>
            </ul>
        </nav>
    </div>
</header>