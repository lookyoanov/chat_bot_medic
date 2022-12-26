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
    <title>Регистрация</title>
</head>
<body>
    <!--this header site-->
    <?=$Shablon_header;?>
    
    <!--this body and content site-->
    <main>
        <div class="reg_form reg">
            <div class="autor">
            <h1>Регистрация</h1></div>
            <form action="../php/registration.php" method="POST">
                <p>Фамилия</p>
                <input type="text" placeholder="Введите Фамилию" name="lastname">
                <p>Имя</p>
                <input type="text" placeholder="Введите Имя" name="firstname">
                <p>Отчество</p>
                <input type="text" placeholder="Введите Отчество" name="patronymic">
                <p>Дата рождения</p>
                <input type="date" name="birthday" min="1940-01-01" max="2010-01-01">
                <p>Логин/Номер страхового полиса</p>
                <input type="text" placeholder="Введите Логин" name="login">
                <p>Телефон</p>
                <input type="text" placeholder="+7 (   )    -  -" name="phone">
                <p>Пароль</p>
                <input type="password" placeholder="Введите Пароль" name="password">
                <input type="submit" value="Зарегистрироваться" name="reg">
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