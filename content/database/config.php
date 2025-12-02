<?php
    // kasutame kohalik arvuti
    $servername = "localhost";
    $username = "nikitalitvinenko";
    $password = "1234";
    $dbname = "nikitalitvinenko";
    $connect = new mysqli($servername, $username, $password, $dbname);
    $connect->set_charset("utf8");

    /*
    // zone.ee
    $servername = "d141131.mysql.zonevs.eu";
    $username = "d141131_nikita";
    $password = "";
    $dbname = "d141131_phpbaas";
    $connect = new mysqli($servername, $username, $password, $dbname);
    $connect->set_charset("utf8");
    */