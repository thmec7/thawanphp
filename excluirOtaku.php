<?php

    require_once('repository/OtakuRepository.php');

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
   

    $msg = "";
    if(fnDeleteUsuario($id)) {
        $msg = "Sucesso ao gravar";
    } else {
        $msg = "Falha na gravação";
    }

    # redirect para a página de formulário
    header("location: lista-de-otaku.php?notify={$msg}");
    exit;