<?php
    echo "<h2>Ajafunktsioonid</h2>";
    // timezone, juhul kui timezone ei ole määratud, siis php näitab localhost'i aeg
    date_default_timezone_set('Europe/Tallinn');
    echo "<div id='time_container'>";
        echo "<div class='time-div'>";
        echo "<h3><strong>Aeg</strong></h3>";
            echo "<a href='https://www.php.net/manual/en/timezones.europe.php'>Timezone list</a>";
            echo "time() - aeg sekundides: ".time();
            echo "<br>";
            echo "date() - kuupäev: ".date("d.m.Y G:i:s", time());
            echo "<br>";
            echo "date('d.m.Y H:i:s', time())";
        echo "</div>";
        echo "<div class='time-div'>";
        echo "<h3><strong>Kuupäev formaat</strong></h3>";
            echo "
<pre>d - päev 01...31
m - kuu 01...12
Y - aasta, nelja kohane arv

G - 24h formaat
i - minutid 0...59
s - sekundid 0...59";
            echo "</pre>";
        echo "</div>";
        echo "<div class='time-div'>";
            echo "<h3><strong>Tehted kuupäevaga</strong></h3>";
            echo "+1 min = time() + 60: <br>".date("d.m.Y G:i:s", time() + 60);
            echo "<br>";
            echo "+1 tund = time() + (60 * 60): <br>".date("d.m.Y G:i:s", time() + (60 * 60));
            echo "<br>";
            echo "+1 päev = time() + (60 * 60 * 24): <br>".date("d.m.Y G:i:s", time() + (60 * 60 * 24));
            echo "<br>";
        echo "</div>";
        echo "<div class='time-div'>";
            echo "<h3><strong>Kuupäeva genireerimine</strong></h3>";
            echo "mktime(tunnid, minutid, sekundid, kuu, paev, aasta)";
            echo "<br>";
            $synd = mktime(0, 0, 0, 6, 4, 2008);
            echo "Minu sõnnipäev: ".date("d.m.Y G:i:s", $synd);
            echo "<br>";
            echo "Massiivi abil näidata kuu nimega";
            echo "<br>";
            $kuud = array(1=>"jaanuar", "veebruar",
                "märts", "aprill", "mai",
                "juuni", "juuli", "august",
                "september", "oktoober", "november",
                "detsember");
            $aasta=date("Y");
            $paev=date("d");
            $kuu=$kuud[date("m")];
            echo "Täna on: ".$paev.". ".$kuu." ".$aasta;
        echo "</div>";
    echo "</div>";