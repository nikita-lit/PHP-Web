<?php
    /*
    CREATE TABLE valimised (
        id int PRIMARY KEY AUTO_INCREMENT,
        president varchar(50) UNIQUE,
        pilt text,
        lisamisaeg date,
        kommentaarid text,
        punktid int DEFAULT 0,
        avalik boolean DEFAULT 0
    )
    */

    require ("config.php");
    global $connect;

    include("valimised_queries.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Valimiste leht</title>
    <link rel="stylesheet"  href="style.css">
</head>
<body>
    <h1>TARpv24 presidendi Valimised - Kasutaja</h1>

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
            <th>+1 punkt</th>
            <th>-1 punkt</th>
        </tr>
        <?php
            $query = $connect->prepare("SELECT id, president, pilt, punktid, lisamisaeg FROM valimised WHERE avalik=1");
            $query->bind_result($id, $president, $pilt, $punktid, $lisamisaeg);
            $query->execute();
            while($query->fetch())
            {
                echo "<tr>";
                echo "<td>$id</td>";
                echo "<td>$president</td>";
                echo "<td><img src=$pilt' alt='President pilt'></td>";
                echo "<td>$punktid</td>";
                echo "<td>$lisamisaeg</td>";
                echo "<td><a href='?lisa1punkt=$id'>+1 punkt</a></td>";
                echo "<td><a href='?lisa-1punkt=$id'>-1 punkt</a></td>";
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