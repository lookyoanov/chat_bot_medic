<?php
    session_start();

    include('bd.php');

    if(isset($_POST['firstname'])){
        $firstname=$_POST['firstname'];
        if ($firstname==""){
            unset($firstname);
        }
    }
    if(isset($_POST['lastname'])){
        $lastname=$_POST['lastname'];
        if ($lastname==""){
            unset($lastname);
        }
    }
    if(isset($_POST['patronymic'])){
        $patronymic=$_POST['patronymic'];
        if ($patronymic==""){
            unset($patronymic);
        }
    }
    if(isset($_POST['birthday'])){
        $birthday=$_POST['birthday'];
        if ($birthday==""){
            unset($birthday);
        }
    }
    if(isset($_POST['phone'])){
        $phone=$_POST['phone'];
        if ($phone==""){
            unset($phone);
        }
    }
    if(isset($_POST['login'])){
        $login=$_POST['login'];
        if ($login==""){
            unset($login);
        }
    }
    if(isset($_POST['password'])){
        $password=$_POST['password'];
        if($password==""){
            unset($password);
        }
    }
    if(empty($firstname)){
        $_SESSION['messageError']='Введите ваше имя';
        header('Location: ../layout/reg.php');
        exit();
    }
    if(empty($lastname)){
        $_SESSION['messageError']='Введите вашу фамилию';
        header('Location: ../layout/reg.php');
        exit();
    }
    if(empty($phone)){
        $_SESSION['messageError']='Введите ваш телефон';
        header('Location: ../layout/reg.php');
        exit();
    }
    if(empty($login)){
        $_SESSION['messageError']='Введите логин';
        header('Location: ../layout/reg.php');
        exit();
    }
    if(empty($password)){
        $_SESSION['messageError']='Введите пароль';
        header('Location: ../layout/reg.php');
        exit();
    }
    //защита от sql-инъекций
    $login=stripcslashes($login);
    $login=htmlspecialchars($login);
    $password=stripcslashes($password);
    $password=htmlspecialchars($password);
    
    $firstname=stripcslashes($firstname);
    $firstname=htmlspecialchars($firstname);
    $lastname=stripcslashes($lastname);
    $lastname=htmlspecialchars($lastname);
    $patronymic=stripcslashes($patronymic);
    $patronymic=htmlspecialchars($patronymic);
    $phone=stripcslashes($phone);
    $phone=htmlspecialchars($phone);
    $login=trim($login);
    $password=trim($password);
    $firstname=trim($firstname);
    $lastname=trim($lastname);
    $patronymic=trim($patronymic);
    $phone=trim($phone);
    
    //проверка логина существования в бд
    $result=mysqli_query($bd , "SELECT id_user FROM users WHERE login_user='$login'" );
    $myrow=mysqli_fetch_array($result, MYSQLI_ASSOC);

    if(!preg_match("/^[А-ЯЁа-яё]+$/u",$firstname)){
        $_SESSION['messageError']="Имя должно содержать только кириллицу";
        header('Location: ../layout/reg.php');
        exit();
    }
    if(!preg_match("/^[А-ЯЁа-яё]+$/u",$lastname)){
        $_SESSION['messageError']="Фамилия должна содержать только кириллицу";
        header('Location: ../layout/reg.php');
        exit();
    }
    if(!preg_match("/^[А-ЯЁа-яё]+$/u",$patronymic)){
        $_SESSION['messageError']="Отчество должно содержать только кириллицу";
        header('Location: ../layout/reg.php');
        exit();
    }
    if(!preg_match("/^[0-9]{16}+$/",$login)){
        $_SESSION['messageError']="Ошибка ввода номера Страхового полиса";
        header('Location: ../layout/reg.php');
        exit();
    }
    if(!preg_match("/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/",$phone)){
        $_SESSION['messageError']="Ошибка при вводе номера телефона";
        header('Location: ../layout/reg.php');
        exit();
    }
    if(!preg_match("/^.{6,16}+$/",$password)){
        $_SESSION['messageError']="Пароль должен быть не короче 6 символов";
        header('Location: ../layout/reg.php');
        exit();
    }
    if(!preg_match("/^([A-Za-z0-9])+$/",$password)){
        $_SESSION['messageError']="Пароль должен содержать тольцо латинские буквы и цифры";
        header('Location: ../layout/reg.php');
        exit();
    }
    
    if(!empty($myrow['id_user'])){
        $_SESSION['messageError']="Номер страхового полиса уже зарегистрирован";
        header('Location: ../layout/reg.php');
        exit();
    }
    
        //добавление нового пользователя если пройдены все проверки
        $password=password_hash($password, PASSWORD_DEFAULT);
        $datereg=date("Y-m-d");
        $result2=mysqli_query($bd , "INSERT INTO users (login_user, password_user, firstname, lastname, patronymic, phone_user, birthday, verification, date_reg_user) VALUES('$login', '$password', '$firstname', '$lastname', '$patronymic', '$phone', '$birthday', '0', '$datereg')");
        if($result2==TRUE){
            $sql=mysqli_query($bd,"SELECT id_user FROM users WHERE login_user='$login'");
            $sqlRow=mysqli_fetch_array($sql,MYSQLI_ASSOC);
            $id_user=$sqlRow['id_user'];
            $sqlEvent=mysqli_query($bd, "INSERT INTO event_user (date_event, id_user, `event`, close_event) VALUES ('$datereg', '$id_user', 'Регистрация нового пользователя', 0)");
            header('Location: ../layout/sign_up.php');
            exit();
        }
    
?>