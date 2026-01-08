<?php
    $autod = simplexml_load_file("autod.xml");

    function OtsingAutonumbri($paring)
    {
        global $autod;
        $tulemus = array();
        foreach($autod->auto as $auto)
        {
            if (substr(strtolower($auto->regnumber), 0, strlen($paring)) == strtolower($paring))
                array_push($tulemus, $auto);            
            else if (substr(strtolower($auto->omanik->eesnimi), 0, strlen($paring)) == strtolower($paring))
                array_push($tulemus, $auto);            
            else if (substr(strtolower($auto->omanik->perenimi), 0, strlen($paring)) == strtolower($paring))
                array_push($tulemus, $auto);
        }

        return $tulemus;
    }
    
    function LisaAuto()
    {
        $xmlDoc = new DOMDocument("1.0", "UTF-8");
        $xmlDoc->preserveWhiteSpace = false;
        $xmlDoc->load("autod.xml");
        $xmlDoc->formatOutput = true;
        
        $xmlAuto = $xmlDoc->createElement("auto");
        $xmlDoc->appendChild($xmlAuto);

        $xmlRoot = $xmlDoc->documentElement;
        $xmlRoot->appendChild($xmlAuto);

        $omanik = $xmlDoc->createElement("omanik");
        $xmlAuto->appendChild($omanik);
        
        foreach($_POST as $voti => $vaartus)
        {
            $kirje = $xmlDoc->createElement($voti, $vaartus);

            if ($voti == "eesnimi" || $voti == "perenimi" || $voti == "isikukood")
                $omanik->appendChild($kirje);
            else
                $xmlAuto->appendChild($kirje);
        }

        $xmlDoc->save("autod.xml");

        unset($_POST["submit"]);
    }

    if(isset($_POST["submit"]))
    {
        LisaAuto();
        header("Location: " . $_SERVER["PHP_SELF"]);
    }
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

    <!-- otsing -->
    <form action="?" method="request">
        <label>
            Otsing:
            <input type="text" name="otsing" id="otsing" placeholder="Autonumber/nimi...">

            <input type="submit" value="OK">
        </label>
    </form>

    <?php
        $tulemus = $autod->auto;
        if (!empty($_REQUEST["otsing"]))
        {
            $tulemus = OtsingAutonumbri($_REQUEST["otsing"]);
        }
    ?>

    <table>
        <tr>
            <th>Autonumber</th>
            <th>Omanik</th>
            <th>Aasta</th>
            <th>Mark</th>
        </tr>

        <?php 
            foreach ($tulemus as $auto)
            {
                echo "<tr>";
                echo "<td>$auto->regnumber</td>";
                echo "<td>{$auto->omanik->eesnimi} {$auto->omanik->perenimi} ({$auto->omanik->isikukood})</td>";
                echo "<td>$auto->aasta</td>";
                echo "<td>$auto->mark</td>";
                echo "</tr>";
            }
        ?>
    </table>
    
    <br><br>

    <form action="" method="post" style="display: flex; flex-direction: column; gap: 10px; width: 300px;">
        <div>
            <label>
                Autonumber:
                <input type="text" name="regnumber" id="regnumber">
            </label>
            <br>

            <label>
                Aasta:
                <input type="number" name="aasta" id="aasta">
            </label>
            <br>

            <label>
                Mark:
                <input type="text" name="mark" id="mark">
            </label>
        </div>

        Omanik<br>

        <div>
            <label>
                Eesnimi:
                <input type="text" name="eesnimi" id="eesnimi">
            </label>
            <br>

            <label>
                Perenimi:
                <input type="text" name="perenimi" id="perenimi">
            </label>
            <br>

            <label>
                Isikukood:
                <input type="number" name="isikukood" id="isikukood">
            </label>
        </div>

        <input type="submit" name="submit" id="submit" value="OK">
    </form>
</body>
</html>