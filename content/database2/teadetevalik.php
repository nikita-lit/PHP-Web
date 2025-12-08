<?php
    require('config.php');
    global $connect;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teated lehel</title>
    <style type="text/css">
        #menyykiht {
            float: left;
            padding-right: 30px;
        }
        #sisukiht {
            float:left;
        }
        #jalusekiht {
            clear: left;
        }
    </style>
</head>
<body>
    <div id="menyykiht">
        <h2>Teated</h2>
        <ul>
            <?php
            $kask = $connect->prepare("SELECT id, pealkiri FROM lehed");
            $kask->bind_result($id, $pealkiri);
            $kask->execute();

            while($kask->fetch()){
                echo "<li><a href='teadetevalik.php?id=$id'>".
                    htmlspecialchars($pealkiri)."</a></li>";
            }
            ?>
        </ul>
    </div>

    <div id="sisukiht">
        <?php
        if(isSet($_REQUEST["id"]))
        {
            $kask = $connect->prepare("SELECT id, pealkiri, sisu FROM lehed
                               WHERE id=?");
            $kask->bind_param("i", $_REQUEST["id"]);
            $kask->bind_result($id, $pealkiri, $sisu);
            $kask->execute();

            if($kask->fetch())
            {
                echo "<h2>".htmlspecialchars($pealkiri)."</h2>";
                echo htmlspecialchars($sisu);
            }
            else
                echo "Vigased andmed.";
        }
        else
            echo "Tere tulemast avalehele! Vali menüüst sobiv teema.";
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