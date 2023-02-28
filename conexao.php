<?php

$dbHost = "localhost";
$dbName = "crud_clientes";
$dbUser = "root";
$dbPass = "";

$db = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// if($db->connect_errno){
//     echo "Falha ao conectar!";
//     die;
// }else{
//     echo "Conectado com sucesso";
// }

function formatar_data($data)
{
    return implode('/', array_reverse(explode('-', $data)));
}
function formatar_telefone($telefone)
{
    $ddd = substr($telefone, 0, 2);
    $parte1 = substr($telefone, 2, 5);
    $parte2 = substr($telefone, 7);
    return "($ddd) $parte1-$parte2";
}
