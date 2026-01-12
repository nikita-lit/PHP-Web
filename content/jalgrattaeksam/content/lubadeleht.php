<?php
    require_once("funktsioonid.php");

    if(!empty($_REQUEST["id"]))
    {
        Luba($_REQUEST["id"]);

        if (isset($_REQUEST["kustuta"]))
            Kustuta($_REQUEST["id"]);

        $link = $_REQUEST["link"];
        header("Location: $_SERVER[PHP_SELF]?link=$link");
        exit();
    }
?>
<div>
    <h1>Lõpetamine</h1>
    <table id="lõpetamine_table">
        <tr>
            <th>Eesnimi</th>
            <th>Perekonnanimi</th>
            <th>Teooriaeksam</th>
            <th>Slaalom</th>
            <th>Ringtee</th>
            <th>Tänavasõit</th>
            <th>Lubade väljastus</th>
            <th></th>
        </tr>

        <?php
            KuvaLopetamiseTabel();
        ?>
    </table>
</div>