<?php
    require('config.php');
    global $connect;

    // Uue teate lisamine
    if (isset($_REQUEST["uusleht"]))
    {
        $kask = $connect->prepare("INSERT INTO lehed (pealkiri, sisu) VALUES (?, ?)");
        $kask->bind_param("ss", $_REQUEST["pealkiri"], $_REQUEST["sisu"]);
        $kask->execute();
        header("Location: " . $_SERVER["PHP_SELF"]);
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

    // Teate muutmine
    if (isset($_REQUEST["muutmisid"]))
    {
        $kask = $connect->prepare("UPDATE lehed SET pealkiri=?, sisu=? WHERE id=?");
        $kask->bind_param("ssi",
            $_REQUEST["pealkiri"],
            $_REQUEST["sisu"],
            $_REQUEST["muutmisid"]
        );
        $kask->execute();
    }
?>
<!DOCTYPE html>
<html lang="et">
<head>
    <title>Teated lehel</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">

    <link rel="stylesheet" href="style.css">
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
                    echo "<li><a href='" . $_SERVER["PHP_SELF"] .
                        "?id=$id'>" . htmlspecialchars($pealkiri) . "</a></li>";
                }
            ?>
        </ul>

        <a href="<?= $_SERVER['PHP_SELF'] ?>?lisamine=jah">Lisa...</a>
    </div>

    <div id="sisukiht">
        <?php
        // Ühe teate kuvamine või muutmine
        if (isset($_REQUEST["id"]))
        {
            $kask = $connect->prepare("SELECT id, pealkiri, sisu FROM lehed WHERE id=?");
            $kask->bind_param("i", $_REQUEST["id"]);
            $kask->bind_result($id, $pealkiri, $sisu);
            $kask->execute();

            if ($kask->fetch())
            {
                // Muutmise vorm
                if (isset($_REQUEST["muutmine"]))
                {
                    echo "
                    <form action='".$_SERVER["PHP_SELF"]."'>
                        <input type='hidden' name='muutmisid' value='$id'/>
                        <h2>Teate muutmine</h2>
                        <dl>
                            <dt>Pealkiri:</dt>
                            <dd>
                                <input type='text' name='pealkiri' value='".htmlspecialchars($pealkiri)."'/>
                            </dd>
    
                            <dt>Teate sisu:</dt>
                            <dd>
                                <textarea rows='20' cols='30' name='sisu'>".htmlspecialchars($sisu)."</textarea>
                            </dd>
                        </dl>
                        <input type='submit' value='Muuda'/>
                    </form>";
                }
                else
                {
                    // Ühe teate kuvamine
                    echo "<h2>" . htmlspecialchars($pealkiri) . "</h2>";
                    echo nl2br(htmlspecialchars($sisu));

                    echo "<br /><a href='" . $_SERVER["PHP_SELF"]."?kustutusid=$id'>Kustuta</a> ";

                    echo "<a href='".$_SERVER["PHP_SELF"]."?id=$id&amp;muutmine=jah'>Muuda</a>";
                }
            }
            else
                echo "Vigased andmed.";
        }

        // Uue teate lisamise vorm
        if (isset($_REQUEST["lisamine"]))
        {
        ?>
            <form action="<?= $_SERVER["PHP_SELF"] ?>">
                <input type="hidden" name="uusleht" value="jah" />
                <h2>Uue teate lisamine</h2>

                <dl>
                    <dt>Pealkiri:</dt>
                    <dd><input type="text" name="pealkiri"/></dd>

                    <dt>Teate sisu:</dt>
                    <dd><textarea rows="20" cols="30" name="sisu"></textarea></dd>
                </dl>

                <input type="submit" value="Sisesta"/>
            </form>
        <?php
        }
        ?>
    </div>

    <div id="jalusekiht">
        Lehe tegi Nikita Litvinenko
    </div>
</body>
</html>

<?php
    $connect->close();
?>