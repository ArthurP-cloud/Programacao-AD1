<?php
include_once "./api/conexao.php";

$sql = "SELECT * FROM fornecedores";
$result = $conn->prepare($sql);
$result->execute();
$verifyrows = $result->rowCount();
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
  <div class="logo">
    <img src="./estilo/imagens/distribuidora-logo.png" alt="Keep Work" />
  </div>
  <p class="ptodos">Todos os fornecedores</p>
  <div class="consultas">
    <section>
      <?php
      echo "Registros encontrados: " . $verifyrows;
      echo "<br><br>";
      while ($row_fornecedor = $result->fetch(PDO::FETCH_ASSOC)) {
        //extrair a row para ler as colunas em forma de array
        extract($row_fornecedor);

        print "<article id='" . $row_fornecedor['id'] . "'>";
        print "<div class='divarticle1'>";
        print "ID: " . $row_fornecedor['id'];
        print "<br>";
        print "<p>Contato: " . $row_fornecedor['contato'];
        print "<p>Empresa: " . $row_fornecedor['empresa'];
        print "<br>";
        print "Telefone: " . $row_fornecedor['telefone'];
        print "<br>";
        print "E-mail: " . $row_fornecedor['email'];
        print "<br>";
        print "</div>";
        print "<div class='divarticle2'>";
        print $row_fornecedor['descricao'];
        print "<br>";
        print "</div>";
        print "<button id='" . $row_fornecedor['id'] . "' class='botaoRemoverFornecedor'>remover</button>";
        print "<button codigo='" . $row_fornecedor['id'] . "' class='botaoEditarFornecedor'>editar</button>";
        print "</article>";
      }
      ?>
    </section>

  </div>

  <script defer>
    window.addEventListener("load", (event) => {
      const botoesRemoverFornecedor = document.querySelectorAll('.botaoRemoverFornecedor');

      botoesRemoverFornecedor.forEach(botao => {
        let idBotao;
        botao.addEventListener('click', e => {
          idBotao = e.target.id;
          const dadosParaEnviar = {
            id: e.target.id
          }
          fetch('./excluir.php', {
            method: 'POST',
            body: JSON.stringify(dadosParaEnviar),
            headers: {
              "Content-type": "application/json; charset=UTF-8"
            }
          }).then(resp => {
            return resp.text();
          }).then(respObj => {
            location.reload();
          })
        })
      })

      const botoesEditarFornecedor = document.querySelectorAll('.botaoEditarFornecedor');

      botoesEditarFornecedor.forEach(botao => {
        let idBotao;
        botao.addEventListener('click', e => {
          idBotao = e.target.getAttribute('codigo');
          console.log(idBotao)
          window.location.replace('./editar.php?id=' + idBotao)
        })
      })
    });
  </script>
</body>

</html>