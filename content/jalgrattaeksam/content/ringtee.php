<?php
    require_once("funktsioonid.php");

    if (!empty($_REQUEST["id"]) && isset($_REQUEST["vigane"]))
        SeadaRingtee($_REQUEST["id"], $_REQUEST["vigane"]);
?>
<div>
    <h1>Ringtee</h1>
    <table class="exam-table">
        <?php
            KuvaRingteeTabel();
        ?>
    </table>
</div>