<?php

require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);

if($method === 'post'){
    
    $usuario = filter_input(INPUT_POST,'usuario');
    $endereco = filter_input(INPUT_POST,'endereco');
    $cidade = filter_input(INPUT_POST,'cidade');
    $estado = filter_input(INPUT_POST,'estado');

    if($usuario && $endereco && $cidade && $estado){
        $sql = $pdo->prepare("INSERT INTO usuarios (usuario, endereco, cidade, estado) VALUES (:usuario, :endereco, :cidade, :estado)");
        $sql->bindValue(':usuario',$usuario);
        $sql->bindValue(':endereco',$endereco);
        $sql->bindValue(':cidade',$cidade);
        $sql->bindValue(':estado',$estado);
        $sql->execute();

        $id = $pdo->lastInsertId();

        $array['result'] = [
            'id' => $id,
            'usuario' => $usuario,
            'endereco' => $endereco,
            'cidade' => $cidade,
            'estado' => $estado,
        ];

    }else{
        $array['error'] = 'Campos não enviados';
    }

}else{
    $array['error'] = 'Método não permitido, (apenas POST)';
}

require('../cors.php');