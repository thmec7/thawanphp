<?php

    require_once('repository/OtakuRepository.php');

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
   

    if(fnDeleteUsuario($id)) {
        $msg = "Sucesso ao excluir";
    } else {
        $msg = "Falha na exclusão";
    }
    $page = "lista-de-otaku.php";
    setcookie('notify',$msg,time() +10,"/sga/{$page}",'localhost');
    header("location: {$page}");
    exit;
    