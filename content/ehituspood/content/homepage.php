<?php
    require('config.php');
    global $connect;
?>

<div id="homepage_welcome">
    <h1 style="text-align: center;">Tere tulemast!</h1>
    <div style="padding: 20px">
    Me oleme mugav ehituspood kõigile, kes hindavad kvaliteeti ja praktilisust.
    <br>Meilt leiab remondimaterjale, tööriistu ja kõik vajalikud tarvikud. 
    <br>Valime ainult usaldusväärseid tooteid ja hoiame hinnad mõistlikud, et sinu remont kulgeks sujuvalt ja muretult.
    </div>
</div>

<div id="homepage_nav">
    <?php 
        $kask = $connect->prepare("SELECT id, name, description, price FROM products");
        $kask->bind_result($id, $name, $desc, $price);
        $kask->execute();

        echo '<div id="homepage_nav_products">';
        $num = 0;
        while ($kask->fetch())
        {
            if ($num >= 3) 
                break;

            $num = $num + 1;

            echo "<div class='product'>";
            echo "<h2>".htmlspecialchars($name)."</h2>";
            echo "<div>".htmlspecialchars($desc)."</div>";
            echo "<div>".htmlspecialchars($price)." €</div>";
            echo "</div>";
        }
        echo "</div>";
    ?>    

    <a href="?link=products.php">> Meie tooted <</a>
</div>

<div id="homepage_workers">
    <div>
        <h2>Meie töötajad</h2>
        <br>
        <img src="https://www.svgrepo.com/show/371694/avatar.svg" alt="Juhataja" style="width: 100px;">
        <br>Nikita Litvinenko<br>Juhataja
    </div>
</div>

<?php
    $connect->close();
?>