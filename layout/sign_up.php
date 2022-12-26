<?php
    
    session_start();
    $user=$_SESSION['users'];

    require("../php/function.php");
    
    $Shablon_header=include_template2('header.php');
    $Shablon_footer=include_template2('footer.php');
    
    if($_SESSION['users']==""){
        $script= "<script>document.getElementById('sign_1').style.display='none';
        document.getElementById('sign_0').style.display='flex';
        </script>";
    }
    else{
        $script="<script>document.getElementById('sign_1').style.display='flex';
        document.getElementById('sign_0').style.display='none';
        </script>";
    }

    if(!isset($_SESSION['messageError'])){
        unset($_SESSION['messageError']);
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/myCSS.css">
    <title>Авторизация</title>
</head>
<body>
    <!--this header site-->
    <?=$Shablon_header;?>
    
    <!--this body and content site-->
    <main>
        <div class="sale">
            <a href=""><img src="../image/baner.png" alt=""></a>
        </div>
        <div class="dark"></div>
        <div class="reg_form autoriz">
            <div class="autor">
            <h1>Войти</h1></div>
            <form action="../php/sign_up.php" method="POST">
                <input type="text" placeholder="Логин/Номер страхового полиса" name="login">
                <input type="password" placeholder="Пароль" name="password">
                <input type="submit" value="Войти" name="reg">
                <input type="hidden" name="role" id="role" value="user">
            </form>
            <?php if(isset($_SESSION['messageError'])){ //вывод сообщения об ошибке при регистрации ?>
            <div id="messageError">
                <h3>Ошибка!</h3>
                <p><?php echo $_SESSION['messageError'];?></p>
                <button type="button" class="closeError" tabindex="0" onclick="Close()">X</button>
            </div>
            <?php unset($_SESSION['messageError']); } ?>
        </div>
    </main>
    <!--this footer site-->
    <?=$Shablon_footer;?>
</body>
</html>
<script>
        function Close(){
            document.getElementById('messageError').style.display='none';
        }
</script>
<?=$script;?>