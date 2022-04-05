<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DOM - Desvende o Mundo!</title>
    <link
      rel="icon"
      href="./assets/img/icons/logo-icon.png"
      sizes="60x60"
      type="image/x-icon"
    />

    <!-- Importação de font externa GoogleFonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
      rel="stylesheet"
    />
    <!-- // Importação de font externa GoogleFonts -->

    <!-- Imports CSS and JS -->
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/modal.css" />

    <script src="js/db.js" type="module" defer></script>
    <script src="js/filter.js" defer></script>
    <script src="js/carousel-product.js" type="module" defer></script>
    <script src="js/modal.js" type="module" defer></script>
    <script src="js/slider.js" defer></script>
    <script src="js/main.js" defer></script>
  </head>
  <body>
    <!-- Cabeçalho -->
    <header class="active">
      <div class="header container">
        <!-- Logo -->
        <a href="index.html" class="logo">
          <img src="./assets/img/icons/logo 1.png" alt="logo" />
        </a>
        <!-- // Logo -->

        <!-- Navegação -->
        <nav>
          <a href="#promocoes" class="nav-item">promoções</a>
          <a href="#destaques" class="nav-item">destaques</a>
          <a href="#moda" class="nav-item">moda</a>
          <a href="#sobre" class="nav-item">sobre</a>
          <a href="#contato" class="nav-item">contato</a>
        </nav>
        <!-- // Navegação -->

        <!-- Line -->
        <div class="line">
          <img src="./assets/img/icons/line-header.png" alt="|" />
        </div>
        <!-- // Line -->

        <!-- Pesquisa -->
        <div class="header-pesquisa">
          <input type="text" name="" id="" />

          <div class="pesquisa-icon">
            <img src="./assets/img/icons/search 1.png" alt="search" />
          </div>
        </div>
        <!-- // Pesquisa -->

        <!-- Área de usuário -->
        <div class="header-usuario-sacola-container">
          <!-- Usuário -->
          <div class="usuario">
            <div>
              <img src="./assets/img/icons/user 1.png" alt="user-icon" />
            </div>
            <a href="#">Entrar</a>
          </div>
          <!-- // Usuário -->

          <!-- Sacola de Compras -->
          <div class="sacola-de-compras">
            <img src="./assets/img/icons/bag-shop 1.png" alt="bag-shop-icon" />
          </div>
          <!-- // Sacola de Compras -->
        </div>
        <!-- Área de usuário -->
      </div>
    </header>
    <!-- // Cabeçalho -->

    <div id="spacing-body"></div>

    <!-- Slider -->
    <section class="container-slider container">
      <!-- Controls Arrows -->
      <div class="arrow-container previus" id="slider-controls-previus">
        <img src="./assets/img/icons/arrow-1-left.png" alt="" />
      </div>

      <div class="arrow-container next" id="slider-controls-next">
        <img src="./assets/img/icons/arrow-1-right.png" alt="" />
      </div>
      <!-- // Controls Arrows -->

      <!-- Slides Container -->
      <div id="slides-container"></div>
      <!-- // Slides Container -->

      <!-- Controls Balls -->
      <div class="controls-balls container"></div>
      <!-- // Controls Balls -->
    </section>
    <!-- // Slider -->

    <!-- Destaques -->
    <section class="container-destaques container" id="destaques">
      <!-- Section Title -->
      <div class="section-title">
        <h1>Destaques</h1>
      </div>
      <!-- Section Title -->

      <!-- Carousel Cards Container -->
      <div class="carousel-cards-container">
        <!-- Controls Arrows -->
        <!-- <div class="controls-arrows" id=""> -->
        <div
          class="arrow-container previus"
          id="destaques-carousel-cards-controls-previus"
        >
          <img src="./assets/img/icons/arrow-2-left.png" alt="" />
        </div>
        <div
          class="arrow-container next"
          id="destaques-carousel-cards-controls-next"
        >
          <img src="./assets/img/icons/arrow-2-right.png" alt="" />
        </div>
        <!-- </div> -->
        <!-- // Controls Arrows -->

        <!-- Cards -->
        <div class="cards" id="destaques-carousel-cards-container"></div>
        <!-- // Cards -->
      </div>
      <!-- // Carousel Cards Container -->
    </section>
    <!-- // Destaques -->

    <!-- Promoções -->
    <section class="container-promocoes container" id="promocoes">
      <!-- Section Title -->
      <div class="section-title">
        <h1>promoções</h1>
      </div>
      <!-- Section Title -->

      <!-- Carousel Cards Container -->
      <div class="carousel-cards-container">
        <!-- Controls Arrows -->
        <!-- <div class="controls-arrows" id=""> -->
        <div
          class="arrow-container previus"
          id="promocoes-carousel-cards-controls-previus"
        >
          <img src="./assets/img/icons/arrow-2-left.png" alt="" />
        </div>
        <div
          class="arrow-container next"
          id="promocoes-carousel-cards-controls-next"
        >
          <img src="./assets/img/icons/arrow-2-right.png" alt="" />
        </div>
        <!-- </div> -->
        <!-- // Controls Arrows -->

        <!-- Cards -->
        <div class="cards" id="promocoes-carousel-cards-container"></div>
        <!-- // Cards -->
      </div>
      <!-- // Carousel Cards Container -->
    </section>
    <!-- // Promções -->

    <!-- Moda -->
    <section class="container-moda container" id="moda">
      <!-- Section Title -->
      <div class="section-title">
        <h1>moda</h1>
      </div>
      <!-- Section Title -->

      <!-- Container Conteudo -->
      <div class="container-moda-conteudo">
        <!-- Filtros -->
        <div class="container-moda-filtros">
          <!-- Filtros Selecionados -->
          <div class="container-moda-filtros-selecionados">
            <h2 id="quantidade-filtros">Filtros</h2>

            <div class="container-moda-filtros-selecionados-filtros">
              
            </div>

            <div class="container-limpar-filtros">
              <span id="limpar-filtros">Limpar todos</span>
            </div>
          </div>
          <!-- // Filtros Selecionados -->

          <!-- Gênero -->
          <div class="container-moda-filtros-container">
            <!-- Filtros header -->
            <div class="filtros-header">
              <span>gênero</span>
              <div id="filtro-bar-genero">
                <img src="./assets/img/icons/bar.png" alt="" />
              </div>
            </div>
            <!-- // Filtros header -->

            <!-- Container de Filtros -->
            <div class="container-filtros-conteudo">
              <!-- Filtro -->
              <div class="filtro-chk">
                <input type="checkbox" name="chkMaculino" id="chkMaculino" value="Masculino"/>
                <label for="chkMaculino">Masculino</label>
              </div>
              <!-- // Filtro -->

              <!-- Filtro -->
              <div class="filtro-chk">
                <input type="checkbox" name="chkFeminino" id="chkFeminino" value="Feminino"/>
                <label for="chkFeminino">Feminino</label>
              </div>
              <!-- // Filtro -->
            </div>
            <!-- Container de Filtros -->
          </div>
          <!-- // Gênero -->

          <!-- Tipo de Produto -->
          <div class="container-moda-filtros-container">
            <!-- Filtros header -->
            <div class="filtros-header">
              <span>Tipo de produto</span>
              <div id="filtro-bar-tipo-de-porduto">
                <img src="./assets/img/icons/bar.png" alt="" />
              </div>
            </div>
            <!-- // Filtros header -->

            <!-- Pesquisa -->
            <div class="filtro-tipo-produto-pesquisa">
              <input type="text" placeholder="pesquisar..." />
              <img src="assets/img/icons/search 1.png" alt="" />
            </div>
            <!-- // Pesquisa -->

            <!-- Container de Filtros -->
            <div class="container-filtros-conteudo">
              <!-- Filtro -->
              <div class="filtro-chk">
                <input type="checkbox" value="Blusas" name="chkBlusas" id="chkBlusas" />
                <label for="chkBlusas">Blusas</label>
              </div>
              <!-- // Filtro -->
              <!-- Filtro -->
              <div class="filtro-chk">
                <input type="checkbox" value="Camisetas" name="chkCamisetas" id="chkCamisetas" />
                <label for="chkCamisetas">Camisetas</label>
              </div>
              <!-- // Filtro -->
              <!-- Filtro -->
              <div class="filtro-chk">
                <input type="checkbox" value="Bermudas" name="chkBermudas" id="chkBermudas" />
                <label for="chkBermudas">Bermudas</label>
              </div>
              <!-- // Filtro -->
              <!-- Filtro -->
              <div class="filtro-chk">
                <input type="checkbox" value="Calças" name="chkCalcas" id="" />
                <label for="chkCalcas">Calças</label>
              </div>
              <!-- // Filtro -->
            </div>
            <!-- // Container de Filtros -->
          </div>
          <!-- // Tipo de Produto -->
        </div>
        <!-- // Filtros -->

        <!-- Produtos -->
        <div class="container-moda-produtos" id="container-moda-produtos"></div>
        <!-- // Produtos -->
      </div>
      <!-- // Container Conteudo -->
    </section>
    <!-- // Moda -->
    <hr />

    <!-- Sobre -->
    <section class="container-sobre container" id="sobre">
      <!-- Section Title -->
      <div class="section-title">
        <h1>Sobre</h1>
      </div>
      <!-- Section Title -->

      <!-- Paragrafos -->
      <div class="sobre-container-paragrafos">
        <p>
          Somos a DOM, a loja on-line de moda do SENAI. A gente acredita que
          pequenos gestos podem te levar aonde você sempre quis. Um olhar, um
          sim, aquele seu look no momento certo. Sabemos também que, muitas
          vezes, as opiniões dos outros te impedem de ser você. Por isso, nosso
          propósito é te inspirar e te ajudar a tomar aquela pequena atitude que
          muda o seu dia.
        </p>
        <p>
          Somos democráticos, oferecemos milhares de marcas e produtos para
          vestuários Tudo com a rapidez, confiança, poder de inovação e
          qualidade de serviço que você já conhece da Netshoes.
        </p>
      </div>
      <!-- // Paragrafos -->

      <!-- Missão, Visão e Valores -->
      <div class="sobre-container-missao-visao-valores">
        <div class="sobre-moldura">
          <h2>Missão</h2>

          <p>Conectar as pessoas a uma vida com mais estilo e simplicidade.</p>
        </div>
        <div class="sobre-moldura">
          <h2>visão</h2>

          <p>Ser referência global em experiência de compra on-line.</p>
        </div>
        <div class="sobre-moldura">
          <h2>Valores</h2>

          <ul>
            <li>Paixão</li>
            <li>inovação</li>
            <li>sem limites</li>
            <li>foco no resultado</li>
            <li>olhar de dono</li>
            <li>valorização das pessoas</li>
            <li>agilidade</li>
            <li>simplicidade</li>
          </ul>
        </div>
      </div>
      <!-- Missão, Visão e Valores -->
    </section>
    <!-- // Sobre -->

    <!-- Contato -->
    <section class="container-contato container" id="contato">
      <!-- Section Title -->
      <div class="section-title">
        <h1>contato</h1>
      </div>
      <!-- // Section Title -->

      <!-- Texto -->
      <div class="contato-texto">
        <span> Nos conte suas dúvidas, sugestões e também os elogios! 😉 </span>
      </div>
      <!-- // Texto -->

      <!-- Formulario -->
      <div class="contato-formulario-container">
        <form action="router.php?component=contatos&action=inserir" name="frmCadastro" method="post">
          <!-- Nome -->
          <div class="contato-formulario-input">
            <label for="txtNome">Nome:</label>
            <input
              type="text"
              name="txtNome"
              placeholder="Maria da Silva"
              required
            />
          </div>
          <!-- // Nome -->

          <!-- Email -->
          <div class="contato-formulario-input">
            <label for="txtEmail">E-mail:</label>
            <input
              type="email"
              name="txtEmail"
              placeholder="mariadasilva@email.com"
              required
            />
          </div>
          <!-- // Email -->

          <!-- Telefone -->
          <div class="contato-formulario-input">
            <label for="txtTelefone">Telefone:</label>
            <input
              type="text"
              name="txtTelefone"
              placeholder="(11) 99999-9999"
              required
            />
          </div>
          <!-- // Telefone -->

          <!-- TextArea - Mensagem -->
          <div class="contato-formulario-textarea">
            <label for="txtMensagem">Mensagem:</label>
            <textarea name="txtMensagem" id="" required></textarea>
          </div>
          <!-- TextArea - Mensagem -->

          <!-- Botões -->
          <div class="contato-formulario-botoes-container">
            <div class="contato-formulario-botao">
              <input type="checkbox" name="txtAtualizacoes" id="" />
              <label for="txtAtualizacoes"
                >Desejo receber atualizações por e-mail.</label
              >
            </div>

            <div class="contato-formulario-botao">
              <input type="submit" value="Enviar" id="btnEnviar" />
            </div>
          </div>
          <!-- // Botões -->
        </form>
      </div>
      <!-- // Formulario -->
    </section>
    <!-- // Contato -->

    <footer>
      <div class="footer container">
        <div class="footer-conteudo-container">
          <!-- Empresa -->
          <div class="footer-conteudo">
            <div class="footer-conteudo-titulo">
              <h3>DOM SA INTERNET</h3>
            </div>

            <p>CNPJ 00.000.000/00</p>
            <p>rua das flores, 573 - centro - 000-000 - jandira - são paulo</p>
          </div>
          <!-- // Empresa -->

          <!-- Central de relacionamento -->
          <div class="footer-conteudo">
            <div class="footer-conteudo-titulo">
              <h3>Central de relacionamento:</h3>
            </div>

            <div class="footer-conteudo-contatos">
              <div class="footer-contato">
                <h3>Televendas</h3>

                <span>(11)4444-4444</span>
                <span>(11)4444-4444</span>
              </div>

              <div class="footer-contato">
                <h3>SAC</h3>

                <span>(11)4444-4444</span>
                <span>(11)4444-4444</span>
              </div>
            </div>
          </div>
          <!-- // Central de relacionamento -->

          <!-- Redes sociais -->
          <div class="footer-conteudo">
            <div class="footer-conteudo-titulo">
              <h3>Redes sociais</h3>
            </div>

            <div class="footer-conteudo-icone-rede-social">
              <img src="./assets/img/icons/facebook-icon.png" alt="">
              <img src="assets/img/icons/instagram.png" alt="">
              <img src="assets/img/icons/linkedin.png" alt="">
              <img src="assets/img/icons/youtube.png" alt="">
            </div>
          </div>
          <!-- // Redes sociais -->
        </div>

        <div class="footer-descricao-container">
          <p>
            O site possui finalidade extritamente didática, sendo proibida toda
            e qualquer manipulação de imagens e seus valores. Todos os direitos
            autorais são reservados.
          </p>
          <p>&copy;Thales Santos - 2022</p>
          <p>Projeto para avalição das disciplinas PWFE e PWBE.</p>
        </div>
      </div>
    </footer>
  </body>
</html>
