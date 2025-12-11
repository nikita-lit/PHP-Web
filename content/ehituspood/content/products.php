<?php if (isset($_GET["code"])) {die(highlight_file(__FILE__, 1));} ?>

<?php
    require ('config.php');
    global $connect;

    $query = $connect->prepare("SELECT id, name, description, price FROM products");
    $query->bind_result($id, $name, $desc, $price);
    $query->execute();
?>

<h1 style="margin: 20px">Tooted</h1>
<div class="product-container">
    <?php  
        echo "<table id='product_table'>";
            echo "<tr>";
                echo "<th>Nimi</th>";
                echo "<th>Kirjandus</th>";
                echo "<th>Hind</th>";
            echo "</tr>";
        
        while($query->fetch())
        {
            echo "<tr>";
            echo "<td>".htmlspecialchars($name)."</td>";
            echo "<td>".htmlspecialchars($desc)."</td>";
            echo "<td>".htmlspecialchars($price)." €</td>";
            echo "</tr>";
        }
        echo "</table>";
    ?>
</div>

<?php
    $connect->close();
?>
