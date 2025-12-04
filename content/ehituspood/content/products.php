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
while($query->fetch())
{
    echo "<div class='product'>";
    echo "<h2>".htmlspecialchars($name)."</h2>";
    echo "<div>".htmlspecialchars($desc)."</div>";
    echo "<div>".htmlspecialchars($price)."</div>";
    echo "</div>";
}
?>
</div>

<?php
    $connect->close();
?>
