<?php
    $auth->LogoutUser();
    //header("Location: index.php");
    echo "<script>window.location.href = 'index.php';</script>";
    exit();