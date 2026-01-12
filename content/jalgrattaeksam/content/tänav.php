<?php
    require_once("funktsioonid.php");

    if (!empty($_REQUEST["id"]) && isset($_REQUEST["vigane"]))
        SeadaT2nav($_REQUEST["id"], $_REQUEST["vigane"]);
?>
<div>
    <h1>Tänavasõit</h1>
    <table class="exam-table">
        <?php
            KuvaT2navTabel();
        ?>
    </table>
</div>