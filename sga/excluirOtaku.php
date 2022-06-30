<?php

    require_once('repository/OtakuRepository.php');
    session_start();

   

    if(fnDeleteUsuario($_SESSION['id'])) {
        $msg = "Sucesso ao excluir";
    } else {
        $msg = "Falha na exclusão";
    }

#apagar sessão
    unset($_SESSION['id']);

    $page = "lista-de-otaku.php";
    setcookie('notify', $msg, time() +10,"/sga/{$page}", 'localhost');
    header("location: {$page}");
    exit;
    