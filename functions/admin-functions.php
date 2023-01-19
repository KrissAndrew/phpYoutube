<?php

function displayUsers($connection) {
    $sql = "SELECT * FROM users";
    $result = mysqli_query($connection, $sql);
    $data = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }
    // print_r($data);
    $count = 1;
    foreach ($data as $user) {
        echo "<td>".$user['user_uid']."</td>".
        "<td>".$user['user_email']."</td>".
        "<td>"."test"."</td>".
        "</tr>";
        $count++;
    }
}