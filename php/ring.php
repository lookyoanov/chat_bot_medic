<?php
    session_start();

    $user=$_SESSION['users'];
    include('bd.php');


    if(isset($_POST['phone'])){
        $phone=$_POST['phone'];
        if($phone==""){
            unset($phone);
        }
    }
    if(!preg_match("/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/",$phone)){
        header('Location: ../index.php');
        exit();
    }
    if(!empty($phone)){
        
        
    
    //защита от sql-инъекций
    $phone=stripcslashes($phone);
    $phone=htmlspecialchars($phone);
    $phone=trim($phone);
    $datereg=date("Y-m-d");


        //добавление нового обращения если пройдены все проверки
        $result2=mysqli_query($bd , "INSERT INTO `event_ring` (date_event, phone, close_event) VALUES('$datereg', '$phone', '0')");
        if($result2==TRUE){
            $_SESSION['messageSuccess']='Ваша заявка на обратный звонок принята. Скоро с вами свяжется наш менеджер';
            header('Location: ../layout/success.php');
            exit();
    
        }   
     
    }
    else{
        header('Location: ../index.php');
        exit();
    }
?>