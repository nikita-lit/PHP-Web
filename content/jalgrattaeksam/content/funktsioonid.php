<?php
    require_once("konf.php");

    //-------------------------------------------
    // Registreerimine
    function Registreeri($eesnimi, $perekonnanimi)
    {
        global $yhendus;

        $kask = $yhendus->prepare("INSERT INTO jalgrattaeksam(eesnimi, perekonnanimi) VALUES (?, ?)"); 
        $kask->bind_param("ss", $eesnimi, $perekonnanimi); 
        $kask->execute();
    }
    
    //-------------------------------------------
    // Tulemus
    function SeadaTulemus($teooriatulemus, $id)
    {
        global $yhendus;

        $kask = $yhendus->prepare("UPDATE jalgrattaeksam SET teooriatulemus=? WHERE id=?"); 
        $kask->bind_param("ii", $teooriatulemus, $id); 
        $kask->execute(); 
        $kask->close();

        if($teooriatulemus < 10)
        {
            $kask2 = $yhendus->prepare("UPDATE jalgrattaeksam SET slaalom=2, ringtee=2, t2nav=2 WHERE id=?");
            $kask2->bind_param("i", $id);
            $kask2->execute();
            $kask2->close();
        }
    }

    function EiOleLabiPass($teooriatulemus, $id)
    {
        global $yhendus;
        $message = "";

        if ($teooriatulemus >= 10)
            return $message;

        $kask3 = $yhendus->prepare("SELECT eesnimi, perekonnanimi FROM jalgrattaeksam WHERE id=?");
        $kask3->bind_param("i", $id);
        $kask3->execute();
        $kask3->bind_result($eesnimi2, $perekonnanimi2);

        if ($kask3->fetch())
            $message = "Ei ole läbipääsu teistele eksamile: ".$eesnimi2.' '.$perekonnanimi2.".";

        $kask3->close();

        return $message;
    }

    function KuvaTulemusTabel()
    {
        global $yhendus;
        $kask = $yhendus->prepare("SELECT id, eesnimi, perekonnanimi FROM jalgrattaeksam WHERE teooriatulemus = -1"); 
        $kask->execute(); 
        $kask->bind_result($id, $eesnimi, $perekonnanimi); 

        while($kask->fetch())
        { 
        echo " 
        <tr> 
            <td>$eesnimi</td> 
            <td>$perekonnanimi</td> 
            <td>
                <form action='' method='post'> 
                    <input type='hidden' name='id' value='$id' /> 
                    <input type='number' max='20' min='0' name='teooriatulemus' />
                    <input type='submit' name='submit' value='Sisesta tulemus' /> 
                </form> 
            </td> 
        </tr> 
        "; 
        } 
    }

    //-------------------------------------------
    // Slaalom
    function SeadaSlaalom($id, $vigane)
    {
        global $yhendus;

        $slaalom = 1;
        if ($vigane == 1)
            $slaalom = 2;

        $kask = $yhendus->prepare("UPDATE jalgrattaeksam SET slaalom=? WHERE id=?"); 
        $kask->bind_param("ii", $slaalom, $id); 
        $kask->execute(); 
    }
    
    function KuvaSlaalomTabel()
    {
        global $yhendus;
        $kask = $yhendus->prepare("SELECT id, eesnimi, perekonnanimi FROM jalgrattaeksam WHERE teooriatulemus>=10 AND slaalom=-1");  
        $kask->bind_result($id, $eesnimi, $perekonnanimi); 
        $kask->execute(); 
        $link = $_REQUEST["link"];

        while($kask->fetch())
        { 
            echo " 
            <tr> 
                <td>$eesnimi</td> 
                <td>$perekonnanimi</td> 
                <td> 
                    <a href='?link=$link&id=$id&vigane=0'>Korras</a>
                    <a href='?link=$link&id=$id&vigane=1'>Ebaõnnestunud</a> 
                </td> 
            </tr> 
            "; 
        } 
    }

    //-------------------------------------------
    // Ringtee
    function SeadaRingtee($id, $vigane)
    {
        global $yhendus;

        $ringtee = 1;
        if ($vigane == 1)
            $ringtee = 2;

        $kask = $yhendus->prepare("UPDATE jalgrattaeksam SET ringtee=? WHERE id=?"); 
        $kask->bind_param("ii", $ringtee, $id); 
        $kask->execute(); 
    }

    function KuvaRingteeTabel()
    {
        global $yhendus;
        $kask = $yhendus->prepare("SELECT id, eesnimi, perekonnanimi FROM jalgrattaeksam WHERE teooriatulemus>=10 AND ringtee=-1");  
        $kask->bind_result($id, $eesnimi, $perekonnanimi); 
        $kask->execute(); 
        $link = $_REQUEST["link"];

        while($kask->fetch())
        { 
            echo " 
            <tr> 
                <td>$eesnimi</td> 
                <td>$perekonnanimi</td> 
                <td> 
                    <a href='?link=$link&id=$id&vigane=0'>Korras</a>
                    <a href='?link=$link&id=$id&vigane=1'>Ebaõnnestunud</a> 
                </td> 
            </tr> 
            "; 
        } 
    }

    //-------------------------------------------
    // Tänav
    function SeadaT2nav($id, $vigane)
    {
        global $yhendus;

        $t2nav = 1;
        if ($vigane == 1)
            $t2nav = 2;

        $kask = $yhendus->prepare("UPDATE jalgrattaeksam SET t2nav=? WHERE id=?"); 
        $kask->bind_param("ii", $t2nav, $id); 
        $kask->execute(); 
    }

    function KuvaT2navTabel()
    {
        global $yhendus;
        $kask = $yhendus->prepare("SELECT id, eesnimi, perekonnanimi FROM jalgrattaeksam WHERE slaalom=1 AND ringtee=1 AND t2nav=-1");  
        $kask->bind_result($id, $eesnimi, $perekonnanimi); 
        $kask->execute(); 
        $link = $_REQUEST["link"];

        while($kask->fetch())
        { 
            echo " 
            <tr> 
                <td>$eesnimi</td> 
                <td>$perekonnanimi</td> 
                <td> 
                    <a href='?link=$link&id=$id&vigane=0'>Korras</a>
                    <a href='?link=$link&id=$id&vigane=1'>Ebaõnnestunud</a> 
                </td> 
            </tr> 
            "; 
        } 
    }

    //-------------------------------------------
    // Lõpetamine
    function Asenda($nr)
    { 
        if($nr == -1)
            return "."; //tegemata 
        else if($nr == 1)
            return "korras";
        else if($nr == 2)
            return "ebaõnnestunud";

        return "Tundmatu number"; 
    } 

    function Luba($id)
    {
        global $yhendus;

        $kask = $yhendus->prepare("UPDATE jalgrattaeksam SET luba=1 WHERE id=?");
        $kask->bind_param("i", $id);
        $kask->execute();
    }

    function Kustuta($id)
    {
        global $yhendus;

        $kask = $yhendus->prepare("DELETE FROM jalgrattaeksam WHERE id=?");
        $kask->bind_param("i", $id);
        $kask->execute();
    }

    function KuvaLopetamiseTabel()
    {
        global $yhendus;

        $kask = $yhendus->prepare("SELECT id, eesnimi, perekonnanimi, teooriatulemus, slaalom, ringtee, t2nav, luba FROM jalgrattaeksam;");
        $kask->bind_result($id, $eesnimi, $perekonnanimi, $teooriatulemus, $slaalom, $ringtee, $t2nav, $luba);
        $kask->execute();

        while($kask->fetch())
        {
            $asendatud_slaalom = Asenda($slaalom);
            $asendatud_ringtee = Asenda($ringtee);
            $asendatud_t2nav = Asenda($t2nav);

            $loalahter = ".";
            $link = $_REQUEST["link"];

            if($luba == 1)
                $loalahter = "Väljastatud";

            if($luba == -1 && $t2nav == 1)
                $loalahter = "<a href='?link=$link&id=$id'>Vormista load</a>";

            echo " 
            <tr> 
                <td>$eesnimi</td> 
                <td>$perekonnanimi</td> 
                <td>$teooriatulemus</td> 
                <td>$asendatud_slaalom</td> 
                <td>$asendatud_ringtee</td> 
                <td>$asendatud_t2nav</td> 
                <td>$loalahter</td> 
                <td><a href='?link=$link&id=$id&kustuta=0'>Kustuta</a></td> 
            </tr> 
            ";
        }
    }

    //-------------------------------------------
    function SulgeYhendus()
    {
        global $yhendus;
        $yhendus->close();
    }
?>