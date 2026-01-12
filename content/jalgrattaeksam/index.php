<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Jalgrattaeksam</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php
    // päis
    include ("header.php");

    ?>

    <?php
        // navigeermismenüü
        include ("nav.php");
    ?>

    <main>
        <div style="height: 100%">
            <?php
                if(isset($_REQUEST["link"]))
                {
                    include ("content/".$_REQUEST["link"]);
                }
                else
                {
                    include ("content/registreerimine.php");
                }
            ?>
        </div>
    </main>

    <?php
        // jalus
        include ("footer.php");
    ?>
</body>
</html>