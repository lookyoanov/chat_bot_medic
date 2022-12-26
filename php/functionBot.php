<?php
session_start();
$user=$_SESSION['users'];
include('bd.php');


if(isset($_POST['messageUser'])){
    $messageUser=$_POST['messageUser'];
    $messageUser=trim($messageUser);
    $messageUser=trim($messageUser,'"'); 
    $messageUser=stripcslashes($messageUser);
    $messageUser=htmlspecialchars($messageUser);
    $chars=['%',','];
    $messageUser=str_replace($chars,'',$messageUser);
    if ($messageUser=="" && $messageUser=" "){
            echo json_encode(array('success'=>0,'message'=>'Ничего не найдено!', 'messageTwo'=>'Попробуйте ещё раз. Например: "Запись к врачу", "Контакты" и т.п'));           
            unset($messageUser);
            exit;
    }
}
switch($_POST['algBot']){
    case '0':
        $messageUser = preg_replace('|[\s]+|s', ' ', $messageUser);
        $search='ПРАЙС:';
        $pos=stripos($messageUser,$search);
        if($pos!==false){
            $messageUser=str_replace($search,'',$messageUser);
            $sqlPrice=mysqli_query($bd,"SELECT * FROM price WHERE teg_price LIKE '$messageUser'");
            $rowPrice=mysqli_fetch_array($sqlPrice,MYSQLI_ASSOC);
            if(!empty($rowPrice['id_price'])){
                echo json_encode(array('success'=>0,'message'=>'По вашему запросу найдена услуга:',
                'messageTwo'=>$rowPrice['teg_price'] . ": стоимость услуги " . $rowPrice['pricing'] . "руб. Подробности уточняйте у администратора."));
                unset($messageUser);
                exit;
            }
            else{
                echo json_encode(array('success'=>0,'message'=>'По вашему запросу ничего не найдено!',
                'messageTwo'=>'Вы можете ознакомиться с прайс-листом на странице <a href="#">"Прайс лист"</a>'));
                unset($messageUser);
                exit;
            }
        }
        $result=mysqli_query($bd,"SELECT id_botinfo FROM bot_info WHERE other LIKE '%$messageUser%' ");
        $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
        $id_bot=$row['id_botinfo'];
        switch ($id_bot){
            case '1':
                echo json_encode(array('success'=>1,'message'=>'К какому специалисту хотите записаться? <br> Например "Терапевт", "Невролог" и т.п.','messageTwo'=>'Если вы не знаете к кому врачу вам необходимо попасть, напишите в чат слово "СИМПТОМЫ:" и опишите свои симптомы через ",".'));
                unset($messageUser);
                break;
            case '4':
                echo json_encode(array('success'=>0,'message'=>'Мы находимся по адресу:','messageTwo'=>'142100, Московская область, г. Подолье, ул. Староколчанная, д. 5'));
                unset($messageUser);
                break;
            case '5':
                echo json_encode(array('success'=>0,'message'=>'Наш номер телефона: +7 (495) 488-70-76','messageTwo'=>'Вы можете заказать обратный звонок <a href="#">"здесь"</a>'));
                unset($messageUser);
                break;
            case '6':
                echo json_encode(array('success'=>0,
                'message'=>'Вы можете использовать следующие команды:',
                'messageTwo'=>"Для записи к врачу - \"Запись к врачу\", \"запись\", \"записаться к врачу\". <br> 
                                Узнать адрес - \"Где находитесь?\", \"Как добраться?\", \"адрес\". <br>
                                Контакты - \"Номер телефона клиники\", \"Контакты\", \"Контакты клиники\". <br> 
                                Прайс-лист - \"Прайс-лист\", \"цена за услуги\", \"платные услуги\". <br>
                                График работы - \"График работы клиники\", \"часы работы\". "));
                unset($messageUser);
                break;
            case '7':
                echo json_encode(array('success'=>0,
                'message'=>'Вы можете ознакомиться с прайс-листом на странице <a href="#">"Прайс лист"</a>',
                'messageTwo'=>"Или вы можете написать мне интересуюшую вас услугу и я подскажу её цену<br>(Например: ПРАЙС:диспансеризация, ПРАЙС:рентген, ПРАЙС:тест на CODID-19 и т.п.)"));
                unset($messageUser);
                break;
            case '8':
                echo json_encode(array('success'=>0,
                'message'=>'График работы клиники "Жемчужина Подолья" &#8595',
                'messageTwo'=>"пн с 8:00 до 20:00.<br>вт с 8:00 до 20:00.<br>ср с 8:00 до 20:00.<br>
                                чт с 8:00 до 20:00.<br>пт с 8:00 до 20:00.<br>сб с 10:00 до 19:00.<br>
                                вс с 10:00 до 19:00.<br><br>Отделение травматологии работает круглосуточно."));
                unset($messageUser);
                break;
            default:
                if (isset($_SERVER['HTTP_COOKIE'])) {//do we have any
                    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);//get all cookies 
                    foreach($cookies as $cookie) {//loop
                        $parts = explode('=', $cookie);//get the bits we need
                        $name = trim($parts[0]);
                        setcookie($name, '', time()-1000);//kill it
                        setcookie($name, '', time()-1000, '/');//kill it more
                    }
                }
                echo json_encode(array('success'=>0,'message'=>'Ничего не найдено!', 'messageTwo'=>'Попробуйте ещё раз. Например: "Помощь", "Запись к врачу", "Контакты" или другое'));           
                unset($messageUser);
                break;
    }
        break;
    case '1':
        $messageUser = preg_replace('|[\s]+|s', ' ', $messageUser);
        if(isset($_COOKIE['doctor'])){
            if($messageUser=='ДА' || $messageUser=='да'){
                $id_doc_bot=$_COOKIE['doctor'];
                $sqlID=mysqli_query($bd, "SELECT question FROM bot_info WHERE id_botinfo='$id_doc_bot'");
                $rowID=mysqli_fetch_array($sqlID, MYSQLI_ASSOC);
                $messageUser=$rowID['question'];
                setcookie('doctor', '', time()-1000);
                setcookie('doctor', '', time()-1000, '/');
            }
            elseif($messageUser=='НЕТ' || $messageUser=='нет'){
                echo json_encode(array('success'=>1,'message'=>'Вы ответили "Нет".',
                'messageTwo'=>'Попробуйте ещё раз описать свои симптомы например: СИМПТОМЫ: температура, головная боль'));
                unset($messageUser);
                exit;
            }
        }
        $search='СИМПТОМЫ:';
        $pos=stripos($messageUser,$search);
        if($pos!==false){
            $messageUser=str_replace($search,'',$messageUser);
            $messages=explode(",",$messageUser);
            
            $sqlSymp=mysqli_query($bd, "SELECT question, other FROM bot_info WHERE special='symptoms'");
            while($rowSymp=mysqli_fetch_array($sqlSymp, MYSQLI_ASSOC)){
            $sympBD=explode(",", $rowSymp['other']);
            $nameDOC=$rowSymp['question'];
            $AsMass["$nameDOC"]=0;
                for($i=0;$i<count($messages);$i++){
                    for($j=0; $j<count($sympBD);$j++){
                        if($messages[$i]==$sympBD[$j]){
                            $AsMass["$nameDOC"]++;
                        }
                    }
                }
            }
            $max=0;
            $doctorR="";
            foreach($AsMass as $item => $count){
                if($doctorR==""){
                    $doctorR=$item;
                    $max=$count;
                }
                else{
                    if($max<$count){
                    $doctorR=$item;
                    $max=$count;
                    }
                }
            }
            
            if($doctorR==""){
                echo json_encode(array('success'=>1,'message'=>'По написанным вами симптомам необходимый врач не был найден.',
                'messageTwo'=>'Попробуйте ещё раз описать свои симптомы например: СИМПТОМЫ: температура, головная боль'));
                unset($messageUser);
                exit;
            }
            else{
                $sqlID=mysqli_query($bd, "SELECT id_botinfo FROM bot_info WHERE special='symptoms' AND question='$doctorR'");
                $rowID=mysqli_fetch_array($sqlID, MYSQLI_ASSOC);
                $idDOC_bot=$rowID['id_botinfo'];
                setcookie("doctor", $idDOC_bot, time()+3600);
                $text1='По написанным вами симптомам вам необходим: ' . $doctorR . '. ';
                $text2='Хотите записаться к врачу' . $doctorR . '? Напишите в чат "ДА" или "НЕТ"';
                echo json_encode(array('success'=>1,'message'=>$text1,'messageTwo'=>$text2));
                unset($messageUser);
                exit;
            }
        }
        $result=mysqli_query($bd,"SELECT id_botinfo, question, special FROM bot_info WHERE other LIKE '%$messageUser%'");
        $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
        if($row['special'] == 'doctor'){
            $speciality=$row['question'];
            $result=mysqli_query($bd, "SELECT * FROM doctor_pull WHERE speciality_doc='$speciality'");
            $text="";
            $i=1;
            while ($row2=mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $text.= $i . ". " . $row2['speciality_doc'] . ": " . $row2['firstname_doc'] . " " . $row2['lastname_doc'] . " " . $row2['patronymic_doc'] . ". <br>";
                setcookie("Doc[$i]",$row2['id_doc']);
                $i++;
            }
            echo json_encode(array('success'=>2,
            'message'=>'Выберите врача к котрому хотите записаться <br> (введите цифру врача в поле сообщения)',
            'messageTwo'=>$text));
            unset($messageUser);
        }
        else{
            echo json_encode(array('success'=>1,'message'=>'Ничего не найдено!', 'messageTwo'=>'Попробуйте ещё раз. Например: "Терапевт", "Невролог", "Врач невролог" или другое'));           
            unset($messageUser);
        }
        break;
    case '2':
        $messageUser = preg_replace('|[\s]+|s', ' ', $messageUser);
        $id_doc=$_COOKIE['Doc'];
        $result=mysqli_query($bd,"SELECT * FROM doctor_appointment WHERE id_doc='$id_doc[$messageUser]' AND mark_appoint=0");
        $error=mysqli_fetch_array($result, MYSQLI_ASSOC);
        if(empty($error['id_appoint'])){
            echo json_encode(array('success'=>2,
            'message'=>'Свободных записей нет!',
            'messageTwo'=>'Попробуйте выбрать другого врача. <br> (введите цифру врача в поле сообщения)'));
            unset($messageUser);
            exit;
        }
        $result=mysqli_query($bd,"SELECT * FROM doctor_appointment WHERE id_doc='$id_doc[$messageUser]' AND mark_appoint=0");
        $text="";
        $i=1;
        while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $text.=$i . ". Дата: " . $row['date_appoint'] . " Время: " . $row['time_appoint'] . ". <br>";
            setcookie("DateAppoint[$i]",$row['id_appoint']);
            $i++; 
        }
        echo json_encode(array('success'=>3,
            'message'=>'Выберите время и дату когда вы хотите записать к врачу <br> (введите цифру под которой нужное вам время в поле сообщения)',
            'messageTwo'=>$text));
            unset($messageUser);
        break;
    case '3':
        if($_SESSION['users']==""){
            echo json_encode(array('success'=>0,
            'message'=>'Вы не авторизированы! Если у вас уже есть аккаунт на нашем сайте авторизируйтесь <a href="sign_up.php">здесь</a>',
            'messageTwo'=>'Если у вас нет аккаунта на нашем сайте, зарегистрируйтесь <a href="reg.php">здесь</a>'));
            unset($messageUser);
            exit;
        }
        $sql=mysqli_query($bd,"SELECT id_user FROM users WHERE login_user='$user'");
        $sqlRow=mysqli_fetch_array($sql,MYSQLI_ASSOC);
        $id_user=$sqlRow['id_user'];
        $messageUser = preg_replace('|[\s]+|s', ' ', $messageUser);
        $id_appoint=$_COOKIE['DateAppoint'];
        $result=mysqli_query($bd,"SELECT id_appoint FROM doctor_appointment WHERE id_appoint='$id_appoint[$messageUser]' ");
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
        if($row['id_appoint']==''){
            echo json_encode(array('success'=>3,
            'message'=>'Ничего не найдено! Вы выбрали неправильное время.',
            'messageTwo'=>'Попробуйте выбрать другое время <br> (введите цифру под которой нужное вам время в поле сообщения)'));
            unset($messageUser);
            exit;
        }
        $result=mysqli_query($bd,"UPDATE doctor_appointment SET id_user='$id_user', mark_appoint=1 WHERE id_appoint='$id_appoint[$messageUser]'");
        if($result==TRUE){
            $result=mysqli_query($bd,"SELECT date_appoint, time_appoint, firstname_doc, lastname_doc, patronymic_doc, doctor_pull.speciality_doc FROM doctor_appointment INNER JOIN doctor_pull on doctor_appointment.id_doc=doctor_pull.id_doc WHERE id_appoint='$id_appoint[$messageUser]'");
            $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
            $datereg=date("Y-m-d");
            $sqlEvent=mysqli_query($bd, "INSERT INTO event_user (date_event, id_user, `event`, close_event) VALUES ('$datereg', '$id_user', 'Запись пользователя к врачу', 0)");
            echo json_encode(array('success'=>0,
            'message'=>"Вы успешно записаны к врачу: <br>" . $row['doctor_pull.speciality_doc'] . " " . $row['firstname_doc'] . " " . $row["lastname_doc"] . " " . $row["patronymic_doc"] . "<br> На календарную дату " . $row["date_appoint"] . " в " .$row["time_appoint"] ,
            'messageTwo'=>'Я могу вам еще чем нибудь помочь?'));
            unset($messageUser);
            
            exit;
        }
        break;

    case '99':
        echo json_encode(array('success'=>0,
        'message'=>'Привет ' . $messageUser . ', чем могу помочь?',
        'messageTwo'=>'Вы можете ознакомиться с возможностями бота написав в чат "Помощь" или "Хелп".<br>
                        Введите в поле сообщения интересующий вас вопрос.<br>
                        Например: "Запись к врачу".'));
        unset($messageUser);
        break;
}



?>