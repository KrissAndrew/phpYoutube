<?php
    $pageTitle = 'Login Page'; 
    $css = array('login.css');
    include_once 'header.php';
?>

<body>
<section class="signup-form">
        <h2>Login</h2>
        <form action='includes/login.inc.php' method="POST">
            <?php
                if (isset($_REQUEST['uid'])) {
                    $uid = $_REQUEST['uid'];
                    echo '<input type="text" name="uid" placeholder="Username/Email" value="'.$uid.'">';
                } else {
                    echo '<input type="text" name="uid" placeholder="Username/Email"';
                }
                echo '<br>';
            ?>
            <input type="password" name='pwd' placeholder="Password">
            <br>
            <button type = "submit" name = "submit" value = "submit">Sign up</button>
        </form>
    </section>

<?php
    $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if (strpos($fullUrl, "login=empty") == true) {
        echo "<p class='error'>Ensure no fields are empty.</p>";
        exit();
    } elseif (strpos($fullUrl, "login=baduid") == true) {
        echo "<p class='error'>No such username/email exists.</p>";
        exit();
    } elseif (strpos($fullUrl, "login=wronglogin") == true) {
        echo "<p class='error'>Incorrect Password.</p>";
        exit();
    } 
    include_once 'footer.php';
?>