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
                <!-- Example of dynamix content generation dependant upon a use being logged in. Try applying this to a personal page or smth -->
                <?php
                    if (isset($_SESSION["useruid"])) {
                        echo '<li><a href="profile.php">Profile</a></li>';
                        echo '<li><a href="includes/logout.inc.php">Log out</a></li>';
                    } else {
                        echo '<li><a href="signup.php">Sign up</a></li>';
                        echo '<li><a href="login.php">Log in</a></li>';
                    }
                    // add a little admin page for more practice
                    if (isset($_SESSION["useruid"])) {
                        echo $_SESSION["useruid"] == "Admin" ? '<li><a href="admin.php">Admin</a></li>' : null;
                    }
                    echo '<li><a href="upload.php">Upload</a></li>';
                ?>

            </ul>
        </nav>
    </div>
</header>