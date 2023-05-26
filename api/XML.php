<?php
  //incluindo arquivo que realiza a conexao com o BD
  include_once"./conexao.php";

  //preparando e executando a QUERY
  $sql = "SELECT id,contato,empresa,telefone,email,descricao FROM fornecedores";

  $result = $conn->prepare($sql);

  $result->execute();

  if (($result) && ($result->rowCount() != 0)) {
    //cabeçalho indicando formato XML
    header("conten-type: text/xml charset=utf-8");

    //função PHP para retornar string XML
    $fornecedoresXML = new SimpleXMLElement("<fornecedores></fornecedores>");

    //ler registros retornados do banco de dados enquanto existir
    while($row_fornecedor = $result->fetch(PDO::FETCH_ASSOC)){
      //extrair a row para ler as colunas em forma de array
      extract($row_fornecedor);
      
      //Acrescentar tags XML
      $fornecedorXML = $fornecedoresXML->addChild("fornecedor");
      $fornecedorXML->addChild('id',$id);
      $fornecedorXML->addChild('contato',$contato);
      $fornecedorXML->addChild('empresa',$empresa);
      $fornecedorXML->addChild('telefone',$telefone);
      $fornecedorXML->addChild('email',$email);
      $fornecedorXML->addChild('descricao',$descricao);
    }
    //imprimir XML
    echo $fornecedoresXML->asXML();

    //Pausar o processamento
    exit();
  }else{
    //criar TAG filha de erro
    $fornecedoresXML->addChild('erro',"Erro: Nenhum fornecedor encontrado");

    //imprimir XML
    echo $fornecedoresXML->asXML();

    //Pausar o processamento
    exit();
  }

?>