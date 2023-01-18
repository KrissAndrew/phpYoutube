<!-- Shared heading page for website containing nav links &
 important code for use of varying stylesheets and titles -->
<?php
    session_start();
    include 'functions/user-functions.php';
    include 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php
    if (isset($pageTitle))
    echo '<title>'.$pageTitle.'</title>'
    ?>
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