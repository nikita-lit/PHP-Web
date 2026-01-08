<?php
    $autod = simplexml_load_file("autod.xml");
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <title>Autod XML failist</title>
</head>
<body>
    <h1>Autod XML failist</h1>
    <?php
        //esimene auto
        echo "Esimene auto: ".$autod->auto[0]->regnumber;
    ?>
</body>
</html>