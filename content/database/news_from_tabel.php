<?php
    require ("config.php");
    global $connect;

    // kustutamine
    if (isset($_REQUEST["delete"]))
    {
        $query = $connect->prepare("DELETE FROM uudised WHERE UudisedID = ?");
        $query->bind_param("i", $_REQUEST["delete"]);
        // i - integer, s - string, d - double
        $query->execute();
    }
?>
<!DOCTYPE html>
<html lang="et">
<head>
    <link rel="stylesheet" href="news_from_tabel.css">
    <title>Uudised SQL andmebaasist</title>
</head>
<body>
    <div id="news_container">
        <h1>Uudiste tabeli sisu</h1>

        <table id="news_table">
            <tr>
                <th>JRK</th>
                <th>Pealkiri</th>
                <th>Kuupäev</th>
                <th>Kirjeldus</th>
                <th>Tuju</th>
            </tr>

            <?php
                $query = $connect->prepare("SELECT UudisedID, Pealkiri, Kuupaev, Kirjeldus, Tuju FROM uudised");
                $query->bind_result($id, $pealkiri, $kuupaev, $kirjeldus, $tuju);
                $query->execute();

                while($query->fetch())
                {
                    echo "<tr>";
                    echo "<td style='text-align: center'>".$id."</td>";
                    echo "<td style='background: $tuju'>".$pealkiri."</td>";
                    echo "<td>".$kuupaev."</td>";
                    echo "<td>".$kirjeldus."</td>";
                    echo "<td>".$tuju."</td>";
                    echo "<td><a href='?delete=$id' class='news-button'>Kustuta</a>";
                    echo "</tr>";
                }
            ?>
        </table>

        <br>

        <div style="display: flex; flex-direction: column; width: 300px; margin-top: 20px">
            <a href="add_news.php" class="news-button">Lisa uudis</a>
            <a href="news_from_tabel_link.php" class="news-button">Uudised SQL andmebaasist (link)</a>
        </div>
    </div>
</body>
</html>
