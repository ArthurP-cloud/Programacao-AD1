 <?php

  include_once "./api/conexao.php";
  $_POST = json_decode(file_get_contents("php://input"), true);
  $id = $_POST['id'];
  $sql = "DELETE FROM fornecedores where id = $id";
  $result = $conn->prepare($sql);
  $result->execute();
  $verifyrows = $result->rowCount();

  ?>