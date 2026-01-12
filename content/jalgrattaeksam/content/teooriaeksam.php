<?php  
    require_once("funktsioonid.php");

    $message = "";
    if (isSet($_REQUEST["lisatudeesnimi"]))
        $message = "Lisati ".$_REQUEST["lisatudeesnimi"].".";

    if(isset($_POST["submit"]))
    { 
        SeadaTulemus($_POST["teooriatulemus"], $_POST["id"]);
        $message = EiOleLabiPass($_POST["teooriatulemus"], $_POST["id"]);

        unset($_POST["submit"]);
    }
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
            KuvaTulemusTabel();
        ?> 
    </table> 
</div> 
<?php
    SulgeYhendus();
?>