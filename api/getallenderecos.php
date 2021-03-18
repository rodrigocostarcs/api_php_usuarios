<?php

require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);

if($method === 'get'){

    $sql = $pdo->query("SELECT id, endereco FROM usuarios");

    if($sql->rowCount() > 0 ){

        $data = $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach($data as $item){

            $array['result'][] = [

                'id' => $item['id'],
                'endereco' => $item['endereco'],
            ];
        } 
    }

}else{
    $array['error'] = 'Método não permitido, (apenas GET)';
}

require('../cors.php');