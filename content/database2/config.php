<?php
    $servername = "d141131.mysql.zonevs.eu";
    $username = "d141131_nikita";
    $password = "";
    $dbname = "d141131_phpbaas";
    $connect = new mysqli($servername, $username, $password, $dbname);
    $connect->set_charset("utf8");
