<?php
    require_once("konf.php");

    function Registreeri($eesnimi, $perekonnanimi)
    {
        global $yhendus;

        $kask = $yhendus->prepare("INSERT INTO jalgrattaeksam(eesnimi, perekonnanimi) VALUES (?, ?)"); 
        $kask->bind_param("ss", $eesnimi, $perekonnanimi); 
        $kask->execute();
        $yhendus->close();
    }
?>