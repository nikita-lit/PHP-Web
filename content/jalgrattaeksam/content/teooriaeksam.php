<?php  
    require_once("konf.php");

    $message = "";
    if (isSet($_REQUEST["lisatudeesnimi"]))
        $message = "Lisati ".$_REQUEST["lisatudeesnimi"].".";

    if(isset($_POST["submit"]))
    { 
        $kask = $yhendus->prepare("UPDATE jalgrattaeksam SET teooriatulemus=? WHERE id=?"); 
        $kask->bind_param("ii", $_POST["teooriatulemus"], $_POST["id"]); 
        $kask->execute(); 

        if($_POST["teooriatulemus"] < 10)
        {
            $kask2 = $yhendus->prepare("UPDATE jalgrattaeksam SET slaalom=2, ringtee=2, t2nav=2 WHERE id=?");
            $kask2->bind_param("i", $_POST["id"]);
            $kask2->execute();

            $kask3 = $yhendus->prepare("SELECT eesnimi, perekonnanimi FROM jalgrattaeksam WHERE id=?");
            $kask3->bind_param("i", $_POST["id"]);
            $kask3->execute();
            $kask3->bind_result($eesnimi2, $perekonnanimi2);
            
            if ($kask3->fetch())
                $message = "Ei ole läbipääsu teistele eksamile: ".$eesnimi2.' '.$perekonnanimi2.".";

            $kask3->close();
        }

        unset($_POST["submit"]);
    }

    $kask = $yhendus->prepare("SELECT id, eesnimi, perekonnanimi FROM jalgrattaeksam WHERE teooriatulemus = -1"); 
    $kask->bind_result($id, $eesnimi, $perekonnanimi); 
    $kask->execute(); 
?> 
<div class="flex-container"> 
    <?php
        $display = "none";
        if (!empty($message))
            $display = "flex"; 

        echo '<div id="lisati" style="display: '.$display.'">';
    ?>
        <?php 
            if(!empty($message))
                echo $message;
        ?>
    </div> 

    <table> 
        <?php 
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
        ?> 
    </table> 
</div> 