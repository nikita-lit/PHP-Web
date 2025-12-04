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

    /*
        CREATE TABLE Products (
            id int AUTO_INCREMENT PRIMARY KEY,
            name varchar(100) NOT NULL,
            description text,
            price decimal(10,2) NOT NULL
        );

        INSERT INTO Products (name, description, price) VALUES
            ('Tsement A200', 'Betooni ja müüritööd', 6.5),
            ('Valge akrüülvärv', 'Sisetöödeks, 3 l ämber', 12.9),
            ('Perforaator Pro', '900 W, 3 režiimi', 79),
            ('Kruvid 4x40 mm', 'Pakend 200 tk.', 3.2),
            ('Montaaživaht standard', '750 ml', 4.8),
            ('Krohvinuga 150 mm', 'Terasest, kummeeritud käepide', 2.5),
            ('Laminaat Oak', 'Klass 32, 1 m2', 9.9),
            ('Maalriteip 30 mm', 'Universaalne', 1.2);
     */
    ?>

    <?php
    // navigeermismenüü
    include ("nav.php");
    ?>

    <main>
        <div style="height: 100%">
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
    </main>

    <?php
    // jalus
    include ("footer.php");
    ?>
</body>
</html>