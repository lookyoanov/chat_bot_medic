<?php
    session_start();

    if(isset($_POST['login'])){
        $login=$_POST['login'];
        if ($login==""){
            unset($login);
        }
    }
    if(isset($_POST['password'])){
        $password=$_POST['password'];
        if ($password==""){
            unset($password);
        }
    }
    if(empty($login) or empty($password)){
        $_SESSION['messageError']='Логин или пароль введены неверно';
        header('Location: ../layout/sign_up.php');
        exit();
    }

    $login=stripcslashes($login);
    $login=htmlspecialchars($login);
    $password=stripcslashes($password);
    $password=htmlspecialchars($password);

    include('bd.php');

    $role=$_POST['role'];
    if($role=='user'){

        $result=mysqli_query($bd, "SELECT * FROM `users` WHERE login_user='$login'");
        $row=mysqli_fetch_array($result, MYSQLI_BOTH);
        
        if(!empty($row['id_user'])){
            if(password_verify($password, $row['password_user'])){
                $_SESSION['users']=$login;
                $_SESSION['nameU']=$row['firstname'];
                header('Location: ../index.php');
                exit();
            }
            else{
                $_SESSION['messageError']='Логин или пароль введены неверно';
                header('Location: ../layout/sign_up.php');
                exit();
            }
        }
        else{
            $_SESSION['messageError']='Логин или пароль введены неверно';
            header('Location: ../layout/sign_up.php');
            exit();
        }
    }
    else{
        $result=mysqli_query($bd, "SELECT * FROM `admin` WHERE login_admin='$login'");
        $row=mysqli_fetch_array($result, MYSQLI_BOTH);
        
        if(!empty($row['id_admin'])){
            if($password==$row['password_admin']){
                $_SESSION['users']=$login;
                header('Location: ../layout/admin/admin_call.php');
                exit();
            }
            else{
                $_SESSION['messageError']='Логин или пароль введены неверно';
                header('Location: ../layout/admin/admin_sign_up.php');
                exit();
            }  
        }
        else{
            $_SESSION['messageError']='Логин или пароль введены неверно';
            header('Location: ../layout/admin/admin_sign_up.php');
            exit();
        }
    }
?>