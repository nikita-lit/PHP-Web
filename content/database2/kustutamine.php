<?php
    require ('config.php');
    global $connect;

    //kustutamine
    if(isSet($_REQUEST["kustutusid"]))
    {
        $kask = $connect->prepare("DELETE FROM lehed WHERE id=?");
        $kask->bind_param("i", $_REQUEST["kustutusid"]);
        $kask->execute();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teated lehel</title>
</head>
<body>
    <h1>Teadete loetelu</h1>
    <?php
    $kask = $connect->prepare("SELECT id, pealkiri, sisu FROM lehed");
    $kask->bind_result($id, $pealkiri, $sisu);
    $kask->execute();

    while($kask->fetch())
    {
        echo "<h2>".htmlspecialchars($pealkiri)."</h2>";
        echo "<div>".htmlspecialchars($sisu)."</div>";
        echo "<br><a href='$_SERVER[PHP_SELF]?kustutusid=$id'>kustuta</a>";
    }
    ?>
    </body>
</html>

<?php
    $connect->close();
?>
