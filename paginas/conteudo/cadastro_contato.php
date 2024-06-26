<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AgendMaster</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f4f6f9;
    }

    .content-wrapper {
      margin: 20px;
    }

    .card-primary {
      border-top: 3px solid #007bff;
    }

    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }

    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }

    .card-header {
      background-color: #007bff;
      color: white;
    }

    .btn-success {
      margin-right: 5px;
    }

    .btn-danger {
      margin-left: 5px;
    }
  </style>
</head>

<body>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cadastro de Contatos</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Cadastrar contato</h3>
              </div>
              <form role="form" action="" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" name="nome" id="nome" required placeholder="Digite o nome de contato">
                  </div>
                  <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="text" class="form-control" name="telefone" id="telefone" required placeholder="(00) 00000-0000">
                  </div>
                  <div class="form-group">
                    <label for="email">Endereço de E-mail</label>
                    <input type="email" class="form-control" name="email" id="email" required placeholder="Digite um e-mail">
                  </div>
                  <div class="form-group">
                    <label for="foto">Foto do contato</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="foto" id="foto" required>
                        <label class="custom-file-label" for="foto">Arquivo de imagem</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="autorizacao" required>
                    <label class="form-check-label" for="autorizacao">Autorizo o cadastro do meu contato</label>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" name="botao" class="btn btn-primary">Cadastrar Contato</button>
                </div>
              </form>
              <?php
              include('../config/conexao.php');
              if (isset($_POST['botao'])) {
                $nome = $_POST['nome'];
                $telefone = $_POST['telefone'];
                $email = $_POST['email'];
                $formatP = array("png", "jpg", "jpeg", "JPG", "gif");
                $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

                if (in_array($extensao, $formatP)) {
                  $pasta = "../img/";
                  $temporario = $_FILES['foto']['tmp_name'];
                  $novoNome = uniqid() . ".$extensao";

                  if (move_uploaded_file($temporario, $pasta . $novoNome)) {
                    $cadastro = "INSERT INTO tb_contatos (nome_contatos,fone_contatos,email_contatos,foto_contatos) VALUES (:nome,:telefone,:email,:foto)";

                    try {
                      $result = $conect->prepare($cadastro);
                      $result->bindParam(':nome', $nome, PDO::PARAM_STR);
                      $result->bindParam(':telefone', $telefone, PDO::PARAM_STR);
                      $result->bindParam(':email', $email, PDO::PARAM_STR);
                      $result->bindParam(':foto', $novoNome, PDO::PARAM_STR);
                      $result->execute();
                      $contar = $result->rowCount();
                      if ($contar > 0) {
                        echo '<div class="container">
                                                        <div class="alert alert-success alert-dismissible">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                        <h5><i class="icon fas fa-check"></i> OK!</h5>
                                                        Dados inseridos com sucesso !!!
                                                      </div>
                                                    </div>';
                        header("Refresh: 5, home.php");
                      } else {
                        echo '<div class="container">
                                                          <div class="alert alert-danger alert-dismissible">
                                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                          <h5><i class="icon fas fa-check"></i> Erro!</h5>
                                                          Dados não inseridos !!!
                                                        </div>
                                                      </div>';
                        header("Refresh: 5, home.php");
                      }
                    } catch (PDOException $e) {
                      echo "<strong>ERRO DE PDO= </strong>" . $e->getMessage();
                    }
                  } else {
                    echo "Erro, não foi possível fazer o upload do arquivo!";
                  }
                } else {
                  echo "Formato Inválido";
                }
              }
              ?>
            </div>
          </div>

          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Contatos Recentes</h3>
              </div>
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nome</th>
                      <th>Telefone</th>
                      <th>E-mail</th>
                      <th style="width: 40px">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $select = "SELECT * FROM tb_contatos ORDER BY id_contatos DESC LIMIT 6";
                    try {
                      $result = $conect->prepare($select);
                      $cont = 1;
                      $result->execute();
                      $contar = $result->rowCount();
                      if ($contar > 0) {
                        while ($show = $result->FETCH(PDO::FETCH_OBJ)) {
                    ?>
                          <tr>
                            <td><?php echo $cont++; ?></td>
                            <td><?php echo $show->nome_contatos; ?></td>
                            <td><?php echo $show->fone_contatos; ?></td>
                            <td><?php echo $show->email_contatos; ?></td>
                            <td>
                              <div class="btn-group">
                                <a href="home.php?acao=editar&id=<?php echo $show->id_contatos; ?>" class="btn btn-success" title="Editar Contato"><i class="fas fa-user-edit"></i></a>
                                <a href="conteudo/del-contato.php?idDel=<?php echo $show->id_contatos; ?>" onclick="return confirm('Deseja remover o contato')" class="btn btn-danger" title="Remover Contato"><i class="fas fa-user-times"></i></a>
                              </div>
                            </td>
                          </tr>
                    <?php
                        }
                      }
                    } catch (PDOException $e) {
                      echo '<strong>ERRO DE PDO= </strong>' . $e->getMessage();
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
      bsCustomFileInput.init();
    });
  </script>
</body>

</html>