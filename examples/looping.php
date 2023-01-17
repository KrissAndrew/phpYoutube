<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Learning Index Page</title>
</head>
<body>
<?php
    $x = 1;

    // while
    while ($x <= 5) { echo 'While'.$x++.'<br>'; }

    echo '<br>';
    // do while - the statement will always run once
    $x = 10;
    do { echo 'Do '.$x--.'<br>'; } while ($x <= 5);

    echo '<br>';
    // for loop
    for ($x = 1; $x <= 10; $x++) { echo "for ". $x.'<br>'; };

    echo '<br>';
    // foreach
    $array = array('1', '2', '3');
    foreach ($array as $item) { echo 'foreach '.$item.'<br>'; };
?>
</body>
</html>
