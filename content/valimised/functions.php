<?php
    require ("config.php");

    // +1 punkt
    function LisaPunkt($id)
    {
        global $connect;
        $query = $connect->prepare("UPDATE valimised SET punktid = punktid + 1 WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        header("Location: " . $_SERVER["PHP_SELF"].'?id='.$id); // aadressi puhastab päring ja jääb faili nimi
        $connect->close();
    }