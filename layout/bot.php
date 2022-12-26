<?php
    
    session_start();
    $user=$_SESSION['users'];
    $nameU=$_SESSION['nameU'];

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
    
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/myCSS.css">
    <title>Главная страница</title>
</head>
<body>
    <!--this header site-->
    <?=$Shablon_header;?>
    
    <!--this body and content site-->
    <main>
        <div class="bot">
            <div class="image_bot">
                <img src="../image/bot.png" alt="">
            </div>
            <div class="chat_bot" id="chat_bot">
                <?php 
                    if($nameU==""){ 
                ?>
                <div class="message_bot">
                <p>(Введите свое имя в поле сообщения.)</p>
                </div>
                <div class="message_bot">
                <p>Как мне к вам обращаться?</p>
                </div>
                <div class="message_bot">
                <p>Привет я Бот-Помощник Олег</p>
                </div>
            </div>
            <form id="botForm" method="POST" class="input_message">
                    <input type="text" placeholder="Написать сообщение..." name="messageUser" id="messageUser">
                    <input type="button" name="reset1" id="reset1">
                    <input type="submit" name="sendBtn" id="sendBtn" value="">
                    <input type="hidden" name="algBot" id="algBot" value="99">
            </form>
                <? } else {?>
                <div class="message_bot">
                <p>Введите в поле сообщения интересующий вас вопрос. <br>
                    Например: "Запись к врачу".</p>
                </div>
                <div class="message_bot">
                <p>Вы можете ознакомиться с возможностями бота написав в чат "Помощь" или "Хелп". </p>
                </div>
                <div class="message_bot">
                <p>Привет <?=$nameU;?>, Я бот-Олег. Чем могу помочь?</p>
                </div>
                
            </div>
            <form id="botForm" method="POST" class="input_message">
                    <input type="text" placeholder="Написать сообщение..." name="messageUser" id="messageUser">
                    <input type="button" name="reset1" id="reset1">
                    <input type="submit" name="sendBtn" id="sendBtn" value="">
                    <input type="hidden" name="algBot" id="algBot" value="0">
            </form>
            <? }?>
        </div>
        <script type="text/javascript">
        $(document).ready(function() {
            $('#botForm').submit(function(e) {
                var message_user=$('#messageUser').val();
                var newUserElems=$("<div class='message_user'><p>"+ message_user +"</p></div>");
                $('#chat_bot').prepend(newUserElems);

                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: '../php/functionBot.php',
                    data: $(this).serialize(),
                    success: function(response)
                    {
                        var jsonData = JSON.parse(response);
        
                        $('#algBot').val(jsonData.success);
                        var newElems=$("<div class='message_bot'><p>"+ jsonData.message +"</p></div>");
                        $('#chat_bot').prepend(newElems);
                        var newElems=$("<div class='message_bot'><p>"+ jsonData.messageTwo +"</p></div>");
                        $('#chat_bot').prepend(newElems);
                        $('#botForm')[0].reset();
                }
            });
            });
        });
        $("#reset1").click(function(){
            $('#botForm')[0].reset();
            $('.message_bot').remove();
            $('.message_user').remove();
            var newElems=$("<div class='message_bot'><p>Привет <?=$nameU;?>, Я бот-Олег. Чем могу помочь?</p></div>");
            $('#chat_bot').prepend(newElems);
            var newElems=$('<div class="message_bot"><p>Вы можете ознакомиться с возможностями бота написав в чат "Помощь" или "Хелп". </p></div>');
            $('#chat_bot').prepend(newElems);
            var newElems=$('<div class="message_bot"><p>Введите в поле сообщения интересующий вас вопрос. <br>Например: "Запись к врачу".</p></div>');
            $('#chat_bot').prepend(newElems);
            $('#algBot').val('0');
            
        });
</script>
    </main>
    <!--this footer site-->
    <?=$Shablon_footer;?>
</body>
</html>
<?=$script;?>