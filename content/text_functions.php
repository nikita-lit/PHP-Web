<?php
    echo "<h2>Tekstifunktsioonid</h2>";
    $tekst = 'PHP on skriptikeel serveripoolne';
    echo $tekst;
    echo "<br>";
    echo "teksti pikkus - <strong>strlen()</strong> = ".strlen($tekst)." tähemärgi";
    echo "<br>";
    echo "Esimesed 6 tähte - <strong>substr()</strong> = ".substr($tekst, 0, 6);
    echo "<br>";
    echo "Alates 6 tähest = ".substr($tekst, 6);
    echo "<br>";
    echo "Sõnade arv lauses - <strong>str_word_count()</strong> = ".str_word_count($tekst)." sõna lauses";
    echo "<br>";
    echo "Suurtähed - <strong>strtoupper()</strong> = ".strtoupper($tekst);
    echo "<br>";
    echo "Väiketähed - <strong>strtolower()</strong> = ".strtolower($tekst);
    echo "<br>";
    echo "Iga sõna algab suure tähega - <strong>ucwords()</strong> = ".ucwords($tekst);
    echo "<br>";
    echo ucwords(strtolower($tekst));
    $tekst2 = '         PHP on skriptikeel serveripoolne       ';
    echo "<br>";
    echo "*".$tekst2."*";
    echo "<br>";
    echo "Eemaldab tekstist tühikuid paremalt ja vasakult - <strong>trim()</strong> = ".trim($tekst2);
    echo "<br>";
    echo "Eemaldab tekstist tühikuid vasakult - <strong>ltrim()</strong> = ".ltrim($tekst2);
    echo "<br>";
    echo "Eemaldab tekstist tühikuid paremalt - <strong>rtrim()</strong> = ".rtrim($tekst2);
    echo "<br>";
    echo "<h3>Tekst kui massiiv</h3>";
    echo "1. täht massiivist - <strong>tekst[0]</strong> = ".$tekst[0];
    echo "<br>";
    echo "5. täht massiivist - <strong>tekst[0]</strong> = ".$tekst[4];
    echo "<br>";
    // määrab iga sõna nagu eraldi element
    print_r(str_word_count($tekst, 1)); // Array ( [0] => PHP [1] => on [2] => skriptikeel [3] => serveripoolne )
    $syna=str_word_count($tekst, 1);
    echo "<br>";
    echo "massivist 2 sõna = ".$syna[2];
    echo "<br>";
    // määrab mis sümbool on iga sõna alguses
    print_r(str_word_count($tekst, 2)); // Array ( [0] => PHP [4] => on [7] => skriptikeel [19] => serveripoolne )
    echo "<br>";
    echo "<h3>Teksti asendamine - replace</h3>";
    $asendus = 'JavaScript';
    echo substr_replace($tekst, $asendus, 0, 3);
    echo "<br>";
    // ise vaheta serveripoolne - kliendipoolne
    $otsi = array('PHP', 'serveripoolne');
    $asendav = array('JavaScript', 'kliendipoolne');
    echo str_replace($otsi, $asendav, $tekst);
    echo "<br>";
    echo "<h3>Mõistatus. Arva ära Eesti linnanimi</h3>";
    // Tee 5-6 tekst funktsiooni mis aitavad aru saada milline linnanimi oli
    $linn = 'Rakvere';
    echo "<ol>";
    echo "<li>Linna nimi pikkus - ".strlen($linn)." tähemärgi</li>";
    echo "<li>Esimene täht - ".$linn[0]."</li>";
    echo "<li>Viimane täht - ".substr($linn, strlen($linn)-1, 1)."</li>";
    $otsi2 = array('R', 'k', 'v', 'r');
    echo "<li>Ainult täishäälikud - ".str_replace($otsi2, '*', $linn)."</li>";
    echo "<li>Vastupidine järjekord - ".$linn[6].$linn[5].$linn[4].$linn[3].$linn[2].$linn[1].strtolower($linn[0])."</li>";
    echo "</ol>";
    echo "<br>";
?>
<form name="tekstkontroll" action="text_functions.php" method="post">
    <label for="linn">Sisesta linnanimi:</label>
    <input type="text" id="linn" name="linn">
    <input type="submit" value="Kontrolli">
</form>
<?php
if (isset($_REQUEST["linn"]))
{
    if ($_REQUEST["linn"] == strtolower($linn))
        echo $_REQUEST["linn"]." on õige";
    else
        echo $_REQUEST["linn"]." on vale";
}