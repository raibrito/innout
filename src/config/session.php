<?php
//verificar se a sessao está válida ou não

function requireValidSession($requiresAdmin = false){
    $user = $_SESSION['user'];
    if(!isset($user)){
        header('Location: login.php');
        exit();
    }elseif ($requiresAdmin && !$user->is_admin){
        addErrorMsg('Acesso negado');
        header('Location: login.php');
        exit();
    }
}