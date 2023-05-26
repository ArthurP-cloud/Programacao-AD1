<?php
include_once "./api/conexao.php";
session_start();
if($_GET['id']!= 0){
$editarid = $_GET['id'];
$sql = "SELECT * FROM fornecedores WHERE id = '$editarid'";
$result = $conn->prepare($sql);
$result->execute();

$row_fornecedor = $result->fetch(PDO::FETCH_ASSOC);
extract($row_fornecedor);
}

if (count($_POST) > 0) {
  $postdata = file_get_contents("php://input");
  // var_dump($postdata);

  $id = $_POST['id'];
  $contato = $_POST['nomef'];
  $empresa = $_POST['nomee'];
  $telefone = $_POST['tel'];
  $email = $_POST['email'];
  $descricao = $_POST['desc'];
  $sql = "UPDATE fornecedores SET contato='$contato', empresa='$empresa', telefone='$telefone', email='$email', descricao='$descricao' WHERE id = '$id'";
  $result = $conn->prepare($sql);
  $result->execute();
  $verifyrows = $result->rowCount();
  header('Location: ' . 'http://localhost/ad1/consulta.php');
  die();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./estilo/estilo.css" />
  <title>AD1 edição</title>
  <script language="javascript" type="text/javascript">
    function mascarafone(objeto) {
      var aux
      aux = "(" + objeto.value.substr(0, 2) + ")"
      aux += objeto.value.substr(2, 4) + "-" + objeto.value.substr(6, 4)
      objeto.value = aux
    }
  </script>
</head>

<body>
  <nav>
    <div class="divs">
      <div class="btncadastrar">
        <button class="btn"><a href="./index.html">Cadastrar</a></button>
      </div>
      <div class="btnconsultar">
        <button class="btn"><a href="./consulta.php">Consulta</a></button>
      </div>

      <div class="btnlistar">
        <button class="btn">
          <a target="_blank" href="./listar.php">Listar</a>
        </button>
      </div>
    </div>
  </nav>
  <h1>Edicão de fornecedor:</h1>
  <h2>Editando fornecedor de id: <?php echo $_GET['id'] ?> </h2>
  <div class="logo">
    <img src="./estilo/imagens/distribuidora-logo.png" alt="Keep Work" />
  </div>
  <div class="dforms">
    <div class="texts">
      <p>Contato:</p>
      <br />
      <p>Empresa:</p>
      <br />
      <p>Telefone:</p>
      <br />
      <p>E-mail:</p>
      <br />
      <p>Descrição:</p>
    </div>
    <div class="forms">
      <form action="editar.php" method="post">
        <input type="text" name="nomef" value="<?php echo $row_fornecedor['contato'];?>" required />
        <p></p>
        <br />
        <input type="text" name="nomee" value="<?php echo $row_fornecedor['empresa'];?>" required />
        <p></p>
        <br />
        <input type="tel" name="tel" value="<?php echo $row_fornecedor['telefone'];?>" onblur="mascarafone(this)" required />
        <p></p>
        <br />
        <input type="email" name="email" value="<?php echo $row_fornecedor['email'];?>" required />
        <input type="text" name="id" required style="display: none" value="<?php echo $_GET['id'] ?>" ; />
        <p></p>
        <br />

        <textarea name="desc" class="desc" id="" cols="30" rows="10"  required><?php echo $row_fornecedor['descricao'];?></textarea>
        <input type="submit" class="btnf" value="Salvar" />
        <input type="reset" class="btnf" value="Limpar" />
      </form>
    </div>
  </div>
</body>

</html>