<?php

require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);

if($method === 'get'){
    
    $cidade = filter_input(INPUT_GET,'cidade');

    if($cidade){

        $sql = $pdo->prepare("SELECT COUNT(id) as total FROM usuarios WHERE cidade = :cidade ");
        $sql->bindValue(':cidade', $cidade);
        $sql->execute();

        if($sql->rowCount() > 0 ){
            
            $data = $sql->fetch(PDO::FETCH_ASSOC);

            $array['result'] = [

                'total' => $data['total']
            ];

        }else{
            $array['error'] = 'cidade não cadastrada';
        }
    }else{
        $array['error'] = 'cidade não enviada.';
    }
    
}else{
    $array['error'] = 'Método não permitido, (apenas GET)';
}

require('../cors.php');