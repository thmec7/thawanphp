<?php

    require_once('Connection.php');

    # CRUD

    function fnAddUsuario($nome, $foto, $animepreferido, $idade, $email) {
        $con = getConnection();
        
        # SQL Injection
        $sql = "insert into usuario (nome, foto, animepreferido, idade, email) values (:pNome, :pFoto, :pAnimepreferido, :pIdade, :pEmail)";
        
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pNome", $nome); 
        $stmt->bindParam(":pFoto", $foto); 
        $stmt->bindParam(":pAnimepreferido", $animepreferido); 
        $stmt->bindParam(":pIdade", $idade); 
        $stmt->bindParam(":pEmail", $email);
        
        return $stmt->execute();
    }
    function fnListOtaku() {
        $con = getConnection();
        $sql = "select * from usuario";
     $result = $con->query($sql);

     $lstOtakus = array();
     while($usuario = $result->fetch(PDO::FETCH_OBJ)) {
         array_push($lstOtakus,$usuario);
     }
     return $lstOtakus;

    }
    
    function fnLocalizaOtakuPorNome($nome) {
        $con = getConnection();
    
        $sql = "select * from usuario where nome like :pNome limit 20";
    
        $stmt = $con->prepare($sql);
    
        $stmt->bindValue(":pNome", "%{$nome}%");
    
        if($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            return $stmt->fetchAll();
        }
    }


    function fnLocalizaOtakuPorId($id) {
        $con = getConnection();
        $sql = "select * from usuario where id = :pID";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pID",$id);
     
if($stmt->execute()) {
    return $stmt->fetch(PDO::FETCH_OBJ);
}
return null;



    }
    function fnUpdateUsuario($id,$nome, $animepreferido, $idade, $email) {
        $con = getConnection();
        

        $sql = "update usuario set nome = :pNome, animepreferido = :pAnimepreferido, idade = :pIdade, email = :pEmail where id = :pID";
        
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