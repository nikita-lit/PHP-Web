<!DOCTYPE html>
<html lang="et">
<head>
    <title>RSS uudised</title>
</head>
<body>
    <?php
        require ("rss_functions.php");

        echo "<h2>ERR uudised</h2>";
        KuvaRSSUudised("https://www.err.ee/rss", 5);        
        
        echo "<h2>Postimees uudised</h2>";
        KuvaRSSUudised("https://www.postimees.ee/rss", 5);
    ?>
</body>
</html>