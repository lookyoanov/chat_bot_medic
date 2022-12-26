<?php
    $bd=mysqli_connect('localhost','root','root', 'clinica_bot');
    if(!$bd){
        printf("Connect failed: %s/n", mysqli_connect_error());
        exit();
    }
?>