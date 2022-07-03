<?php

    require_once('repository/OtakuRepository.php');
    require_once('util/base64.php');

    # https://www.php.net/manual/pt_BR/filter.filters.sanitize.php
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $animepreferido = filter_input(INPUT_POST, 'animepreferido', FILTER_SANITIZE_SPECIAL_CHARS);
    $idade = filter_input(INPUT_POST, 'idade', FILTER_SANITIZE_NUMBER_INT);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    $foto = converterBase64($_FILES['foto']);

if(empty($nome) || empty($foto) || empty($animepreferido) || empty($idade) || empty($email)) {
    $msg = "Preencher todos os campos primeiro.";
   } else {
        if(fnAddUsuario($nome, $foto, $animepreferido, $idade, $email)) {
        $msg = "Sucesso ao gravar";
    } else {
        $msg = "Falha na gravação";
    }
   }
    $page = "formulario-cadastro-otaku.php";
    setcookie('notify',$msg, time() + 10,"/sga/{$page}", 'localhost');
    
    header("location: {$page}");
    exit;