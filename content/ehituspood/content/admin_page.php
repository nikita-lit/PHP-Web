<?php if (isset($_GET["code"])) {die(highlight_file(__FILE__, 1));} ?>
<?php
    require('config.php');
    global $connect;

    if (!empty($_REQUEST["uusleht"]) && !empty($_REQUEST["name"]))
    {
        $kask = $connect->prepare("INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)");
        $kask->bind_param("ssds", $_REQUEST["name"], $_REQUEST["desc"], $_REQUEST["price"], $_REQUEST["image"]);
        $kask->execute();

        header("Location: ".$_SERVER["PHP_SELF"]."?link=".$_REQUEST["link"]);
    }

    if (!empty($_REQUEST["kustutusid"]))
    {
        $kask = $connect->prepare("DELETE FROM products WHERE id=?");
        $kask->bind_param("i", $_REQUEST["kustutusid"]);
        $kask->execute();

        header("Location: ".$_SERVER["PHP_SELF"]."?link=".$_REQUEST["link"]);
    }

    if (!empty($_REQUEST["muutmisid"]) && !empty($_REQUEST["name"]))
    {
        $kask = $connect->prepare("UPDATE products SET name=?, description=?, price=?, image=? WHERE id=?");
        $kask->bind_param("ssdsi",
            $_REQUEST["name"],
            $_REQUEST["desc"],
            $_REQUEST["price"],
            $_REQUEST["image"],
            $_REQUEST["id"]
        );
        $kask->execute();

        header("Location: ".$_SERVER["PHP_SELF"]."?link=".$_REQUEST["link"]."&id=".$_REQUEST["id"]);
    }
?>

<div class="flex-container" style="flex-direction: row">
    <div id="admin_menu">
        <h2>Tooted</h2>
        <ul>
            <?php
            $kask = $connect->prepare("SELECT id, name FROM products");
            $kask->bind_result($id, $pealkiri);
            $kask->execute();

            while ($kask->fetch()) 
            {
                echo "<li><a href='".$_SERVER["PHP_SELF"]."?link=".$_REQUEST["link"]."&id=$id'>"
                    .htmlspecialchars($pealkiri).
                    "</a></li>";
            }
            ?>
        </ul>

        <a href="<?= $_SERVER['PHP_SELF']."?link=".$_REQUEST["link"] ?>&lisamine=1">Lisa...</a>
    </div>

    <div>
        <?php
        if (!empty($_REQUEST["id"]))
        {
            $kask = $connect->prepare("SELECT id, name, description, price, image FROM products WHERE id=?");
            $kask->bind_param("i", $_REQUEST["id"]);
            $kask->bind_result($id, $name, $desc, $price, $image);
            $kask->execute();

            if ($kask->fetch())
            {
                if (!empty($_REQUEST["muutmine"]))
                {
                    $link = $_SERVER["PHP_SELF"]."?link=".$_REQUEST["link"];
                    echo '<form action="'.$link.'&muutmisid=1&id='.$id.'" method="post" id="product_form">
                        <h2>Toote muutmine</h2>
        
                        <div style="display: flex; flex-direction: column; gap: 5px">
                            <label for="name">Nimi:</label>
                            <input type="text" id="name" name="name" value='.$name.' style="margin-left: 30px">
                        </div>
        
                        <div style="display: flex; flex-direction: column; gap: 5px">
                            <label for="desc">Kirjandus:</label>
                            <textarea name="desc" id="desc" style="margin-left: 30px">'.$desc.'</textarea>
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 5px">
                            <label for="image">Pilt:</label>
                            <textarea name="image" id="image" style="margin-left: 30px">'.$image.'</textarea>
                        </div>
        
                        <div style="display: flex; flex-direction: column; gap: 5px">
                            <label for="price">Hind:</label>
                            <input type="number" name="price" id="price" value='.$price.' min="0" max="10000" step="0.01" style="margin-left: 30px;">
                        </div>
        
                        <input type="submit" value="Muuda" style="
                            height: 30px;
                            width: 80px;
                            font-size: 15px;">
                    </form>';
                }
                else
                {
                    echo "<div class='product'>";
                    echo "<img src='$image' alt='pilt' style='width: 100px; height: 100px'>";
                    echo "<h2>".htmlspecialchars($name)."</h2>";
                    echo "<div>".htmlspecialchars($desc)."</div>";
                    echo "<div>".htmlspecialchars($price)." €</div>";
                    echo "<div style='
                        display: flex; 
                        flex-direction: 
                        column; gap: 5px; 
                        background: #ecebeb; 
                        padding: 10px; 
                        border-radius: 5px;'>";
                        $link = $_SERVER["PHP_SELF"]."?link=".$_REQUEST["link"];
                        echo "<a href='$link&muutmine=1&id=$id'>Muuda</a>";
                        echo "<a href='$link&kustutusid=$id'>Kustuta</a>";
                    echo "</div>";
                    echo "</div>";
                }
            }
            else
                echo "Vigased andmed.";
        }
        else if (!empty($_REQUEST["lisamine"]))
        {
            $link = $_SERVER["PHP_SELF"]."?link=".$_REQUEST["link"];
            echo '<form action="'.$link.'&uusleht=1" method="post" id="product_form">
                <h2>Uue toote lisamine</h2>

                <div style="display: flex; flex-direction: column; gap: 5px">
                    <label for="name">Nimi:</label>
                    <input type="text" id="name" name="name" style="margin-left: 30px">
                </div>

                <div style="display: flex; flex-direction: column; gap: 5px">
                    <label for="desc">Kirjandus:</label>
                    <textarea name="desc" id="desc" style="margin-left: 30px"></textarea>
                </div>

                <div style="display: flex; flex-direction: column; gap: 5px">
                    <label for="image">Pilt:</label>
                    <textarea name="image" id="image" style="margin-left: 30px"></textarea>
                </div>

                <div style="display: flex; flex-direction: column; gap: 5px">
                    <label for="price">Hind:</label>
                    <input type="number" name="price" id="price" min="0" max="10000" step="0.01" style="margin-left: 30px;">
                </div>

                <input type="submit" value="Lisa" style="
                    height: 30px;
                    width: 80px;
                    font-size: 15px;">
            </form>
            <?php';
        }
        else
            echo "<h1>Admin haldusleht</h1>"
        ?>
    </div>
</div>

<?php
    $connect->close();
?>