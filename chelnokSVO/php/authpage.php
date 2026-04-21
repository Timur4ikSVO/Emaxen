<?php
if ($_SERVER['REQUEST_METHOD'] !=='POST'){
    http_response_code(405);
    exit();
}

session_start();
//массив данных пользователя
$inputs =[
'login',
'password',
];

foreach($inputs as $input){
    if(!isset($_POST[$input]) || $_POST[$input]==''){
        $_SESSION['message']= "Заполните все поля!";
       header("Location:../auth.php?stat=error");
            exit();    
    };
};



$login = trim($_POST['login']);
$password = $_POST['password'];


require_once '../database/db.php';

$CheckUser = $conn -> prepare(
    "select * from users where login = :login or email = :email");

$CheckUser -> execute([':login' => $login, ':email' => $login]);


$CheckUser = $CheckUser -> fetch(PDO::FETCH_ASSOC);

if(!$CheckUser || !password_verify($password, $CheckUser['password'])){
     $_SESSION['message']= "Неверный логин или пароль";
       header("Location:../auth.php?stat=error");
            exit();
}

session_regenerate_id(true);

$_SESSION['user'] = [
    'userid' => $CheckUser['id'],
    'userLogin' => $CheckUser['login'],
    'userEmail' => $CheckUser['email'],
    'userTel' => $CheckUser['tel'],
    'userFio' => $CheckUser['fio'],
    'userRole' => $CheckUser['role']
];

var_dump($_SESSION['user']);

    if ($_SESSION['user']['userRole']==='user'){
    $homePage = '../userPage.php';
}
    if ($_SESSION['user']['userRole']==='admin'){
    $homePage = '../adminPage.php';
}



//перенаправление
     $_SESSION['message']= "Успешная Регистрация";
        header("Location:".$homePage);
        exit();

// ?>