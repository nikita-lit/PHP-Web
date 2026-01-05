<?php
    require ("functions.php");

    if (!empty($_REQUEST["lisa1punkt"]))
    {
        LisaPunkt($_REQUEST["lisa1punkt"]);
        header("Location: " . $_SERVER["PHP_SELF"].'?id='.$_REQUEST["lisa1punkt"]); // aadressi puhastab päring ja jääb faili nimi
    }

    if (!empty($_REQUEST["lisa-1punkt"]))
    {
        KustutaPunkt($_REQUEST["lisa-1punkt"]);
        header("Location: " . $_SERVER["PHP_SELF"].'?id='.$_REQUEST["lisa-1punkt"]);
    }

    // päring lisaPresident funktsooni otsimiseks
    if (!empty($_REQUEST["president"]))
    {
        LisaPresident($_REQUEST["president"], $_REQUEST["pilt"], $_REQUEST["punktid"], 1);
        header("Location: " . $_SERVER["PHP_SELF"]);
    }

    if (!empty($_REQUEST["kustuta"]))
    {
        KustutaPresident($_REQUEST["kustuta"]);
        header("Location: " . $_SERVER["PHP_SELF"]);
    }

    //Kommentaari lisamine
    if (!empty($_REQUEST["uue_komment_id"]) && !empty($_REQUEST["uus_kommentaar"]))
    {
        LisaKommentaar($_REQUEST["uue_komment_id"], $_REQUEST["uus_kommentaar"]);
        header("Location: " . $_SERVER["PHP_SELF"]);
    }

    if (!empty($_REQUEST["punktid_nulliks"]))
    {
        PunktidNulliks($_REQUEST["punktid_nulliks"]);
        header("Location: " . $_SERVER["PHP_SELF"]);
    }

    //Näitamine
    if (!empty($_REQUEST["naita"]))
    {
        NaitaPresident($_REQUEST["naita"]);
        header("Location: " . $_SERVER["PHP_SELF"]);
    }

    //Peida
    if (!empty($_REQUEST["peida"]))
    {
        PeidaPresident($_REQUEST["peida"]);
        header("Location: " . $_SERVER["PHP_SELF"]);
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tabel valimised kirjutatud funktsoonide abil</title>
    <link rel="stylesheet"  href="style.css">
</head>
<body>
    <h1>Tabel valimised kirjutatud funktsoonide abil</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>President</th>
            <th>Pilt</th>
            <th>Punktid</th>
            <th>Lisamisaeg</th>
            <th>+1 punkt</th>
            <th>-1 punkt</th>
            <th>Kustuta</th>
            <th>Kommentaarid</th>
            <th>Lisa kommentaar</th>
            <th>Haldus</th>
        </tr>
        <?php
            // funktsioon mis näitab tabeli asub functions.php failis
            NaitaTabel();
        ?>
    </table>

    <h2>Lisa oma presidendi</h2>
    <form action="?" method="post" id="add_form">
        <label>
            Presidendi Nimi:
            <input type="text" name="president">
        </label>

        <label>
            Presidendi Pilt:
            <textarea name="pilt"></textarea>
        </label>

        <label>
            Presidendi Punktid:
            <input type="number" name="punktid">
        </label>

        <input type="submit" value="Lisa">
    </form>
</body>
</html>
