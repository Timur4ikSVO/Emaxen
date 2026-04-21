<?php
$host = "mysql:host=localhost;dbname=examenSVO;charset=utf8";
$user = "root";
$pass = "";
$errmode = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXEPTION];
try{
    $conn = new PDO($host, $user, $pass, $errmode);
} catch(pDOExeption $e) {
    echo "Ошибка подключения к базе данных".$e->getmessage();
}
?>