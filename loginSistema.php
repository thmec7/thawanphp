<?php

    session_start();
    require_once('repository/LoginRepository.php');

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

    $page= "lista-de-otaku.php";
    
    
  
    if(!$_SESSION['login'] = fnLogin($email, $senha)) {
        $page = "errorPage.php";
    
        $expire = (time()+20);
        
        setcookie('notify','Falha ao efetuar o Login', $expire, '/sga/errorPage.php', 'localhost', isset($_SERVER['HTTPS']), true);
    }
    
    header("location: {$page}");
    exit;