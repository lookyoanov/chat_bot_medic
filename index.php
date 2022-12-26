<?php
    
    session_start();
    $user=$_SESSION['users'];

    require("php/function.php");
    
    $Shablon_header=include_template('header.php');
    $Shablon_footer=include_template('footer.php');
    
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
    include('php/bd.php');
    if(!empty($user)){
        $query=mysqli_query($bd, "SELECT * FROM `users` WHERE login_user='$user'");
        $result=mysqli_fetch_assoc($query);
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/myCSS.css">
    <title>Главная страница</title>
</head>
<body>
    <!--this header site-->
    <?=$Shablon_header;?>
    
    <!--this body and content site-->
    <main>
        <div class="sale">
            <a href="layout/bot.php"><img src="image/baner.png" alt=""></a>
        </div>
        <div class="dark"></div>
        <div class="titleMain">
            <h1>О медцентре</h1>
        </div>
        <div class="service">
            <div class="info">
                <div><strong><p>Cеть клиник Жемчужина Подолья располагается в городе Подольск. Сегодня мы большой и дружный коллектив, который объединяет в себе квалифицированных специалистов, которые предложат лечение с использованием самых современных технологий.</p></strong></div>
                <div><strong><p>Отличная современная материально — техническая база клиники позволяет оказывать практически все виды необходимых услуг. Начиная от стоматологической помощи любой сложности и заканчивая аптекой с низкими ценами, большим ассортиментом и скидками для льготников.</p></strong></div>
                <div><p>Медицинский центр «Жемчужина Подолья» — это учреждение широкого профиля, предлагающее специально подобранный комплекс услуг для каждого пациента. В клинике всё организовано с учетом максимального комфорта для посетителей. Техническое оснащение кабинетов позволяет провести диагностические исследования организма пациента для составления программы лечения и профилактических мероприятий.</p></div>
            </div>
        </div>
        <div class="titleMain"><h1>КОМФОРТНЫЕ УСЛОВИЯ ДЛЯ ВСЕЙ СЕМЬИ В «ЖЕМЧУЖИНА ПОДОЛЬЯ»</h1></div>
        <div class="service">
            <div class="info">
                <div><p>В клинике работают отделения: общей терапии, кардиологии, ревматологии, гастроэнтерологии, гепатологии, пульмонологии, аллергологии, иммунологии, нефрологии, гематологии, лечения инфекционных заболеваний, неврологии, эндокринологии, дерматологии, венерологии, урологии, андрологии, колопроктологии, гинекологии, акушерства, маммологии, онкологии, психотерапии, наркологии, офтальмологии, оториноларингологии, педиатрии, логопедии, ортопедии.</p></div>
                <div><p>Наши специалисты имеют высокую квалификацию и с пониманием отнесутся к вашим проблемам. Доверяя свое здоровье нам, вы можете быть уверены в результате.</p></div>
                <div><p>В медицинском центре «Жемчужина Подолья» оказывают услуги по выдаче справок и заключений медицинской комиссии. Если вам требуется пройти медицинское обследование перед поступлением на работу или оформить санитарную книжку, наши специалисты всегда смогут вам помочь. Кроме того, профилактические осмотры у врача являются обязательными для того, чтобы не допустить возникновения серьезных заболеваний.</p></div>
            </div>
        </div>
        <div class="titleMain"><h1>«ЖЕМЧУЖИНА ПОДОЛЬЯ» — ДЛЯ ДЕТЕЙ</h1></div>
        <div class="service">
            <div class="info">
                <div><p>В нашем медицинском центре принимают самых маленьких пациентов. Наши специалисты имеют нужную квалификацию для лечения болезней у деток, а потому ваш ребенок окажется в надежных руках. Помимо консультации у педиатра, открыта запись к другим профильным врачам. Мы создаем максимально комфортные условия для детей и дорожим доверием родителей, которые приходят к нашим врачам и другим специалистам.</p></div>
            </div>
        </div>
        <div class="panorame">
            <div class="p_image">
                <img src="image/cab_1.jpg" alt="" class="secondelig">
            </div>
            <div class="p_image">
                <img src="image/cab_2.jpg" alt="" class="secondelig">
            </div>
            <div class="p_image">
                <img src="image/cab_3.jpg" alt="" class="secondelig">
            </div>
            <div class="p_image">
                <img src="image/cab_4.jpg" alt="" class="secondelig">
            </div>
            <div class="p_image">
                <img src="image/cab_5.jpg" alt="" class="secondelig">
            </div>
            <div class="p_image">
                <img src="image/cab_6.jpg" alt="" class="secondelig">
            </div>
            <div class="p_image">
                <img src="image/cab_7.jpg" alt="" class="secondelig">
            </div>
            <div class="p_image">
                <img src="image/cab_8.jpg" alt="" class="secondelig">
            </div>
            <div class="p_image">
                <img src="image/cab_9.jpg" alt="" class="secondelig">
            </div>
            <div class="p_image">
                <img src="image/cab_10.jpg" alt="" class="secondelig">
            </div>
            <div class="p_image">
                <img src="image/cab_11.jpg" alt="" class="secondelig">
            </div>
            <div class="p_image">
                <img src="image/cab_12.jpg" alt="" class="secondelig">
            </div>
        </div>
        <div class="dark"></div>
        <div class="Ring_phone">
            <h2>Заказать обратный звонок:</h2>
            <form action="../php/ring.php" method="POST">
                <input type="text" placeholder="+7 (   )    -  -" name="phone" value="<?=$result['phone_user']?>">
                <input type="submit" value="Заказать звонок">
            </form>
        </div>
    </main>
    <!--this footer site-->
    <?=$Shablon_footer;?>
</body>
</html>
<?=$script;?>