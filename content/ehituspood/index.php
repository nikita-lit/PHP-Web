<?php
    include_once "classes/authorization.php";

    session_start();
    $auth = new Authorization();
    //$auth->SetUser("lnikita", "1234");
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Ehituspood</title>
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
                    include ("content/".$_REQUEST["link"]);
                else
                    include ("content/homepage.php");
            ?>
        </div>
    </main>

    <?php
        // jalus
        include ("footer.php");
    ?>
</body>
</html>

<?php
    $auth->CloseConnection();
?>