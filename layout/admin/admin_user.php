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
    include('../../php/update.php');
    include('../../php/bd.php');
    $result=mysqli_query($bd, "SELECT id_event, close_event, login_user, firstname ,lastname, patronymic, verification, DATE_FORMAT(date_event, '%d.%m.%Y') as 'date_event' FROM event_user INNER JOIN users ON event_user.id_user=users.id_user WHERE `event`='Регистрация нового пользователя'");
    
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
        <div class="nav_header">
            <a href="admin_call.php" id="call">
                <div class="el_nav">
                    <h3>Звонки</h3>
                </div>
            </a>
            <a href="admin_appoint.php" id="appoint">
                <div class="el_nav">
                    <h3>Запись к врачу</h3>
                </div>
            </a>
            <a href="admin_user.php" id="user">
                <div class="el_nav">
                    <h3>Пользователи</h3>
                </div>
            </a>
            <a href="#">
                <div class="el_nav">
                    <h3>Отзывы</h3>
                </div>
            </a>
        </div>
    </header>
    
    <!--this body and content site-->
    <main>
        <div class="dark darkA"></div>
        <div class="titleMain">
            <h1 id="title">Новые пользователи</h1>
        </div>
        <div class="table_admin">
            <div class="row_table">
                <div>
                    <h3>Номер события</h3>
                </div>
                <div>
                    <h3>Страховой полис</h3>
                </div>
                <div>
                    <h3>ФИО пользователя</h3>
                </div>
                <div>
                    <h3>Дата регистрации</h3>
                </div>
                <div>
                    <h3>Учетная запись</h3>
                </div>
            </div>
            <?php
                $i=1;
                while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){

            ?>
            <div class="row_table">
                <div>
                    <h3><?=$i;?></h3>
                </div>
                <div>
                    <h3><?=$row['login_user']; ?></h3>
                </div>
                <div>
                    <h3><?php echo $row['lastname'] . ' ' . mb_substr($row['firstname'], 0,1, 'utf-8') . '.' . mb_substr($row['patronymic'], 0,1, 'utf-8');  ?></h3>
                </div>
                <div>
                    <h3><?=$row['date_event']?></h3>
                </div>
                <div>
                    <?php 
                        if($row['verification']==0){ ?>
                            <a href="" id="noExecute"><h3>Не подтверждена</h3></a>
                        <?} else {
                    ?>
                    <h3>Подтверждена</h3>
                    <?}?>
                </div>
            </div>
            <?php $i++; } ?>
            
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