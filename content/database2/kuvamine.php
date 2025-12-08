<?php
    require ('config.php');
    global $connect;

    $kask = $connect->prepare("SELECT id, pealkiri, sisu FROM lehed");
    $kask->bind_result($id, $pealkiri, $sisu);
    $kask->execute();
?><

<!DOCTYPE html>
<html>
<head>
    <title>Teated lehel</title>
</head>
<body>
    <h1>Teadete loetelu</h1>
    <?php
    while($kask->fetch())
    {
        echo "<h2>".htmlspecialchars($pealkiri)."</h2>";
        echo "<div>".htmlspecialchars($sisu)."</div>";
    }
    ?>
</body>
</html>>

<?php
    $connect->close();
?>