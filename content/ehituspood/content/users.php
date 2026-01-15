<?php
    if (!$auth->IsUserAdmin())
    {
        echo "<script>window.location.href = 'index.php?link=login.php';</script>";
        exit();
    }

    include_once ("classes/users.php");

    $users = new Users();
?>

<h1 style="margin: 20px">Kasutajad</h1>
<div class="product-container">
    <?php  
        $users->ShowUsers();
    ?>
</div>

<?php
    $users->CloseConnection();
?>