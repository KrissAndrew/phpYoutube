<?php
    $pageTitle = 'Home Page'; 
    $css = array('index.css');
    include_once 'header.php';
?>

<body>
    <div class="wrapper">
        <section class="index_intro">
            <?php
                if (isset($_SESSION["useruid"])) {
                    echo "<p>Welcome ". $_SESSION["useruid"]."</p>";
                }
            ?>
            <h1>Index Page placeholder</h1>
            <p>Important information about the website can go here. Explains the purpose or shows nice pictures/videos.</p>
        </section>
    </div>

<?php
    include_once 'footer.php';
?>