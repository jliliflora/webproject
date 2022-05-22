<?php
    if( isset($_SESSION['memberID'])){

    } else {
        Header("Location: ../login/login.php");
    }
?>