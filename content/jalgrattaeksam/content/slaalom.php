<?php  
    require_once("funktsioonid.php");

    if (!empty($_REQUEST["id"]) && isset($_REQUEST["vigane"])) 
        SeadaSlaalom($_REQUEST["id"], $_REQUEST["vigane"]);
?>  
<div> 
    <h1>Slaalom</h1> 
    <table> 
        <?php 
            KuvaSlaalomTabel();
        ?> 
    </table> 
</div> 