<?php
    require('config.php');
    global $connect;

    if (isset($_REQUEST["uusleht"]))
    {
        $kask = $connect->prepare("INSERT INTO products (name, description, price) VALUES (?, ?, ?)");
        $kask->bind_param("ssd", $_REQUEST["name"], $_REQUEST["desc"], $_REQUEST["price"]);
        $kask->execute();
        header("Location: " . $_SERVER["PHP_SELF"]);
        $connect->close();
        exit();
    }

    if (isset($_REQUEST["kustutusid"]))
    {
        $kask = $connect->prepare("DELETE FROM products WHERE id=?");
        $kask->bind_param("i", $_REQUEST["kustutusid"]);
        $kask->execute();
    }

    if (isset($_REQUEST["muutmisid"]))
    {
        $kask = $connect->prepare("UPDATE products SET name=?, description=?, price=? WHERE id=?");
        $kask->bind_param("ssi",
            $_REQUEST["name"],
            $_REQUEST["desc"],
            $_REQUEST["price"]
        );
        $kask->execute();
    }
?>

<div id="admin_menu">
    <h2>Tooted</h2>
    <ul>
        <?php
        $kask = $connect->prepare("SELECT id, name FROM products");
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
    if (isset($_REQUEST["id"]))
    {
        $kask = $connect->prepare("SELECT id, pealkiri, sisu FROM lehed WHERE id=?");
        $kask->bind_param("i", $_REQUEST["id"]);
        $kask->bind_result($id, $pealkiri, $sisu);
        $kask->execute();

        if ($kask->fetch())
        {
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

<?php
    $connect->close();
?>