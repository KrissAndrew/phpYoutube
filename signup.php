<?php
    $pageTitle = "Signup Page";
    $css = array('signup.css');
    include 'header.php';
?>

<body>
    <section class="signup-form">
        <h2>Signup</h2>
        <form action='includes/signup.inc.php' method="POST">
            <?php
                if (isset($_REQUEST['firstname'])) {
                    $firstname = $_REQUEST['firstname'];
                    echo '<input type="text" name="first" placeholder="First Name" value="'.$firstname.'">';
                } else {
                    echo '<input type="text" name="first" placeholder="First Name"';
                }
                echo '<br>';
                if (isset($_REQUEST['lastname'])) {
                    $lastname = $_REQUEST['lastname'];
                    echo '<input type="text" name="last" placeholder="Surname" value="'.$lastname.'">';
                } else {
                    echo '<input type="text" name="last" placeholder="Surname">';
                }
                echo '<br>';
                if (isset($_REQUEST['email'])) {
                    $email = $_REQUEST['email'];
                    echo '<input type="text" name="email" placeholder="Email" value="'.$email.'">';
                } else {
                    echo '<input type="text" name="email" placeholder="E-mail">';
                }
                echo '<br>';
                if (isset($_REQUEST['uid'])) {
                    $uid = $_REQUEST['uid'];
                    echo '<input type="text" name="uid" placeholder="Username" value="'.$uid.'">';
                } else {
                    echo '<input type="text" name="uid" placeholder="Username"';
                }
                echo '<br>';
            ?>
            <input type="password" name='pwd' placeholder="Password">
            <br>
            <input type="password" name='pwdrepeat' placeholder="Repeat Password">
            <br>
            <button type = "submit" name = "submit" value = "submit">Sign up</button>
        </form>
    </section>
<?php
    $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if (strpos($fullUrl, "signup=empty") == true) {
        echo "<p class='error'>Ensure no fields are empty.</p>";
        exit();
    } elseif (strpos($fullUrl, "signup=invalidemail") == true) {
        echo "<p class='error'>Invalid email address detected.</p>";
        exit();
    } elseif (strpos($fullUrl, "signup=char") == true) {
        echo "<p class='error'>Names must consist of characters only.</p>";
        exit();
    } elseif (strpos($fullUrl, "signup=nomatch") == true) {
        echo "<p class='error'>Provided passwords do not match.</p>";
        exit();
    } elseif (strpos($fullUrl, "signup=badid") == true) {
        echo "<p class='error'>Username must contain letters and numbers only.</p>";
        exit();
    } elseif (strpos($fullUrl, "signup=nameexists") == true) {
        echo "<p class='error'>Username already exists.</p>";
        exit();
    } elseif (strpos($fullUrl, "signup=emailexists") == true) {
        echo "<p class='error'>Email address already exists.</p>";
        exit();
    } elseif (strpos($fullUrl, "signup=success") == true) {
        echo "<p class='success'>Signed up successfully.</p>";
        exit();
    }
?>

<?php
    include_once "footer.php";
?>