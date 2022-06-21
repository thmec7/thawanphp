<?php
    require_once('repository/OtakuRepository.php');
    $nome = filter_input(INPUT_POST, 'nomeAluno', FILTER_SANITIZE_SPECIAL_CHARS);

    header("location: lista-de-otaku.php?nome={$nome}");
    exit;