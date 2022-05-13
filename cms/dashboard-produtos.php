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
  <link rel="stylesheet" type="text/css" href="css/dashboard-produtos.css" />
  <link rel="stylesheet" type="text/css" href="css/dashboard-contatos.css" />

  <!-- Scripts -->
  <script src="js/produtos/main.js" defer type="module"></script>
</head>

<body>
  <?php
  require_once('components/header.html');
  ?>

  <!-- Content Area -->
  <section class="content container">
    <div class="container-title-button">
      <h1 class="section-title">Produtos</h1>

      <div class="button-modal" id="btnModal">
        <span>Adicionar produto</span><i class="fa-solid fa-plus"></i>
      </div>
    </div>

    <!-- Modal -->
    <div id="modal-container">
      <!-- Form -->
      <form action="router.php?component=produtos&action=inserir" method="post" enctype="multipart/form-data">
        <i class="fa-solid fa-xmark" id="closeModal" title="Fechar"></i>

        <!-- Images Preview -->
        <div class="modal-images-preview">
          <div class="modal-images-lateral">
            <div class="modal-images">
              <label class="file-upload">
                <input type="file" name="fileFoto1" accept="image/*" id="fileFoto1" />
                <img src="assets/img/icon/upload-image.png" alt="" id="previewFoto1" />
              </label>
            </div>
            <div class="modal-images">
              <label class="file-upload">
                <input type="file" name="fileFoto2" accept="image/*" id="fileFoto2" />
                <img src="assets/img/icon/upload-image.png" alt="" id="previewFoto2" />
              </label>
            </div>
            <div class="modal-images">
              <label class="file-upload">
                <input type="file" name="fileFoto3" accept="image/*" id="fileFoto3" />
                <img src="assets/img/icon/upload-image.png" alt="" id="previewFoto3" />
              </label>
            </div>
            <div class="modal-images">
              <label class="file-upload">
                <input type="file" name="fileFoto4" accept="image/*" id="fileFoto4" />
                <img src="assets/img/icon/upload-image.png" alt="" id="previewFoto4" />
              </label>
            </div>
          </div>

          <div class="modal-image-main">
            <div class="modal-images">
              <label class="file-upload">
                <input type="file" name="fileFotoMain" accept="image/*" id="fileFotoMain" />
                <img src="assets/img/icon/upload-image.png" alt="" id="previewFotoMain" />
              </label>
            </div>
          </div>
        </div>
        <!-- // Images Preview-->

        <!-- Data -->
        <div class="modal-inputs">
          <h3>Dados do Produto:</h3>

          <div class="form-group">
            <label for="txtTitulo">Título:</label>
            <input type="text" required name="txtTitulo" placeholder="Digite seu nome completo..." value="" />
          </div>

          <div class="form-group-row">
            <div class="form-group">
              <label for="txtPreco">Preço:</label>
              <input type="number" name="txtPreco" id="" placeholder="R$ 79,90" />
            </div>
            <div class="form-group">
              <label for="txtDesconto">Desconto (%):</label>
              <input type="number" max="100" name="txtDesconto" id="" placeholder="10%" />
            </div>
          </div>

          <div class="form-group-row">
            <div class="form-group">
              <label for="sltCategoria">Categoria:</label>
              <select name="sltCategoria" id="">
                <option value="" selected>selecione uma categoria</option>
                <option value="a">a</option>
                <option value="b">b</option>
              </select>
            </div>

            <div class="form-group">
              <label for="">Quantidade:</label>
              <input type="number" name="txtQuantidade" id="" placeholder="27 unidades" />
            </div>
          </div>

          <div class="form-group-row">
            <div class="form-group radios">
              <h3>Produto em destaque?</h3>
  
              <div class="form-group-row radios">
                <div class="form-group radio">
                  <input type="radio" name="rdoDestaque" value="1" id="rdoDestaqueSim" checked>
                  <label for="rdoDestaqueSim">Sim</label>
                </div>
                <div class="form-group radio">
                  <input type="radio" name="rdoDestaque" value="0" id="rdoDestaqueNao">
                  <label for="rdoDestaqueNao">Não</label>
                </div>
              </div>
            </div>
  
            <div class="form-group file-upload">
              <div class="form-group">
                <label>upload imagem principal
                  <input type="file" accept="image/*" name="" id="singleImage" />
                </label>
              </div>
  
              <div class="form-group">
                <label>upload imagens laterais
                  <input type="file" multiple="multiple" accept="image/*" name="fileImages[]" id="multipleImages" />
                </label>
              </div>
            </div>
          </div>

          <!-- Button -->
          <div class="form-group-button">
            <button value="cancelar" id="btnCancelar">cancelar</button>
            <button type="submit" value="salvar">salvar</button>
          </div>
          <!-- // Button -->
        </div>
        <!-- // Data -->
      </form>
      <!-- // Form -->
    </div>
    <!-- // Modal -->

    <!-- Table products -->
    <table>
      <thead>
        <th class="preview">Preview</th>
        <th>Nome</th>
        <th class="categorias">Categoria</th>
        <th>Preço</th>
        <th>Opções</th>
      </thead>

      <tbody>

        <?php
        // Import da função que retorna todos os produtos
        require_once('controller/controllerProduto.php');

        $listProdutos = listaProdutos();

        if (count($listProdutos) > 0) {
          foreach ($listProdutos as $item) {

        ?>
            <tr>
              <td>
                <img src="uploads/<?= $item['fotoPrincipal'] ?>" />
              </td>
              <td><?= $item['titulo'] ?></td>
              <td>alguma ai</td>
              <td>
                <div class="preco">
                  <span>R$ <?= $item['preco'] ?></span>

                  <div class="status">
                    <i class="fa-solid fa-tag <?= $item['desconto'] > 0 ? 'green' : 'red' ?>" title="Produto com desconto."></i>
                    <i class="fa-solid fa-award <?= $item['destaque'] ? 'green' : 'red' ?>" title="Produto em destaque."></i>
                  </div>
                </div>
              </td>
              <td class="acoes">
                <a onclick="return confirm('Deseja realmente excluir o produto: <?= $item['titulo'] ?>')" href="router.php?component=produtos&action=deletar&id=<?= $item['id'] ?>">
                  <i class="fa-solid fa-trash-can" title="Excluir"></i>
                </a>
                <a href="router.php?component=produtos&action=buscar&id=<?= $item['id'] ?>" id="editar-<?= $item['id'] ?>">
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
    <!-- // Table products -->
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