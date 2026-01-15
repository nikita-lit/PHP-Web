<nav>
    <ul>
        <li><a href="?link=homepage.php">Koduleht</a></li>
        <li><a href="?link=products.php">Tooted</a></li>
        <li><a href="?link=gallery.php">Galerii</a></li>
        <li><a href="?link=admin_page.php">Admin haldusleht</a></li>
    </ul>
    <ul>
        <?php 
        if (isset($_SESSION["username"])) 
        {
            echo "<li><a href='?link=logout.php'>Logi välja (".$_SESSION["username"].")</a></li>";
        }
        else 
        {
            echo "<li><a href='?link=login.php'>Logi sisse</a></li>";
            echo "<li><a href='?link=signup.php'>Registreerimine</a></li>";
        }
        ?>
    </ul>
</nav>