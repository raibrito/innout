<?php
loadModel('Login');
session_start();
$exception = null; //variavel só será setada se cair dentro do catch

if(count($_POST) > 0) {
    $login = new Login($_POST);
    try {
        $user = $login->checkLogin();
        $_SESSION['user'] = $user;
        header("Location: day_records.php");
    } catch(AppException $e) {
        $exception = $e;
    }
}


//alem de ter os dados do $_POST, também terá mais uma outra chave chamada exception que estará disponível dentro da view
loadView('login', $_POST + ['exception' => $exception]);
