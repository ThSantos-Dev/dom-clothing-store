<?php

/**
 * Objetivo: Arquivo responsável pela manipulação de dados de produtos
 * Autor: Thales Santos
 * Data: 06/05/2022
 */

//  Função que solicita dados da model e enccaminha a lista de produtos para a VIEW
function listaProdutos()
{
    // Import do arquivo que vai buscar os dados no BD
    require_once('model/bd/produto.php');

    // Chama a função que vai buscar os dados no BD
    $dados = selectAllProdutos();

    // Validando se houve retorno por parte do banco
    if (!empty($dados))
        return $dados;
    else
        return false;
}

// Função que busca produto pelo ID
function buscarProduto($id)
{
    // Verificando se o ID informado é válido
    if (!empty($id) && is_numeric($id) && $id != 0) {
        // Import do arquivo de modelagem para manipular o BD
        require_once('model/bd/produto.php');

        // Chama a função da model que vai buscar no BD
        $dados = selectByIdProduto($id);

        // Valida se existem dados para serem devolvidos
        if (!empty($dados))
            return $dados;
        else
            return false;
    } else
        return array(
            'idErro'   => 4,
            'message'  => 'Não é possível buscar um registro sem informar um ID válido.'
        );
}

// Função que edita um Produto
function atualizaProduto($dados)
{

    // Import da função de upload
    require_once('modules/upload.php');
    require_once('modules/config.php');


    $id             = $dados['id'];
    $dadosProduto   = $dados['dados'];
    $files          = $dados['arquivos']; # Imagens que estão sendo encaminhadas pelas inputs
    $imagensAtuais  = $dados['imagensAtuais'];
    $fotoPrincipal  = $dados['fotoPrincipal']; # nome da foto principal

    // die($fotoPrincipal);

    // echo '<pre>';
    // print_r($files);
    // echo '</pre>';

    // die;

    // Imagens que já estavam no BD
    $arrayImagens = array(  
        0  => array(
                        'nome' => $imagensAtuais['imagem1']['nome'],
                        'id' => $imagensAtuais['imagem1']['id'],
                    ),
        1  => array(
                        'nome' => $imagensAtuais['imagem2']['nome'],
                        'id' => $imagensAtuais['imagem2']['id'],
                    ),
        2  => array(
                        'nome' => $imagensAtuais['imagem3']['nome'],
                        'id' => $imagensAtuais['imagem3']['id'],
                    ),

        3  => array(
                        'nome' => $imagensAtuais['imagem4']['nome'],
                        'id' => $imagensAtuais['imagem4']['id'],
                   )
    );

    // echo '<pre>';
    // print_r($arrayImagens); print_r($files);
    // echo '</pre>';

    // die;

    // Variriável de controle para verificar se a foto deverá ser atualizada ou não
    $novaFotoPrincipal = (bool) false;

    // Validação para verificar se o objeto está vazio
    if (!empty($dadosProduto)) {
        // Validação para verificar se os itens obrigatórios no BD estão preenchidos
        // Título, preço, quantidade, categoria e foto principal
        if (!empty($dadosProduto['txtTitulo']) && !empty($dadosProduto['txtPreco']) && !empty($dadosProduto['txtQuantidade']) && !empty($dadosProduto['sltCategoria'])) {
            
            // Validando se a foto principal foi alterada
            if (!empty($files['fileFotoMain']['name'])) {
                $novaFotoPrincipal = true;

                // Chama a função de upload
                $nomeFotoPrincipal = uploadFile($files['fileFotoMain']);

                if (is_array($nomeFotoPrincipal))
                    return $nomeFotoPrincipal;
            } else
                // Permanece a mesma foto no BD
                $nomeFotoPrincipal = $fotoPrincipal;

            /*  *****         ****          ***      ***         **** */

            // Validando se alguma das fotos laterais foi alterada
            $cont = 0;
                for($i=1; $i <= 4; $i++) {
                    if(!empty($files["fileFoto$i"]['name'])) {
                        if(!empty($arrayImagens[$cont]['nome']))
                            unlink(PATH_FILE_UPLOAD . $arrayImagens[$cont]['nome']);

                        $arrayImagens[$cont]['nome'] = uploadFile($files["fileFoto$i"]);
                    }

                    $cont++;
                }

            // echo '<pre>';
            // print_r($arrayImagens); #print_r($files);
            // echo '</pre>';
        
            // die;




            /**
             * Criação do array de dados que será encaminhado a model para 
             * inserção no BD, é importante criar este array conforme
             * as necessidades de manipulação do BD.
             * 
             * OBS.: criar as chaves do Array conforme os nomes dos atributos do BD
             ****************************************************************************/
            $arrayDados = array(
                "id"     =>         $id,
                "titulo"         => $dadosProduto['txtTitulo'],
                "preco"          => $dadosProduto['txtPreco'],
                "quantidade"     => $dadosProduto['txtQuantidade'],
                "desconto"       => !empty($dadosProduto['txtDesconto']) ? $dadosProduto['txtDesconto'] : 0,
                "destaque"       => $dadosProduto['rdoDestaque'],
                "id_categoria"   => $dadosProduto['sltCategoria'],
                "foto_principal" => $nomeFotoPrincipal,
                "imagens"        => $arrayImagens
            );

            //  Import da função para atualizar Produto
            require_once('model/bd/produto.php');

            // Chamando a função para atualizar contato no BD
            if (updateProduto($arrayDados)) {
                // Verificando se será necessário apagar a foto principal
                if ($novaFotoPrincipal)
                    unlink(PATH_FILE_UPLOAD . $fotoPrincipal);
                return true;
            } else
                return array(
                    'idErro'   => 1,
                    'message'  => 'Não foi possível inserir os dados no Banco de Dados.'
                );
        } else
            return array(
                'idErro'   => 2,
                'message'  => 'Erro. Há campos obrigatórios que necessitam ser preenchidos.'
            );
    }
}

