<?php
//função para adicionar mensagem de sucesso

function addSuccessMsg($msg){
    $_SESSION['message'] = [
        'type' => 'success',
        'message' => 'Ponto inserido com sucesso'
    ];
}

function addErrorMsg($msg){
    $_SESSION['message'] = [
        'type' => 'error',
        'message' => $msg
    ];
}