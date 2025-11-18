<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Nikita Litvinenko PHP tööd</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/music_quiz.css">
    <link rel="stylesheet" href="styles/time_funcs.css">

    <script src="js/date.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
            crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.min.js"
            integrity="sha256-AlTido85uXPlSyyaZNsjJXeCs07eSv3r43kyCVc8ChI="
            crossorigin="anonymous">
    </script>
</head>
<body>
    <?php
        // päis
        include ("header.php");
    ?>

    <div class="flex-container">
        <?php
            // navigeermismenüü
            include ("nav.php");
        ?>

        <div>
            <?php
                if(isset($_GET["link"]))
                {
                    include ("content/".$_GET["link"]);
                }
                else
                {
                    include ("content/homepage.php");
                }
            ?>
        </div>
        <div>
            <img src="images/cat_image.png" alt="Kass">
            <div>
                <input type="button" value="TÄNA ON" onclick="showDate()">
                <input type="button" value="Minu sünnipäevani" onclick="daysToBirthday()">
            </div>
            <div id="result"></div>
        </div>
    </div>

    <?php
        // jalus
        include ("footer.php");
    ?>
</body>
</html>