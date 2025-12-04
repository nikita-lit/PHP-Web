<?php
    $servername = "localhost";
    $username = "nikitalitvinenko";
    $password = "1234";
    $dbname = "nikitalitvinenko";
    $connect = new mysqli($servername, $username, $password, $dbname);
    $connect->set_charset("utf8");