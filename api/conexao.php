<?php

$hostname = "localhost";
$user = "root";
$password = "";
$database = "ad1";
$port = 3306;

try {
  //conexao com a porta
  //$conn = new PDO("mysql:host=$hostname;port=$port;dbname=".$datanase, $user, $password);

  //conexao sem a porta
  $conn = new PDO("mysql:host=$hostname;dbname=".$database, $user, $password);
  //echo "Conexão realizada com sucesso.";
} catch (PDOException $erro) {
  //pausar o processamento
  die("Erro: Conexão com o banco de dados falhou.".$erro->getMessage());
  
}

?>