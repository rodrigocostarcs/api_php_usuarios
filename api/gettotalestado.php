<?php

require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);

if($method === 'get'){
    
    $estado = filter_input(INPUT_GET,'estado');

    if($estado){

        $sql = $pdo->prepare("SELECT COUNT(id) as total FROM usuarios WHERE estado = :estado ");
        $sql->bindValue(':estado', $estado);
        $sql->execute();

        if($sql->rowCount() > 0 ){
            
            $data = $sql->fetch(PDO::FETCH_ASSOC);

            $array['result'] = [

                'total' => $data['total']
            ];

        }else{
            $array['error'] = 'estado não cadastrado';
        }
    }else{
        $array['error'] = 'estadoa não enviado.';
    }
    
}else{
    $array['error'] = 'Método não permitido, (apenas GET)';
}

require('../cors.php');