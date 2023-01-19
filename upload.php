<?php
    $pageTitle = 'Upload Page'; 
    $css = array('upload.css');
    include_once 'header.php';
?>

<body>
    <div class="wrapper">
        <section class="upload_intro">
            <h1>Upload Page</h1>
            <p>This page will provide a simple example of how to upload files using PHP.</p>
            <form action="includes/upload.inc.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="file">
                <button type="submit" name="submit">Upload</button>
            </form>
        </section>
    </div>

<?php
    include_once 'footer.php';
?>