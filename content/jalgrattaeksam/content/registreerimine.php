<?php  
    require_once("funktsioonid.php");

    $message = "";

    if(isset($_POST["submit"]))
    { 
        $eesnimi = trim($_POST['eesnimi']);
        $perekonnanimi = trim($_POST['perekonnanimi']);

        if (!empty($eesnimi) && !empty($perekonnanimi))
        {
            Registreeri($eesnimi, $perekonnanimi);

            $lisatud = $eesnimi.' '.$perekonnanimi;
            header("Location: $_SERVER[PHP_SELF]?link=teooriaeksam.php&lisatudeesnimi=$lisatud");
            exit();
        }
        else
            $message = "Palun täida kõik väljad!";
    }
?>
<div class="flex-container"> 
    <h1>Registreerimine</h1>

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
    
    <form action="?" method="post" id="registreerimine_form"> 
        <label>
            Eesnimi:
            <input type="text" name="eesnimi" required/>
        </label>

        <label>
            Perekonnanimi:
            <input type="text" name="perekonnanimi" required/>
        </label>

        <input type="submit" name="submit" value="Sisesta"/>
    </form>
</div> 
<?php
    SulgeYhendus();
?>