<?php
    require ("functions.php");

    if (isset($_REQUEST["lisa1punkt"]))
        LisaPunkt($_REQUEST["lisa1punkt"]);
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
</body>
</html>
