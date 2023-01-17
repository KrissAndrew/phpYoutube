<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Learning Index Page</title>
</head>
<?php
isset($_REQUEST['num1']) ? $result1 = $_REQUEST['num1'] : $result1 = null;
isset($_REQUEST['percent']) ? $result2 = $_REQUEST['percent'] : $result2 = null;
?>
<body>
<form>
    <input type = "text" name = "num1" placeholder = "Number 1" value = <?php print($result1)?>>
    <input type = "text" name = "percent" placeholder = "%" value = <?php print($result2)?>>
    <br>
    <button type = "submit" name = "submit" value = "submit">Calculate</button>
</form>
<p>The answer is:</p>
<?php

    /**
     * Returns the specified percentage of the given integer
     * @param integer $integer Integer to find percentage of
     * @param integer $percentage Percentage of provided integer you wish to return
     * @return integer The percentage specified of the provided integer
     */
    function utils_percentage($integer, $percentage) {
        $percentage *= 0.01;
        return $integer * $percentage;
    }

    if (isset($_REQUEST['submit'])) {
        $result1 = $_REQUEST['num1'];
        $result2 = $_REQUEST['percent'];
        echo utils_percentage($result1, $result2);
    }
?>
</body>
</html>
