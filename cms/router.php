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
if($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET') {
    // Resgatando dados para as variáveis de ambiente - via URL 
    // Para saber quem esta solicitando e qual ação será executada
    $action = strtoupper($_GET['action']);
    $component = strtoupper($_GET['component']);

    // Estrutura condicional para validar quem esta solicitando algo para o Router
    switch($component) {
        case 'CONTATOS':
            // Import da controller de Contatos
            require_once('controller/controllerContato.php');

            // Validações para identificar o tipo de ação que será realizada 
            if($action == 'INSERIR'){
                // Chama a função de inserir na controller
                $resposta = inserirContato($_POST);

                // Valida o tipo de daos que a controller retornou
                if(is_bool($resposta)){
                    // Verificando se p retorno foi verdadeiro
                    if($resposta)
                    echo "<script>
                            alert('Registro Inserido com Sucesso!')
                            window.location.href = 'index.php#contato'
                            </script>";
                    
                // Se o retorno for um array significa houve erro no processo de inserção 
                } elseif(is_array($resposta)){
                    echo "<script>
                            alert('".$resposta['message']."')
                            window.history.back()
                        </script>";
                }
            }

            if($action = 'DELETAR') {
                // Resgatando o ID do registro que deverá ser exluído.
                $idContato = $_GET['id'];

                // Chamando a função de exluir o registro na Controller
                $resposta = excluirContato($idContato);
                 // Valida o tipo de dados que a controller retornou
                 if(is_bool($resposta)){
                    // Verificando se p retorno foi verdadeiro
                    if($resposta)
                    echo "<script>
                            alert('Registro Excluido com Sucesso!')
                            window.location.href = 'cms/dashboard-contatos.php'
                         </script>";
                  
                // Se o retorno for um array significa houve erro no processo de inserção 
                } elseif(is_array($resposta)){
                    echo "<script>
                            alert('".$resposta['message']."')
                            window.history.back()
                        </script>";
                }
            }
            break;

        case 'CATEGORIAS':
            // Import da controller de Categorias
            require_once('controller/controllerCategoria.php');

            // Validações para identificar o tipo de ação que será realizada 
            if($action == 'INSERIR'){
                // Chama a função de inserir na controller
                $resposta = inserirCategoria($_POST);

                // Valida o tipo de daos que a controller retornou
                if(is_bool($resposta)){
                    // Verificando se p retorno foi verdadeiro
                    if($resposta)
                    echo "<script>
                            alert('Registro Inserido com Sucesso!')
                            window.location.href = 'dashboard-categorias.php'
                            </script>";
                    
                // Se o retorno for um array significa houve erro no processo de inserção 
                } elseif(is_array($resposta)){
                    echo "<script>
                            alert('".$resposta['message']."')
                            window.history.back()
                        </script>";
                }
            }

            elseif($action == 'DELETAR'){
                // Resgatando o ID do registro que deverá ser exluído.
                $idCategoria = $_GET['id'];

                // Chamando a função de exluir o registro na Controller
                $resposta = excluirCategoria($idCategoria);
                    // Valida o tipo de dados que a controller retornou
                    if(is_bool($resposta)){
                    // Verificando se p retorno foi verdadeiro
                    if($resposta)
                    echo "<script>
                            alert('Registro Excluido com Sucesso!')
                            window.location.href = 'dashboard-categorias.php'
                            </script>";
                    
                // Se o retorno for um array significa houve erro no processo de inserção 
                } elseif(is_array($resposta)){
                    echo "<script>
                            alert('".$resposta['message']."')
                            window.history.back()
                        </script>";
                }
            }

            elseif($action == 'BUSCAR'){
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
            }

            elseif($action == 'EDITAR') {
                // Recebe o ID que foi encaminhado pelo action do form pela URL
                $idCategoria = $_GET['id'];

                // Chama a função de editar na controller
                $resposta = atualizarCategoria($_POST, $idCategoria);
                // Valida o tipo de dados que a controller retornou
                if(is_bool($resposta)){
                    // Verificando se o retorno foi verdadeiro
                    if($resposta)
                    echo "<script>
                            alert('Registro Atualizado com Sucesso!')
                            window.location.href = 'dashboard-categorias.php'
                            </script>";
                    
                // Se o retorno for um array significa houve erro no processo de atualização 
                } elseif(is_array($resposta)){
                    echo "<script>
                            alert('".$resposta['message']."')
                            window.history.back()
                        </script>";
                }


            }


            break;
        default:
            break;
    }
}


?>