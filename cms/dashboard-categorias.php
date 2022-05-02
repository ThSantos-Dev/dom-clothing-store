<?php
    $form = 'router.php?component=categorias&action=inserir';


    // Valida se a utilização de variáveis de sessão esta ativa no servidor
    if (session_status()) {
        // Valida se a variável de sessão dadosContato NÃO esta vazia
        if (!empty($_SESSION['dadosCategoria'])) {
            $id          = $_SESSION['dadosCategoria']['id'];
            $nome        = $_SESSION['dadosCategoria']['nome'];

            // Mudamos a ação do form para editar o registro no click do botão salvar
            $form = 'router.php?component=categorias&action=editar&id=' . $id;

            // Destrói uma variável da memória do servidor
            unset($_SESSION['dadosContato']);
        }
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CMS - DOM</title>

    <!-- Importação de font externa GoogleFonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/dashboard-categorias.css">

</head>

<body id="categorias">
<?php
    require_once('components/header.html');
  ?>

    <!-- Content Area -->
    <section class="content container">
        <h1 class="section-title">categorias</h1>

        <!-- Content -->
        <div class="catergoria-content">
            <!-- Add category Container -->
            <div class="categoria-form-add">
                <form action="<?= $form?>" method="post">
                    <label for="txtCategoria">Categoria:</label>
                    <input type="text" name="txtCategoria" id="txtCategoria" placeholder="Insira uma nova categoria..." value="<?= !empty($nome) ? $nome : null?>">
                    <input type="submit" name="btnEnviar" value="+" title="Adicionar">
                </form>
            </div>
            <!-- // Add category Conbtainer -->

            <!-- List Category Container -->
                <table class="categoria-table">
                    <thead>
                        <th>Nome</th>
                        <th>Opções</th>
                    </thead>
                    <tbody>
                        <?php
                            // Import do arquivo da controller para solicitar a listagem de dados
                            require_once('controller/controllerCategoria.php');

                            // Chama a função que vai retornar os dados de categoria
                            if($listCategorias = listaCategorias()){
                                // Estrutura de repetição para retornar os dados do array e printar na tela
                                foreach($listCategorias as $item){
                        ?>

                        <tr>
                            <td class="categoria-nome"><?= $item['nome']?></td>
                            <td class="acoes">
                                <a onclick="return confirm('Deseja realmente excluir o contato: <?= $item['nome'] ?>')" href="router.php?component=categorias&action=deletar&id=<?= $item['id'] ?>">
                                    <i class="fa-solid fa-trash-can" title="Excluir"></i>
                                </a>

                                <a href="router.php?component=categorias&action=buscar&id=<?= $item['id'] ?>">
                                    <i class="fa-solid fa-pen-to-square" title="Editar"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                                }
                            }                        
                        ?>
                    </tbody>
                </table>
            <!-- // List Category Container -->
        </div>
        <!-- // Content -->
    </section>
    <!-- // Content Area -->

    <!-- Footer -->
    <footer>
        <div class="footer-content container">
            <!-- Content align center -->
            <div class="footer-content-center">
                <span>&copy;Copyright 2022</span>
                <span>Todos os direitos reservados - <a href="">Política de Privacidade</a></span>
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