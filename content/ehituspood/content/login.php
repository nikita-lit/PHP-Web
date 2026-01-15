<?php
    if (isset($_POST["submit"]))
    {
        $username = $_POST["username"];
        $password = $_POST["password"];

        if (!$auth->SetUser($username, $password))
        {
            
        }
        else
        {
            //header("Location: index.php");
            echo "<script>window.location.href = 'index.php';</script>";
            exit();
        }
    }
?>

<h1 style="margin: 20px">Logi sisse</h1>

<div class="flex-container login-container">
    <form method="post" class="login-form">
        <label>
            Kasutajanimi:
            <input type="text" id="username" name="username" required>
        </label>
        
        <label>
            Parool:
            <input type="password" id="password" name="password" required>
        </label>

        <input type="submit" name="submit" value="Logi sisse">
    </form>

    <a href="?link=signup.php" style="margin-top: 10px;">Registreeri uus konto</a>
</div>