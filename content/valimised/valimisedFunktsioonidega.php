<?php
    require ("functions.php");

    if (isset($_REQUEST["lisa1punkt"]))
    {
        LisaPunkt($_REQUEST["lisa1punkt"]);
        header("Location: " . $_SERVER["PHP_SELF"].'?id='.$_REQUEST["lisa1punkt"]); // aadressi puhastab päring ja jääb faili nimi
    }

    // päring lisaPresident funktsooni otsimiseks
    if (!empty($_REQUEST["president"]))
    {
        LisaPresident($_REQUEST["president"], $_REQUEST["pilt"], 1);
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
            <th>Kommentaarid</th>
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

        <input type="submit" value="Lisa">
    </form>
</body>
</html>
