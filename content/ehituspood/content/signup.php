<?php
    if (isset($_POST["submit"]))
    {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $password_confirm = $_POST["password_confirm"];

        if ($password != $password_confirm)
        {
            
        }
        else
        {
            $auth->RegisterUser($username, $email, $password);
            echo "<script>window.location.href = 'index.php';</script>";
            exit();
        }
    }
?>

<h1 style="margin: 20px">Registreerimine</h1>

<div class="flex-container login-container">
    <form method="post" class="login-form">
        <label>
            Kasutajanimi:
            <input type="text" id="username" name="username" required>
        </label>

        <label>
            E-post:
            <input type="email" id="email" name="email" required>
        </label>

        <label>
            Parool:
            <input type="password" id="password" name="password" required>
        </label>        
        <label>
            Korda parooli:
            <input type="password" id="password_confirm" name="password_confirm" required>
        </label>

        <input type="submit" name="submit" value="Registreeri">
    </form>
</div>