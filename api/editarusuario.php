<?php

require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);

if($method === 'put'){
  
    parse_str(file_get_contents('php://input'), $input);

    $id = $input['id'] ?? null;
    $usuario = $input['usuario'] ?? null;
    $endereco = $input['endereco'] ?? null;
    $cidade = $input['cidade'] ?? null;
    $estado = $input['estado'] ?? null;

    $id = filter_var($id);
    $usuario = filter_var($usuario);
    $endereco = filter_var($endereco);
    $cidade = filter_var($cidade);
    $estado = filter_var($estado);

    if($id && $usuario && $endereco && $cidade && $estado){

        $sql = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
        $sql->bindValue(':id',$id);
        $sql->execute();

        if($sql->rowCount() > 0){

         $sql = $pdo->prepare("UPDATE usuarios SET usuario = :usuario, endereco = :endereco, cidade = :cidade, estado = :estado WHERE id = :id");
         $sql->bindValue(':id',$id);
         $sql->bindValue(':usuario',$usuario);
         $sql->bindValue(':endereco',$endereco);
         $sql->bindValue(':cidade',$cidade);
         $sql->bindValue(':estado',$estado);
         $sql->execute();

         $array['result'] = [
            'id' => $id,
            'usuario' => $usuario,
            'endereco' => $endereco,
            'cidade' => $cidade,
            'estado' => $estado
         ];

        }else{

            $array['error'] = 'ID inexistente';
        }


    }else{
        $array['error'] = 'Dados não enviados';
    }


}else{
    $array['error'] = 'Método não permitido, (apenas PUT)';
}

require('../cors.php');
