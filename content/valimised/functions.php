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
            echo "<td>".nl2br(htmlspecialchars($kommentaarid))."</td>";
            echo '</tr>';
        }
    }