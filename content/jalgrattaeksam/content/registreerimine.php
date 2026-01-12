<?php  
    require_once("funktsioonid.php");

    if(isset($_POST["submit"]))
    { 
        Registreeri($_POST['eesnimi'], $_POST['perekonnanimi']);

        $lisatud = $_POST['eesnimi'].' '.$_POST['perekonnanimi'];
        header("Location: $_SERVER[PHP_SELF]?link=teooriaeksam.php&lisatudeesnimi=$lisatud");
        exit();
    }
?>
<div class="flex-container"> 
    <h1>Registreerimine</h1>
    
    <form action="?" method="post" id="registreerimine_form"> 
        <label>
            Eesnimi:
            <input type="text" name="eesnimi"/>
        </label>

        <label>
            Perekonnanimi:
            <input type="text" name="perekonnanimi"/>
        </label>

        <input type="submit" name="submit" value="Sisesta"/>
    </form>
</div> 