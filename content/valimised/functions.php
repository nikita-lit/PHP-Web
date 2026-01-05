<?php
    require ("config.php");

    // +1 punkt
    function LisaPunkt($id)
    {
        global $connect;
        $query = $connect->prepare("UPDATE valimised SET punktid = punktid + 1 WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        $connect->close();
    }

    // -1 punkt
    function KustutaPunkt($id)
    {
        global $connect;
        $query = $connect->prepare("UPDATE valimised SET punktid = punktid - 1 WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        $connect->close();
    }

    function NaitaTabel()
    {
        global $connect;
        $query = $connect->prepare("SELECT id, president, pilt, punktid, lisamisaeg, kommentaarid FROM valimised WHERE avalik=1");
        $query->bind_result($id, $president, $pilt, $punktid, $lisamisaeg, $kommentaarid);
        $query->execute();

        while($query->fetch())
        {
            echo "<tr>";
            echo "<td>{$id}</td>";
            echo "<td>{$president}</td>";
            echo "<td><img src=$pilt' alt='President pilt'></td>";
            echo "<td>{$punktid}</td>";
            echo "<td>{$lisamisaeg}</td>";
            echo "<td><a href='?lisa1punkt={$id}'>+1 punkt</a></td>";
            echo "<td><a href='?lisa-1punkt={$id}'>-1 punkt</a></td>";
            echo "<td><a href='?kustuta={$id}'>Kustuta</a></td>";
            echo "<td>".nl2br(htmlspecialchars($kommentaarid))."</td>";
            echo '</tr>';
        }

        $connect->close();
    }

    function LisaPresident($president, $pilt, $punktid, $avalik)
    {
        global $connect;
        $query = $connect->prepare("INSERT INTO valimised (president, pilt, punktid, avalik, lisamisaeg) VALUES (?, ?, ?, ?, NOW())");
        $query->bind_param("ssii", $president, $pilt, $punktid, $avalik);
        $query->execute();
        $connect->close();
    }

    function KustutaPresident($id)
    {
        global $connect;
        $query = $connect->prepare("DELETE FROM valimised WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        $connect->close();
    }