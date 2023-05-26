<?php
      include_once"./api/conexao.php"; 

      $contato = $_POST["nomef"];
      $empresa = $_POST['nomee'];
      $telefone = $_POST['tel'];
      $email = $_POST['email'];
      $descricao = $_POST['desc'];

      $sql = "SELECT email FROM fornecedores where email = '$email'";

      $result = $conn->prepare($sql);
      $result->execute();
      $verifyrows = $result->rowCount();

      if($verifyrows < 1){

        $sql = "INSERT INTO fornecedores (contato,empresa,telefone,email,descricao) values ('$contato','$empresa','$telefone','$email','$descricao')";

        $result = $conn->prepare($sql);
        $result->execute();

        $verify=1;

      }else{

        $verify =0;
      }

      
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./estilo/estilo.css" />
    <title>Cadastrado?</title>
  </head>
  <body>
    <nav>
      <div class="divs">
        <div class="btncadastrar">
          <form action="index.html">
            <input type="submit" class="btn" value="Cadastrar" />
          </form>
        </div>
        <div class="btnconsultar">
          <form action="consulta.php">
            <input type="submit" class="btn" value="Consultar" />
          </form>
        </div>
        <div class="btnlistar">
          <form action="listar.php">
            <input type="button" class="btn" value="Listar" />
          </form>
        </div>
      </div>
    </nav>
    
    <div class="logo">
      <img src="./estilo/imagens/distribuidora-logo.png" alt="Keep Work" />
    </div>
    <?php
      if ($verify==1){
        echo "<p style='color: green'>Cadastro realizado com sucesso<p>";
      }else{
        echo "<p style='color: red'>Cadastro não realizado, email já existente.<p>";
      }

    ?>  
      
  </body>
</html>