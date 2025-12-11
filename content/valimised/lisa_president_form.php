<h2>Lisa oma presidendi</h2>
<form action="?" method="post">
    <label>
        Presidendi Nimi:
        <input type="text" name="president">
    </label>

    <label>
        Presidendi Pilt:
        <textarea name="pilt"></textarea>
    </label>

    <?php
        if (!empty($_SESSION["is_admin"]))
        {
            echo "<label>Näita:
                <input type='checkbox' name='avalik' value='0'>
            </label>";
        }
    ?>

    <input type="submit" value="Lisa">
</form>