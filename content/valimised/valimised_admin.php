<?php
    require ("config.php");
    global $connect;

    include("valimised_queries.php");

    $_SESSION["is_admin"] = true;

    //Näitamine
    if (!empty($_REQUEST["naita"]))
    {
        $query = $connect->prepare("UPDATE valimised SET avalik=1 WHERE id = ?");
        $query->bind_param("i", $_REQUEST["naita"]);
        $query->execute();
        header("Location: " . $_SERVER["PHP_SELF"]);
    }

    //Peida
    if (!empty($_REQUEST["peida"]))
    {
        $query = $connect->prepare("UPDATE valimised SET avalik=0 WHERE id = ?");
        $query->bind_param("i", $_REQUEST["peida"]);
        $query->execute();
        header("Location: " . $_SERVER["PHP_SELF"]);
    }

    if (!empty($_REQUEST["kustuta"]))
    {
        $query = $connect->prepare("DELETE FROM valimised WHERE id = ?");
        $query->bind_param("i", $_REQUEST["kustuta"]);
        $query->execute();
        header("Location: " . $_SERVER["PHP_SELF"]);
    }

    if (!empty($_REQUEST["punktid_nulliks"]))
    {
        $query = $connect->prepare("UPDATE valimised SET punktid = 0 WHERE id = ?");
        $query->bind_param("i", $_REQUEST["punktid_nulliks"]);
        $query->execute();
        header("Location: " . $_SERVER["PHP_SELF"]);
    }

    /*ADMIN:
        1. DELETE presedenti kandidaadi
        2. Punktid nulliks
        3. Ei saa +1/-1 punkt
        4. Admin kohe saab lisada avalikuse staatus
    */

    if (!empty($_REQUEST["kustuta_kommentaarid"]))
    {
        $query = $connect->prepare("UPDATE valimised SET kommentaarid = '' WHERE id = ?");
        $query->bind_param("i", $_REQUEST["kustuta_kommentaarid"]);
        $query->execute();
        header("Location: " . $_SERVER["PHP_SELF"]);
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Valimiste leht</title>
    <link rel="stylesheet"  href="style.css">
</head>
<body>
    <h1>TARpv24 presidendi Valimised - Admin</h1>

    <?php
        include ("nav.php");
    ?>

    <table>
        <tr>
            <th>ID</th>
            <th>President</th>
            <th>Pilt</th>
            <th>Punktid</th>
            <th>Lisamisaeg</th>
            <th>Haldus</th>
            <th>Kommentaarid</th>
        </tr>
        <?php
            $query = $connect->prepare("SELECT id, president, pilt, punktid, lisamisaeg, avalik, kommentaarid FROM valimised");
            $query->bind_result($id, $president, $pilt, $punktid, $lisamisaeg, $avalik, $kommentaarid);
            $query->execute();
            while($query->fetch())
            {
                echo "<tr>";
                echo "<td>$id</td>";
                echo "<td>$president</td>";
                echo "<td><img src=$pilt' alt='President pilt'></td>";
                echo "<td>$punktid - <a href='?punktid_nulliks=$id'>Nulliks</a></td>";
                echo "<td>$lisamisaeg</td>";
                $tekst = "Näita";
                $seisund = "naita";
                $tekstLehel = "Peidatud";

                if ($avalik == 1)
                {
                    $tekstLehel = "Näidatud";
                    $seisund = "peida";
                    $tekst = "Peida";
                }

                echo "<td class='$seisund'>$tekstLehel - <a href='?$seisund=$id'>$tekst</a></td>";
                echo "<td>
                        <div style='display: flex; flex-direction: row; gap: 20px: justify-content: center; align-items: center;'>
                            <div style='flex: 1 1'>".nl2br(htmlspecialchars($kommentaarid))."</div>
                            <a href='?kustuta_kommentaarid=$id'>Kustuta</a>
                        </div>
                    </td>";
                echo "<td><a href='?kustuta=$id'>Kustuta</a></td>";
                echo "</tr>";
            }
        ?>
    </table>

    <?php
        include ("lisa_president_form.php");
    ?>
</body>
</html>
<?php
    $connect->close();
?>