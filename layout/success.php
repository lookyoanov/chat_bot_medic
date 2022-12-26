<?php
    
    session_start();
    $user=$_SESSION['users'];
    if(!isset($_SESSION['messageSuccess'])){
        unset($_SESSION['messageSuccess']);
    }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/myCSS.css">
    <title>Document</title>
</head>
<body>
    <main class="message">
        <h1>Ваше обращение на обратный звонок зарегистрировано!</h1>
        <h1>Через 5 секунд вы будете перенаправлены на главную страницу</h1>
        <input type="button" value="Вернуться на главную!" onclick="location.href='../index.php'">
    </main>
</body>
</html>