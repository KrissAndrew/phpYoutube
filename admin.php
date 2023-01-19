<?php
    $pageTitle = 'Admin Page'; 
    $css = array('Admin.css');
    include_once 'includes/dbh.inc.php';
    include_once 'functions/admin-functions.php';
    include_once 'header.php';
?>

<body>
    <section class="admin_intro">
            <h1>Admin Page placeholder</h1>
            <p>Chuck in some administrative options here, perhaps edit/delete users. This will allow for more db practice.</p>
    </section>
    <div class="table-wrapper">
        <table>
            <tr>
                <th>Username</th>
                <th>Email Address</th>
                <th>Test</th>
            </tr>
        <?php
            displayUsers($connection);
        ?>
            </tr>
    </div>

<?php
    include_once 'footer.php';
?>