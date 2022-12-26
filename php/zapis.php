<?php
    session_start();

    $user=$_SESSION['users'];
    include('bd.php');


    if(isset($_POST['name'])){
        $name=$_POST['name'];
        if($name==""){
            unset($name);
        }
    }
    if(isset($_POST['description'])){
        $description=$_POST['description'];
        if($description==""){
            unset($description);
        }
    }
    if(!empty($name)){
        if(!empty($description)){
        
    
    //защита от sql-инъекций
    $description=stripcslashes($description);
    $description=htmlspecialchars($description);
    $description=trim($description);
    $name=stripcslashes($name);
    $name=htmlspecialchars($name);
    $name=trim($name);
    $datereg=date("Y-m-d");

        //добавление нового обращения если пройдены все проверки
        $result2=mysqli_query($bd , "INSERT INTO `otziv` (login_user, name_user, description_user , date_create) VALUES('$user', '$name', '$description', '$datereg')");
        if($result2==TRUE){
            $_SESSION['messageSuccess']='Ваш отзыв принят. Спасибо за обращение!';
            header('Location: ../layout/success.php');
            exit();
    
        }   
     }
    }
    else{
        header('Location: ../index.php');
        exit();
    }
?>