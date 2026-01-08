<?php
    function KuvaRSSUudised($url, $kogus)
    {
       $feed = simplexml_load_file($url);

        echo "Kuupäev:";
        echo date('d.m.Y', strtotime($feed->channel->pubDate));

        echo "<ul>";
        $num = 0;
        foreach ($feed->channel->item as $item)
        {
            if ($num >= $kogus)
                break;
            
            $categories = "";
            foreach ($item->category as $category)
                $categories = $categories." ".$category;

            $imgUrl = "";
            if (!is_null($item->enclosure->attributes()))
                $imgUrl = $item->enclosure->attributes()->url;

            echo "<li style='display: flex; flex-direction: column; gap: 10px;'>
            <h3><a href='$item->link' target='_blank'>$item->title</a></h3>";

            if (!is_null($imgUrl) && !empty($imgUrl))
                echo "<img src='{$item->enclosure->attributes()->url}' alt='image' style='display: flex; width: 200px; height: 100px'>";

            echo "$item->description<br>";

            echo "<small>
            Kategooriad: $categories
            <br>
            Kellaaeg: ".date('d.m.Y H:i', strtotime($item->pubDate))."
            </small>
            </li><br>";

            $num++;
        }
        echo "</ul>";
    }
?>