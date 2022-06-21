<?php

    require_once('repository/OtakuRepository.php');

    $id = filter_input(INPUT_POST, 'idOtaku', FILTER_SANITIZE_NUMBER_INT);
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $animepreferido = filter_input(INPUT_POST, 'animepreferido', FILTER_SANITIZE_SPECIAL_CHARS);
    $idade = filter_input(INPUT_POST, 'idade', FILTER_SANITIZE_NUMBER_INT);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    $msg = "";
    if(fnUpdateUsuario($id, $nome, $animepreferido, $idade, $email)) {
        $msg = "Sucesso ao gravar";
    } else {
        $msg = "Falha na gravação";
    }

    # redirect para a página de formulário
    header("location: formulario-edita-otaku.php?notify={$msg}&id=$id");
    exit;