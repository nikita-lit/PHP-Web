<nav>
    <ul>
        <li><a href="?link=homepage.php">Koduleht</a></li>
        <li><a href="?link=products.php">Tooted</a></li>
        <?php 
            if ($auth->IsUser("client") || $auth->IsUserAdmin())
                echo "<li><a href='?link=gallery.php' style='color: blue;'>Galerii</a></li>";

            if ($auth->IsUserAdmin()) 
            {
                echo "<li><a href='?link=admin_page.php' style='color: green;'>Tooted haldus</a></li>";
                echo "<li><a href='?link=users.php' style='color: green;'>Kasutajad</a></li>";
            }
        ?>
    </ul>
    <ul>
        <?php 
            if ($auth->IsUserLoggedIn()) 
                echo "<li><a href='?link=logout.php'>Logi välja (".$_SESSION["username"].")</a></li>";
            else 
            {
                echo "<li><a href='?link=login.php'>Logi sisse</a></li>";
                echo "<li><a href='?link=signup.php'>Registreerimine</a></li>";
            }
        ?>
    </ul>
</nav>