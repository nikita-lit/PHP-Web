<?php
    require ("config.php");
    global $connect;

    //+1 punkt
    if (isset($_REQUEST["lisa1punkt"]))
    {
        $query = $connect->prepare("UPDATE valimised SET punktid = punktid + 1 WHERE id = ?");
        $query->bind_param("i", $_REQUEST["lisa1punkt"]);
        $query->execute();
        header("Location: " . $_SERVER["PHP_SELF"]); // aadressi puhastab päring ja jääb faili nimi
    }

    //-1 punkt
    if (isset($_REQUEST["lisa-1punkt"]))
    {
        $query = $connect->prepare("UPDATE valimised SET punktid = punktid - 1 WHERE id = ?");
        $query->bind_param("i", $_REQUEST["lisa-1punkt"]);
        $query->execute();
        header("Location: " . $_SERVER["PHP_SELF"]);
    }

    //lisamine admetabelisse
    if (!empty($_REQUEST["president"]))
    {
        $avalik = 0;
        if(!empty($_REQUEST["avalik"]))
            $avalik = $_REQUEST["avalik"];

        $query = $connect->prepare("INSERT INTO valimised (president, pilt, avalik, lisamisaeg) VALUES (?, ?, ?, NOW())");
        $query->bind_param("ssi", $_REQUEST["president"], $_REQUEST["pilt"], $avalik);
        $query->execute();
        header("Location: " . $_SERVER["PHP_SELF"]);
    }

    //Kommentaari lisamine
    if (!empty($_REQUEST["uue_komment_id"]) && !empty($_REQUEST["uus_kommentaar"]))
    {
        $query = $connect->prepare("UPDATE valimised SET kommentaarid = CONCAT(kommentaarid, ?) WHERE id = ?");
        $komment2 = $_REQUEST["uus_kommentaar"]."\n";
        $query->bind_param("si", $komment2, $_REQUEST["uue_komment_id"]);
        $query->execute();
        header("Location: " . $_SERVER["PHP_SELF"]);
    }
?>