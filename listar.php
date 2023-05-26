<?php
  //URL da API
  $url = "http://localhost/ad1/api/XML.php";

  //função curl para iniciar uma nova sessão
  $ch = curl_init();

  //utiliza CURLOPT_RETURNTRANSFER para esperar a resposta
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, $url);

  //enviar a requisição
  curl_setopt($ch, CURLOPT_URL, $url);

  //executa a solicitação de curl
  $dados = curl_exec($ch);

  //fechar a sessão CURL e liberar todos os recursos
  curl_close($ch);

  //echo $dados;

  //Transformar o conteudo XML em Objeto
  $xml = simplexml_load_string($dados);

  //acessar o IF se encontrar fornecedores
  if (isset($xml->fornecedor)) {
    //percorrer todos os registros de fornecedores
    foreach ($xml->fornecedor as $fornecedor):
    //imprimir as informações
      echo "ID : ".$fornecedor->id."<br>";
      echo "Contato : ".$fornecedor->contato."<br>";
      echo "Empresa : ".$fornecedor->empresa."<br>";
      echo "Telefone : ".$fornecedor->telefone."<br>";
      echo "E-mail : ".$fornecedor->email."<br>";
      echo "Descrição : ".$fornecedor->descricao."<br>";

      echo "<hr>";
    endforeach;
  }if($xml->erro){
    //imprimir erro
    echo $dados;
  }


?>