// Função que solicita a inserção de um Produto no BD
function inserirProduto($dados)
{
    $dadosProduto = $dados['dados'];
    $files        = $dados['arquivos'];


    $arrayImagens = array(
        'imagem1' => $files['fileFoto1'],
        'imagem2' => $files['fileFoto2'],
        'imagem3' => $files['fileFoto3'],
        'imagem4' => $files['fileFoto4']
    );


    // echo '<pre>';
    // print_r($arrayImagens);
    // echo '</pre>';

    // die;

    // Validação para verificar se o objeto está vazio
    if (!empty($dadosProduto)) {
        // Validação para verificar se os itens obrigatórios no BD estão preenchidos
        // Título, preço, quantidade, categoria e foto principal
        if (!empty($dadosProduto['txtTitulo']) && !empty($dadosProduto['txtPreco']) && !empty($dadosProduto['txtQuantidade']) && !empty($dadosProduto['sltCategoria']) && !empty($files['fileFotoMain']['name'])) {
            // Fazendo o upload dos arquivos
            require_once('modules/upload.php');

            $nomeFotoPrincipal = uploadFile($files['fileFotoMain']);

            $nomeImagens = uploadFiles($arrayImagens);

            if (is_array($nomeFotoPrincipal))
                // Caso a função retorne array, significa que houve erro no processo de upload
                return $nomeFotoPrincipal;


            /**
             * Criação do array de dados que será encaminhado a model para 
             * inserção no BD, é importante criar este array conforme
             * as necessidades de manipulação do BD.
             * 
             * OBS.: criar as chaves do Array conforme os nomes dos atributos do BD
             ****************************************************************************/
            $arrayDados = array(
                "titulo" => $dadosProduto['txtTitulo'],
                "preco" => $dadosProduto['txtPreco'],
                "quantidade" => $dadosProduto['txtQuantidade'],
                "desconto" => !empty($dadosProduto['txtDesconto']) ? $dadosProduto['txtDesconto'] : 0,
                "destaque" => $dadosProduto['rdoDestaque'],
                "id_categoria" => $dadosProduto['sltCategoria'],
                "foto_principal" => $nomeFotoPrincipal,
                "imagens"        => $nomeImagens
            );

            //  Import da função para inserção de novo Produto
            require_once('model/bd/produto.php');

            // Chamando a função para inserir contato no BD
            if (insertProduto($arrayDados))
                return true;
            else
                return array(
                    'idErro'   => 1,
                    'message'  => 'Não foi possível inserir os dados no Banco de Dados.'
                );
        } else
            return array(
                'idErro'   => 2,
                'message'  => 'Erro. Há campos obrigatórios que necessitam ser preenchidos.'
            );
    }
}

// Função que solicita a exclusão de um Registro no BD
function excluirProduto($dados)
{
    require_once('modules/config.php');

    // Recebendo o id registro que será excluído do bd
    $id = $dados['id'];

    if($resposta = buscarProduto($id)) {

        if($resposta['fotoPrincipal']) {
            unlink(PATH_FILE_UPLOAD . $resposta['fotoPrincipal']);
        }

        foreach ($resposta['imagens'] as $imagem) {
            if(unlink(PATH_FILE_UPLOAD . $imagem['nome']))
                echo 'deu certo!';
        }
    }

    // Recuperando as imagens

    // echo "<pre>";
    //     print_r($dados);
    // echo "</pre>";
    // die;
    
    // 

    // Validando o ID 
    if (!empty($id) && is_numeric($id) && $id > 0) {
        // Import do arquivo de modelagem e config
        require_once('model/bd/produto.php');
        require_once('modules/config.php');

        if (deleteProduto($id)) {
            // Validando se a variável foto possuí conteúdo 
            if ($fotoPrincipal != null) {
                if (unlink(PATH_FILE_UPLOAD . $fotoPrincipal)){
                    foreach ($imagensAtuais as $imagem) {
                        if(!empty($imagem['nome']))
                            unlink(PATH_FILE_UPLOAD . $imagem['nome']);

                    }

                    return true;
                }
                else
                    return array(
                        'idErro'   => 5,
                        'message'  => 'O Produto foi excluido do banco de dados. Porém as imagens não podem ser excluídas.'
                    );
            } else
                return true;
        } else
            return array(
                'idErro'   => 3,
                'message'  => 'O banco de dados não pode excluir o registro.'
            );
    } else
        return array(
            'idErro'   => 4,
            'message'  => 'Não é possível excluir um registro sem informar um ID válido.'
        );
}

