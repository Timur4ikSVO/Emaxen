<?php
 if (!isset($_SESSION['user']) || $_SESSION['user']['userRole'] !=='user') {
    echo '<p>Вы кто такие идите в вар тандер</p>';
    exit();
 }

 require_once 'database/db.php';

 $messages = $conn -> prepare("select * from messages where user_id = :userId order by created_at desc");
 $messages -> execute([':userId' => $_SESSION['user']['userid']]);

?>