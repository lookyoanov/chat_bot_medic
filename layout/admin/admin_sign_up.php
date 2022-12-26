<?php
    
    session_start();
    $user=$_SESSION['admin'];

    
    
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
    <link rel="stylesheet" href="../../css/myCSS.css">
    <title>Авторизация</title>
</head>
<body>
    <!--this header site-->
    <header>
        <img src="../../image/logo_zp_brown.png" alt="logo">
        <div class="title"><h1>Медицинский центр "Жемчужина Подолья"</h1></div>

        <div class="sign_reg" id="sign_0">
            <a href="../layout/sign_up.php">
                <div class="el_nav">
                    <h3>Вход</h3>
                </div>
            </a>
            <h3>/</h3>
            <a href="../layout/reg.php">
                <div class="el_nav">
                    <h3>Регистрация</h3>
                </div>
            </a>
        </div>
        <div class="sign_user" id="sign_1">
            <a href="../layout/profile.php">
                <div class="el_nav">
                    <h3>Профиль</h3>
                </div>
            </a>
            <h3>/</h3>
            <a href="../php/exit.php">
                <div class="el_nav">
                    <h3>Выйти</h3>
                </div>
            </a>
        </div>
        
    </header>
    
    <!--this body and content site-->
    <main>
        <div class="dark darkA"></div>
        <div class="reg_form autoriz signA">
            <div class="autor">
            <h1>Войти</h1></div>
            <form action="../../php/sign_up.php" method="POST">
                <input type="text" placeholder="Логин админа" name="login">
                <input type="password" placeholder="Пароль" name="password">
                <input type="submit" value="Войти" name="reg">
                <input type="hidden" name="role" id="role" value="admin">
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
    <div class="dark"></div>
    <footer>
        <div class="content_footer">
            <div>
                <img src="../../image/logo_zp_brown.png" alt="logo">
            </div>
            <div class="description_footer">
                <div>
                    <a href="#"><h3>О нас</h3></a>
                    <a href="#"><h3>Услуги</h3></a>
                    <a href="#"><h3>Запись к врачу</h3></a>
                    <a href="#"><h3>Прайс лист</h3></a>
                    <a href="#"><h3>Отзывы</h3></a>
                </div>
                <div>
                    <h3>Телефон: +7 (495) 488-70-76</h3>
                    <h3>Email: Jemchuzina@mail.ru</h3>
                    <h3>Адрес: Подолье</h3>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
<script>
        function Close(){
            document.getElementById('messageError').style.display='none';
        }
</script>
<?=$script;?>