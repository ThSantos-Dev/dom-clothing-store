<?php

// Alteração dinamica da url para que o mesmo form possa atualizar um dado
$form = 'router.php?component=usuarios&action=inserir';

// Valida se a utilização de variáveis de sessão esta ativa no servidor
if (session_status()) {
  // Valida se a variavel de sessao dadosUsuario não esta vazia
  if (!empty($_SESSION['dadosUsuario'])) {

    $id = $_SESSION['dadosUsuario']['id'];
    $nome = $_SESSION['dadosUsuario']['nome'];
    $telefone = $_SESSION['dadosUsuario']['telefone'];
    $email = $_SESSION['dadosUsuario']['email'];
    $data_nascimento = $_SESSION['dadosUsuario']['data_nascimento'];
    $sexo = $_SESSION['dadosUsuario']['sexo'];

    $form = 'router.php?component=usuarios&action=editar&id=' . $id;

    // Destrói uma variável de sessão da memoria do servidor
    unset($_SESSION['dadosUsuario']);
  }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CMS - DOM</title>

  <!-- Importação de font externa GoogleFonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="stylesheet" type="text/css" href="css/dashboard-usuarios.css" />
  <link rel="stylesheet" type="text/css" href="css/dashboard-contatos.css" />

  <!-- JS Imports -->
  <script src="js/usuarios/main.js" defer type="module"></script>
</head>

<body>
  <?php
    require_once('components/header.html');
  ?>

  <!-- Content Area -->
  <section class="content container">
    <div class="container-title-button">
      <h1 class="section-title">Usuários</h1>

      <div class="button-modal" id="btnModal">
        <span>Novo usuário</span><i class="fa-solid fa-plus"></i>
      </div>
    </div>

    <div class="form-container" id="formCadastroUsuario">
      <!-- Form  -->
      <form action="<?= $form ?>" method="post">
        <h2>Informações do Usuário</h2>

        <div class="form-group-row">
          <!-- Name -->
          <div class="form-group">
            <label for="txtNome">Nome completo:</label>
            <input type="text" required name="txtNome" placeholder="Digite seu nome completo..." value="<?= isset($nome) ? $nome : null  ?>" />
          </div>
          <!-- // Name -->

          <!-- Sexo -->
          <div class="form-group sexo">
            <span>Sexo:</span>

            <div class="input-sexo">
              <label><input type="radio" name="rdoSexo" value="M" <?= !isset($sexo) ||  strcmp($sexo, 'M') ? 'checked' : null ?>/>Masculino</label>
              <label><input type="radio" name="rdoSexo" value="F" <?= isset($sexo) && strcmp($sexo, 'F') ? 'checked' : null ?>/>Feminino</label>
            </div>
          </div>
          <!-- // Sexo -->
        </div>

        <!-- Email -->
        <div class="form-group">
          <label for="txtEmail">E-mail:</label>
          <input type="email" required name="txtEmail" placeholder="Digite seu e-mail..." value="<?= isset($email) ? $email : null  ?>" />
        </div>
        <!-- // Email -->

        <div class="form-group-row">
          <!-- Phone -->
          <div class="form-group">
            <label for="txtTelefone">Telefone:</label>
            <input type="text" name="txtTelefone" placeholder="(00) 99999-9999" value="<?= isset($telefone) ? $telefone : null  ?>" />
          </div>
          <!-- // Phone -->

          <!-- Phone -->
          <div class="form-group">
            <label for="dateNascimento">Data de nascimento:</label>
            <input type="date" name="dateNascimento" value="<?= isset($data_nascimento) ? $data_nascimento : null  ?>" />
          </div>
          <!-- // Phone -->
        </div>

        <!-- Password -->
        <div class="form-group-row">
          <div class="form-group">
            <label for="txtSenha">Senha:</label>
            <input type="password" name="txtSenha" placeholder="Insira uma senha..." required value="" />
          </div>

          <div class="form-group">
            <label for="txtConfirmarSenha">Confirme sua senha:</label>
            <input type="password" name="txtConfirmarSenha" placeholder="Confirme sua senha..." required value="" />
          </div>
        </div>
        <!-- // Password -->

        <div class="form-group-button">
          <button type="submit" value="cancelar" id="btnCancelar">cancelar</button>
          <button type="submit" value="salvar">salvar</button>
        </div>
      </form>
      <!-- // Form  -->
    </div>

    <div class="list-users">
      <h2>Lista de usuários</h2>

      <!-- Table Users -->
      <table>
        <thead>
          <th>Nome</th>
          <th>Telefone</th>
          <th>E-mail</th>
          <th>Opções</th>
        </thead>

        <tbody id="clientsInfo">
          <?php
          // Import do arquivo da controller para solicitar a listagem dos dados
          require_once('controller/controllerUsuario.php');

          // Chama a função que vai retornar os dados de contato
          if ($listContato = listaUsuarios()) {

            // Estrutura de repetição para retornar os dados do array e printar na tela
            foreach ($listContato as $item) {
          ?>
              <tr>
                <td><?= $item['nome'] ?></td>
                <td><?= $item['telefone'] ?></td>
                <td><?= $item['email'] ?></td>
                <td class="acoes">
                  <a onclick="return confirm('Deseja realmente excluir o contato: <?= $item['nome'] ?>')" href="router.php?component=usuarios&action=deletar&id=<?= $item['id'] ?>">
                    <i class="fa-solid fa-trash-can" title="Excluir"></i>
                  </a>
                  <a href="router.php?component=usuarios&action=buscar&id=<?= $item['id'] ?>" id="editar-<?= $item['id']?>">
                    <i class="fa-solid fa-pen-to-square" title="Editar"></i>
                  </a>
                  <i class="fa-solid fa-eye" title="Visualizar"></i>
                </td>
              </tr>
          <?php
            }
          }
          ?>
        </tbody>
      </table>
      <!-- // Table Users -->
    </div>

  </section>
  <!-- // Content Area -->

  <!-- Footer -->
  <footer>
    <div class="footer-content container">
      <!-- Content align center -->
      <div class="footer-content-center">
        <span>&copy;Copyright 2022</span>
        <span>Todos os direitos reservados -
          <a href="">Política de Privacidade</a></span>
      </div>
      <!-- // Content align center -->

      <!-- Content align right -->
      <div class="footer-content-right">
        <span>Desenvolvido por Thales Santos</span>
        <span>versão 1.0.0</span>
      </div>
      <!-- // Content align right -->
    </div>
  </footer>
  <!-- Footer -->
</body>

</html>