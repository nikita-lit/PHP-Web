<!DOCTYPE html>
<html lang="et">
<head>
    <title>RSS uudised</title>
</head>
<body>
    <h1>RSS (inglise keeles Really Simple Syndication)</h1>
    <p>Tehnoloogia, mis võimaldab sul jälgida veebisaitide uuendusi ühes kohas, ilma et peaksid igat lehte eraldi külastama</p>

    <?php
        echo "<h2>ERR uudised</h2>";
        $feed = simplexml_load_file("https://www.err.ee/rss");

        echo "Kuupäev:";
        echo date('d.m.Y', strtotime($feed->channel->pubDate));

        echo "<ul>";
        foreach ($feed->channel->item as $item)
        {
            echo "<li>
            <h3><a href='$item->link' target='_blank'>$item->title</a></h3>
            $item->description
            <br>
            <small>
            Kellaaeg: ".date('d.m.Y H:i', strtotime($item->pubDate))."
            </small>
            </li><br>";
        }
        echo "</ul>";
    ?>
</body>
</html>