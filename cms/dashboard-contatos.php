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
    <link rel="stylesheet" type="text/css" href="css/dashboard-contatos.css">

</head>

<body>
<?php
    require_once('components/header.html');
  ?>

    <!-- Content Area -->
    <section class="content container">
        <!-- <h1 class="section-title">Adiministração de Produtos</h1> -->
        <h1 class="section-title">Contatos</h1>


        <!-- Table contact -->
        <table>
            <thead>
                <th>Nome</th>
                <th>Telefone</th>
                <th colspan="2">E-mail</th>
                <th>Opções</th>
            </thead>

            <tbody>
                <?php
                // Import do arquivo da controller para solicitar a listagem dos dados
                require_once('controller/controllerContato.php');

                // Chama a função que vai retornar os dados de contato
                if ($listContato = listaContatos()) {

                    // Estrutura de repetição para retornar os dados do array e printar na tela
                    foreach ($listContato as $item) {
                ?>
                        <tr>
                            <td><?= $item['nome'] ?></td>
                            <td><?= $item['telefone'] ?></td>
                            <td><?= $item['email'] ?></td>
                            <td>
                                <i class="fa-solid fa-envelope <?= $item['atualizacoes_email'] == 1 ? 'green' : 'red' ?>"></i>
                            </td>
                            <td class="acoes">
                                <a onclick="return confirm('Deseja realmente excluir o contato: <?= $item['nome'] ?>')" href="../router.php?component=contatos&action=deletar&id=<?= $item['id'] ?>">
                                    <i class="fa-solid fa-trash-can" title="Excluir"></i>
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
        <!-- // Table contact -->
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