<?php
    // Ühendus andmebaasiga
    require ('config.php');
    global $connect;

    // Uue teate salvestamine
    if (isset($_REQUEST["uusleht"]))
    {
        $kask = $connect->prepare( "INSERT INTO lehed (pealkiri, sisu) VALUES (?, ?)");
        $kask->bind_param("ss", $_REQUEST["pealkiri"], $_REQUEST["sisu"]);
        $kask->execute();
        header("Location: ".$_SERVER["PHP_SELF"]);

        $connect->close();
        exit();
    }

    // Teate kustutamine
    if (isset($_REQUEST["kustutusid"]))
    {
        $kask = $connect->prepare("DELETE FROM lehed WHERE id=?");
        $kask->bind_param("i", $_REQUEST["kustutusid"]);
        $kask->execute();
    }
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Teated lehel</title>
</head>
<body>
    <div id="menyykiht">
        <h2>Teated</h2>
        <ul>
            <?php
                $kask = $connect->prepare("SELECT id, pealkiri FROM lehed");
                $kask->bind_result($id, $pealkiri);
                $kask->execute();

                while ($kask->fetch())
                {
                    echo "<li><a href='".$_SERVER["PHP_SELF"]."?id=$id'>".htmlspecialchars($pealkiri)."</a></li>";
                }
            ?>
        </ul>
        <p>
            <a href="<?=$_SERVER['PHP_SELF']?>?lisamine=jah">Lisa ...</a>
        </p>
    </div>
    <div id="sisukiht">
        <?php

        // Ühe teate kuvamine
        if (isset($_REQUEST["id"]))
        {
            $kask = $connect->prepare("SELECT id, pealkiri, sisu FROM lehed WHERE id=?");
            $kask->bind_param("i", $_REQUEST["id"]);
            $kask->bind_result($id, $pealkiri, $sisu);
            $kask->execute();

            if ($kask->fetch())
            {
                echo "<h2>".htmlspecialchars($pealkiri)."</h2>";
                echo nl2br(htmlspecialchars($sisu));
                echo "<br /><a href='".$_SERVER["PHP_SELF"]."?kustutusid=$id'>kustuta</a>";

            }
            else
                echo "Vigased andmed.";
        }

        // Vormi kuvamine uue teate lisamiseks
        if (isset($_REQUEST["lisamine"]))
        {
        ?>
            <form action="<?=$_SERVER["PHP_SELF"]?>">
                <input type="hidden" name="uusleht" value="jah" />
                <h2>Uue teate lisamine</h2>

                <dl>
                    <dt>Pealkiri:</dt>

                    <dd>
                        <input type="text" name="pealkiri" />
                    </dd>

                    <dt>Teate sisu:</dt>

                    <dd>
                        <textarea rows="20" name="sisu"></textarea>
                    </dd>
                </dl>

                <input type="submit" value="Sisesta" />
            </form>
        <?php
        }
        ?>
    </div>

    <div id="jalusekiht">
        Lehe tegi õpilane ...
    </div>
</body>
</html>

<?php
    $connect->close();
?>


