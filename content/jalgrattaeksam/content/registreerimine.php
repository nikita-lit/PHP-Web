<?php  
    require_once("konf.php");

    if(isset($_REQUEST["sisestusnupp"]))
    { 
        $kask=$yhendus->prepare("INSERT INTO jalgrattaeksam(eesnimi, perekonnanimi) VALUES (?, ?)"); 
        $kask->bind_param("ss", $_REQUEST["eesnimi"], $_REQUEST["perekonnanimi"]); 
        $kask->execute();

        $yhendus->close();
        $lisatud = $_REQUEST['eesnimi'].' '.$_REQUEST['perekonnanimi'];
        header("Location: $_SERVER[PHP_SELF]?link=teooriaeksam.php&lisatudeesnimi=$lisatud");
        exit();
    }
?>
<div class="flex-container"> 
    <h1>Registreerimine</h1>
    
    <form action="?" id="registreerimine_form"> 
        <label>
            Eesnimi:
            <input type="text" name="eesnimi"/>
        </label>

        <label>
            Perekonnanimi:
            <input type="text" name="perekonnanimi"/>
        </label>

        <input type="submit" name="sisestusnupp" value="Sisesta"/>
    </form>
</div> 