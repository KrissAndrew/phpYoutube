<?php
if (isset($_REQUEST['submit'])) {
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    // use this to get the extension from the finename, such a jpg, gif, etc
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allow = array('jpg', 'jpeg', 'png', 'pdf', 'gif');

    // Check for errors
    if (!in_array($fileActualExt, $allow)) {
        echo "You cannot upload files of this type";
    } elseif ($fileError === 1){            
        echo "There was an error uploading your file";
    } elseif ($fileSize > 5000000){
        echo "File too large.";
    } else {
        $fileNameNew = uniqid('', true).".".$fileActualExt;
        $fileDestination = '../uploads/' . $fileNameNew;
        move_uploaded_file($fileTmpName, $fileDestination);
        header("Location: ../upload.php?upload=success");
    }
}