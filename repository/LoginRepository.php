<?php

    require_once('Connection.php');

    # CRUD

    function fnAddUsuario($nome, $animepreferido, $idade) {
        $con = getConnection();
        
        # SQL Injection
        $sql = "insert into usuario (nome, animepreferido, idade, email) values (:pNome, :pAnimepreferido, :pIdade,:pEmail)";
        
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pNome", $nome); 
        $stmt->bindParam(":pAnimepreferido", $animepreferido); 
        $stmt->bindParam(":pIdade", $idade); 
        $stmt->bindParam(":pEmail", $email);
        
        return $stmt->execute();
    }
    function fnListOtaku() {
        $con = getConnection();
        $sql = "select* from usuario";
     $result = $con->query($sql);

     $lstOtakus = array();
     while($usuario = $result->fetch(PDO::FETCH_OBJ)) {
         array_push($lstOtakus,$usuario);
     }
     return $lstOtakus;

    }
    function fnLocalizaOtakuPorId($id) {
        $con = getConnection();
        $sql = "select* from usuario where id = :pID";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pID",$id);
     
if($stmt->execute()) {
    return $stmt->fetch(PDO::FETCH_OBJ);
}
return null;

    }
    function fnUpdateUsuario($id,$nome, $animepreferido, $idade) {
        $con = getConnection();
        

        $sql = "update usuario set nome = :pNome, animepreferido = :pAnimepreferido, idade = :pIdade, email = pEmail where id= :pID";
        
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pID", $id);
        $stmt->bindParam(":pNome", $nome); 
        $stmt->bindParam(":pAnimepreferido", $animepreferido); 
        $stmt->bindParam(":pIdade", $idade); 
        $stmt->bindParam(":pEmail", $email);
        
        return $stmt->execute();
    }
    function fnDeleteUsuario($id) {
        $con = getConnection();
        

        $sql = "delete from usuario where id= :pID";
        
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pID", $id);
        
        return $stmt->execute();
    }
    function fnLogin($email, $senha) {
        $con = getConnection();

        $sql = "select * from login where email = :pEmail and senha = :pSenha";

        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pEmail", $email);
        $stmt->bindValue(":pSenha", md5($senha));

        if($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        return null;
    }