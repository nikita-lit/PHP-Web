<?php
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
    <h1>TARpv24 presidendi Valimised - Galerii</h1>

    <?php
        include ("nav.php");
    ?>

    <div style="display: flex; flex-direction: column; gap: 30px;">
        <?php
            $query = $connect->prepare("SELECT id, president, pilt, punktid, lisamisaeg, kommentaarid FROM valimised WHERE avalik=1");
            $query->bind_result($id, $president, $pilt, $punktid, $lisamisaeg, $kommentaarid);
            $query->execute();

            echo "<div style='display: flex; flex-direction: row; gap: 30px;'>";
            while($query->fetch())
            {
                echo "<a href='?id=".$id."'><img src=$pilt' alt='President pilt' style='width: 100px;'></a>";
            }
            echo "</div>";

            if (!empty($_REQUEST["id"]))
            {
                $query = $connect->prepare("SELECT id, president, punktid, lisamisaeg, kommentaarid FROM valimised WHERE avalik=1 AND id=?");
                $query->bind_param("i", $_REQUEST["id"]);
                $query->bind_result($id, $president, $punktid, $lisamisaeg, $kommentaarid);
                $query->execute();

                if ($query->fetch())
                {
                    echo "<div style='
                        display: flex; 
                        flex-direction: column; 
                        gap: 5px; 
                        padding: 5px; 
                        border: 1px black solid;
                        width: 210px;'>";
                        
                        echo "<div>President: $president</div>";
                        echo "<div>Punktid: $punktid</div>";
                        echo "<div>Lisamisaeg: $lisamisaeg</div>";
                        echo "<div><a href='?lisa1punkt=$id'>+1 punkt</a></div>";
                        echo "<div><a href='?lisa-1punkt=$id'>-1 punkt</a></div>";
                        echo "<div>Kommentaarid:<br> ".nl2br(htmlspecialchars($kommentaarid))."</div>";
                        echo "<br>";
                        echo '<div>
                            <form action="?" method="post">
                                <input type="hidden" name="uue_komment_id" value="'.$id.'">

                                <label>
                                    <input type="text" name="uus_kommentaar" id="uus_kommentaar">
                                </label>

                                <input type="submit" value="ok">
                            </form>
                        </div>';
                    echo "</div>";
                }
            }
        ?>
    </div>
</body>
</html>

<?php
    $connect->close();
?>