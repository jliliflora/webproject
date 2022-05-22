<?php
    $host = "localhost";
    $user = "jliliflora";
    $pass = "sy72947294!";
    $db = "jliliflora";
    $connect = new mysqli($host, $user, $pass, $db);
    $connect -> set_charset("utf8");

    if (mysqli_connect_errno()) {
        echo "DATABASE connect false";
    } else {
        //echo "DATABASE connect true";
    }
?>