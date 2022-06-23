<?php

    require_once('repository/OtakuRepository.php');
    session_start();

    $id = filter_input(INPUT_POST, 'idOtaku', FILTER_SANITIZE_NUMBER_INT);
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $animepreferido = filter_input(INPUT_POST, 'animepreferido', FILTER_SANITIZE_SPECIAL_CHARS);
    $idade = filter_input(INPUT_POST, 'idade', FILTER_SANITIZE_NUMBER_INT);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    if(fnUpdateUsuario($id, $nome, $animepreferido, $idade, $email)) {
        $msg = "Sucesso ao gravar";
    } else {
        $msg = "Falha na gravação";
    }
    
    $_SESSION['id'] = $id;
    $page = "formulario-edita-otaku";
    setcookie('notify', $msg, time() +10, "/sga/{$page}",'localhost');
    
    header("location: {$page}");
    exit;