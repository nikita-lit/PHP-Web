<?php
    require ("config.php");
    global $connect;

    if(isset($_REQUEST['n_title'])
        && isset($_REQUEST['n_desc'])
        && isset($_REQUEST['n_date'])
        && isset($_REQUEST['n_mood']))
    {
        $title = $_REQUEST['n_title'];
        $desc = $_REQUEST['n_desc'];
        $date = $_REQUEST['n_date'];
        $mood = $_REQUEST['n_mood'];

        if (strlen($title) !== 0
            && strlen($desc) !== 0
            && strlen($date) !== 0
            && strlen($mood) !== 0)
        {
            $query = $connect->prepare("INSERT INTO uudised (pealkiri, kirjeldus, kuupaev, tuju) VALUES (?, ?, ?, ?)");
            $query->bind_param("ssss", $title, $desc, $date, $mood);
            $query->execute();

            header("location: news_from_tabel.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="et">
<head>
    <link rel="stylesheet" href="news_from_tabel.css">
    <title>Lisa uudis andmebaasi</title>
</head>
<body>
    <div id="news_container">
        <h1>Lisa uudis</h1>
        <form id="news_form">
            <label for="n_title">Pealkiri</label>
            <input type="text" name="n_title" id="n_title">

            <label for="n_desc">Kirjuldus</label>
            <textarea id="n_desc" name="n_desc"></textarea>

            <label for="n_date">Kuupäev</label>
            <input type="date" name="n_date" id="n_date">

            <label for="n_mood">Tuju</label>
            <input type="text" name="n_mood" id="n_mood">

            <br>

            <input type="submit" value="Lisa" class="news-button">
        </form>

        <div style="display: flex; flex-direction: column; width: 300px; margin-top: 20px">
            <a href="news_from_tabel.php" class="news-button">Tagasi</a>
        </div>
    </div>
</body>
</html>