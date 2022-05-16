<?php

/**************************************************************************************
 * Objetivo: Arquivo de rota, para segmentar as ações encaminhadas pela View 
 *              (dados de um form, listagem de dados, ação de excluir ou atualizar)
 *              Esse arquivo será responsável por encaminhar as solicitações para a 
 *              Controller
 * Autor: Thales Santos
 * Data: 05/04/2022
 * Versão: 1.0
 *************************************************************************************/

 $action = (string) null;
$component = (string) null;

//  Validação para verificar se a requisição é um POST ou GET de um formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET') {
    // Resgatando dados para as variáveis de ambiente - via URL 
    // Para saber quem esta solicitando e qual ação será executada
    $action = strtoupper($_GET['action']);
    $component = strtoupper($_GET['component']);

    // Estrutura condicional para validar quem esta solicitando algo para o Router
    switch ($component) {
        case 'CONTATOS':
            // Import da controller de Contatos
            require_once('controller/controllerContato.php');

            // Validações para identificar o tipo de ação que será realizada 
            if ($action == 'INSERIR') {
                // Chama a função de inserir na controller
                $resposta = inserirContato($_POST);

                // Valida o tipo de daos que a controller retornou
                if (is_bool($resposta)) {
                    // Verificando se p retorno foi verdadeiro
                    if ($resposta)
                        echo "<script>
                            alert('Registro Inserido com Sucesso!')
                            window.location.href = 'index.php#contato'
                            </script>";

                    // Se o retorno for um array significa houve erro no processo de inserção 
                } elseif (is_array($resposta)) {
                    echo "<script>
                            alert('" . $resposta['message'] . "')
                            window.history.back()
                        </script>";
                }
            }

            if ($action = 'DELETAR') {
                // Resgatando o ID do registro que deverá ser exluído.
                $idContato = $_GET['id'];

                // Chamando a função de exluir o registro na Controller
                $resposta = excluirContato($idContato);
                // Valida o tipo de dados que a controller retornou
                if (is_bool($resposta)) {
                    // Verificando se p retorno foi verdadeiro
                    if ($resposta)
                        echo "<script>
                            alert('Registro Excluido com Sucesso!')
                            window.location.href = 'cms/dashboard-contatos.php'
                         </script>";

                    // Se o retorno for um array significa houve erro no processo de inserção 
                } elseif (is_array($resposta)) {
                    echo "<script>
                            alert('" . $resposta['message'] . "')
                            window.history.back()
                        </script>";
                }
            }
            break;

        case 'CATEGORIAS':
            // Import da controller de Categorias
            require_once('controller/controllerCategoria.php');

            // Validações para identificar o tipo de ação que será realizada 
            if ($action == 'INSERIR') {
                // Chama a função de inserir na controller
                $resposta = inserirCategoria($_POST);

                // Valida o tipo de daos que a controller retornou
                if (is_bool($resposta)) {
                    // Verificando se p retorno foi verdadeiro
                    if ($resposta)
                        echo "<script>
                            alert('Registro Inserido com Sucesso!')
                            window.location.href = 'dashboard-categorias.php'
                            </script>";

                    // Se o retorno for um array significa houve erro no processo de inserção 
                } elseif (is_array($resposta)) {
                    echo "<script>
                            alert('" . $resposta['message'] . "')
                            window.history.back()
                        </script>";
                }
            } elseif ($action == 'DELETAR') {
                // Resgatando o ID do registro que deverá ser exluído.
                $idCategoria = $_GET['id'];

                // Chamando a função de exluir o registro na Controller
                $resposta = excluirCategoria($idCategoria);
                // Valida o tipo de dados que a controller retornou
                if (is_bool($resposta)) {
                    // Verificando se p retorno foi verdadeiro
                    if ($resposta)
                        echo "<script>
                            alert('Registro Excluido com Sucesso!')
                            window.location.href = 'dashboard-categorias.php'
                            </script>";

                    // Se o retorno for um array significa houve erro no processo de inserção 
                } elseif (is_array($resposta)) {
                    echo "<script>
                            alert('" . $resposta['message'] . "')
                            window.history.back()
                        </script>";
                }
            } elseif ($action == 'BUSCAR') {
                /********************
                 * Recebe o ID do registro que deverá ser editado,
                 * que foi enviado pela url no link da imagem
                 * do editar que foi acionado na dashboard-categorias.php
                 ***************************/
                $idCategoria = $_GET['id'];

                // Chama a função de buscar na Controller
                $dados = buscarCategoria($idCategoria);

                // Ativa a utilização de variáveis de SESSÃO no SERVIDOR
                session_start();

                // Guarda em uma varíavel de sessão os dados que o BD retornou para a busca do ID
                // Obs.: essa variável de sessão será utilizada na index.php, para colocar os DADOS
                // nas caixas de texto
                $_SESSION['dadosCategoria'] = $dados;

                /**
                 * Utilizando o header, o navegador abre um nova instância da 
                 * página indicada
                 * 
                 * Utilizando o header, também poderemos chamar a index.php, porém
                 * haverá uma ação de carregamento no navegador (piscando a tela)
                 * header('location: index.php')
                 */


                // Importa o arquivo de dashboard-categorias.php, renderizando-o na tela
                /**
                 * Utilizando o require, iremos apenas importar a tela da index, assim, não 
                 * havendo um novo carregamento da página
                 */
                require_once('dashboard-categorias.php');
            } elseif ($action == 'EDITAR') {
                // Recebe o ID que foi encaminhado pelo action do form pela URL
                $idCategoria = $_GET['id'];

                // Chama a função de editar na controller
                $resposta = atualizarCategoria($_POST, $idCategoria);
                // Valida o tipo de dados que a controller retornou
                if (is_bool($resposta)) {
                    // Verificando se o retorno foi verdadeiro
                    if ($resposta)
                        echo "<script>
                            alert('Registro Atualizado com Sucesso!')
                            window.location.href = 'dashboard-categorias.php'
                            </script>";

                    // Se o retorno for um array significa houve erro no processo de atualização 
                } elseif (is_array($resposta)) {
                    echo "<script>
                            alert('" . $resposta['message'] . "')
                            window.history.back()
                        </script>";
                }
            }
            break;

        case 'USUARIOS':
            // Import da controller de Usuarios
            require_once('controller/controllerUsuario.php');

            // Validações para identificar o tipo de ação que será realizada 
            if ($action == 'INSERIR') {
                // Chama a função de inserir na controller
                $resposta = inserirUsuario($_POST);

                // Valida o tipo de daos que a controller retornou
                if (is_bool($resposta)) {
                    // Verificando se p retorno foi verdadeiro
                    if ($resposta)
                        echo "<script>
                            alert('Registro Inserido com Sucesso!')
                            window.location.href = 'dashboard-usuarios.php'
                            </script>";

                    // Se o retorno for um array significa houve erro no processo de inserção 
                } elseif (is_array($resposta)) {
                    echo "<script>
                            alert('" . $resposta['message'] . "')
                            window.history.back()
                        </script>";
                }
            } elseif ($action == 'DELETAR') {
                // Resgatando o ID do registro que deverá ser exluído.
                $idUsuario = $_GET['id'];

                // Chamando a função de exluir o registro na Controller
                $resposta = excluirUsuario($idUsuario);
                // Valida o tipo de dados que a controller retornou
                if (is_bool($resposta)) {
                    // Verificando se p retorno foi verdadeiro
                    if ($resposta)
                        echo "<script>
                            alert('Registro Excluido com Sucesso!')
                            window.location.href = 'dashboard-usuarios.php'
                            </script>";

                    // Se o retorno for um array significa houve erro no processo de inserção 
                } elseif (is_array($resposta)) {
                    echo "<script>
                            alert('" . $resposta['message'] . "')
                            window.history.back()
                        </script>";
                }
            } elseif ($action == 'BUSCAR') {
                // Resgatando o ID do registro que deverá ser buscado.
                $idUsuario = $_GET['id'];

                // Chamando a função de buscar o registro na Controller
                $dados = buscarUsuario($idUsuario);

                // Ativa a utilização de variáveis de sessão no servidor
                session_start();

                // Guarda em uma varíavel de sessão os dados que o BD retornou para a busca do ID
                // Obs.: essa variável de sessão será utilizada na index.php, para colocar os DADOS
                // nas caixas de texto
                $_SESSION['dadosUsuario'] = $dados;

                // Importa o arquivo de dashboard-usuario.php, renderizando-o na tela
                /**
                 * Utilizando o require, iremos apenas importar a tela da index, assim, não 
                 * havendo um novo carregamento da página
                 */
                require_once('dashboard-usuarios.php');
                echo "
                    <script defer>
                        setTimeout(() => {
                        document.getElementById('btnModal').click()}, 1000)
                    </script>
                ";
            } elseif ($action == 'EDITAR') {
                // Recebe o ID que foi encaminhado pelo action do form pela URL
                $idUsuario = $_GET['id'];

                // Chama a função de editar na controller
                $resposta = atualizarUsuario($_POST, $idUsuario);
                // Valida o tipo de dados que a controller retornou
                if (is_bool($resposta)) {
                    // Verificando se o retorno foi verdadeiro
                    if ($resposta)
                        echo "<script>
                            alert('Registro Atualizado com Sucesso!')
                            window.location.href = 'dashboard-usuarios.php'
                            </script>";

                    // Se o retorno for um array significa houve erro no processo de atualização 
                } elseif (is_array($resposta)) {
                    echo "<script>
                            alert('" . $resposta['message'] . "')
                            window.history.back()
                        </script>";
                }
            }
            break;

        case 'PRODUTOS':
            // Import da controller de Produtos
            require_once('controller/controllerProduto.php');

            if ($action == 'INSERIR') {

                // Encapsulando $_POST e $_FILES para enviar para a controller
                $arrayDados = array(
                    "dados"     => $_POST,
                    "arquivos"  => $_FILES
                );

                $resposta = inserirProduto($arrayDados);

                // Valida o tipo de daos que a controller retornou
                if (is_bool($resposta)) {
                    // Verificando se p retorno foi verdadeiro
                    if ($resposta)
                        echo "<script>
                        alert('Registro Inserido com Sucesso!')
                        window.location.href = 'dashboard-produtos.php'
                        </script>";

                    // Se o retorno for um array significa houve erro no processo de inserção 
                } elseif (is_array($resposta)) {
                    echo "<script>
                        alert('" . $resposta['message'] . "')
                        window.history.back()
                    </script>";
                }
            }
            elseif($action == 'BUSCAR') {
                /********************
                 * Recebe o ID do registro que deverá ser editado,
                 * que foi enviado pela url no link da imagem
                 * do editar que foi acionado na dashboard-categorias.php
                 ***************************/
                $idProduto = $_GET['id'];

                // Chama a função de buscar na Controller
                $dados = buscarProduto($idProduto);

                // Ativa a utilização de variáveis de SESSÃO no SERVIDOR
                session_start();

                // Guarda em uma varíavel de sessão os dados que o BD retornou para a busca do ID
                // Obs.: essa variável de sessão será utilizada na index.php, para colocar os DADOS
                // nas caixas de texto
                $_SESSION['dadosProduto'] = $dados;

                /**
                 * Utilizando o header, o navegador abre um nova instância da 
                 * página indicada
                 * 
                 * Utilizando o header, também poderemos chamar a index.php, porém
                 * haverá uma ação de carregamento no navegador (piscando a tela)
                 * header('location: index.php')
                 */


                // Importa o arquivo de dashboard-categorias.php, renderizando-o na tela
                /**
                 * Utilizando o require, iremos apenas importar a tela da index, assim, não 
                 * havendo um novo carregamento da página
                 */
                require_once('dashboard-produtos.php');
            }
            elseif($action == 'EDITAR') {
                // Recebendo o ID do registro e Nome da foto principal
                $arrayDados = array(
                    'id'            => $_GET['id'],
                    'dados'         => $_POST,
                    'arquivos'      => $_FILES,
                    'fotoPrincipal' => $_GET['fotoPrincipal']
                );

                $resposta = atualizaProduto($arrayDados);

                // Valida o tipo de daos que a controller retornou
                if(is_bool($resposta)){
                    // Verificando se o retorno foi verdadeiro
                    if($resposta)
                    echo "<script>
                            alert('Registro Atualizado com Sucesso!')
                            window.location.href = 'dashboard-produtos.php'
                        </script>";
                
                // Se o retorno for um array significa houve erro no processo de inserção 
                } elseif(is_array($resposta)){
                    echo "<script>
                            alert('".$resposta['message']."')
                            window.history.back()
                        </script>";
                }

            }
            elseif($action == 'DELETAR') {
                // Recebendo id do produto e nome da foto 
                $arrayDados = array(
                    'id' => $_GET['id'],
                    'idFotoPrincipal' => $_GET['idFotoPrincipal']
                );

                // Chama a função de excluir da controller
                $resposta = excluirProduto($arrayDados);

                // Valida o tipo de daos que a controller retornou
                if(is_bool($resposta)){
                    // Verificando se o retorno foi verdadeiro
                    if($resposta)
                    echo "<script>
                            alert('Registro Excluido com Sucesso!')
                            window.location.href = 'dashboard-produtos.php'
                         </script>";
                  
                // Se o retorno for um array significa houve erro no processo de inserção 
                } elseif(is_array($resposta)){
                    echo "<script>
                            alert('".$resposta['message']."')
                            window.history.back()
                        </script>";
                }

            }

            // Imagens laterais
            elseif($action == 'DELETAR-IMAGEM'){
                echo 'teste';
            }
            break;
        default:
            break;
    }
}
