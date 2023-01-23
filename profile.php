<?php
    $pageTitle = 'Profile Page'; 
    $css = array('profile.css');
    include_once 'header.php';
    include_once 'includes/dbh.inc.php';
    include_once 'functions/profile-functions.php';

    // Ensure the user cannot get here without being logged in
    if (!isset($_SESSION["useruid"])) { 
        header("Location: index.php?nologin");
    }
?>

<body>
    <div class="wrapper">
        <section class="upload_intro">
            <h1>Profile Page</h1>
            <p>This page will provide a dynamically loaded collection of data related to the user.</p>
            <!-- change action -->
            <?php
                loadProfileImage($connection);
            ?>
            <form action="includes/upload.inc.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="file">
                <button type="submit" name="submit">Upload</button>
            </form>
        </section>
    </div>

<?php
    include_once 'footer.php';
?>