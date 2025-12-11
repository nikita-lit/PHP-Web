<?php if (isset($_GET["code"])) {die(highlight_file(__FILE__, 1));} ?>

<?php
    require ('config.php');
    global $connect;
?>

<h1 style="margin: 20px">Galerii</h1>

<div style="display: flex; flex-direction: column-reverse; gap: 10px;">
    <div class="product-container">
        <?php
            $query = $connect->prepare("SELECT id, image FROM products");
            $query->bind_result($id, $image);
            $query->execute();

            while($query->fetch())
            {
                echo "<div class='product' style='
                    width: 300px;
                    height: 300px; 
                    align-items: center;
                    justify-content: center;'>";
                $link = $_SERVER["PHP_SELF"]."?link=".$_REQUEST["link"].'&id='.$id;
                echo "<a href='".$link."'><img src='$image' alt='pilt' style='width: 250px; height: 250px'></a>";
                echo "</div>";
            }
        ?>
    </div>

    <div style="width: 100%; display: flex; align-items: center; align-items: center; justify-content: center;">
        <?php
            if (!empty($_REQUEST["id"]))
            {
                $query = $connect->prepare("SELECT id, name, description, price, image FROM products WHERE id=?");
                $query->bind_param("i", $_REQUEST["id"]);
                $query->bind_result($id, $name, $desc, $price, $image);
                $query->execute();

                if ($query->fetch())
                {
                    echo "<div class='product' style='
                        height: 400px; 
                        width: 400px;
                        align-items: center; 
                        justify-content: center;
                    '>";
                    echo "<img src='$image' alt='pilt' style='width: 250px; height: 250px'>";
                    echo "<h2>".htmlspecialchars($name)."</h2>";
                    echo "<div>".htmlspecialchars($desc)."</div>";
                    echo "<div>".htmlspecialchars($price)." €</div>";
                    echo "</div>";
                }
            }
        ?>
    </div>
</div>

<?php
    $connect->close();
?>