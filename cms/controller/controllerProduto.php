<?php
/**
 * Objetivo: Arquivo responsável pela manipulação de dados de produtos
 * Autor: Thales Santos
 * Data: 06/05/2022
 */

//  Função que solicita dados da model e enccaminha a lista de produtos para a VIEW
function listaProdutos() {
    // Import do arquivo que vai buscar os dados no BD
    require_once('model/bd/produto.php');

    // Chama a função que vai buscar os dados no BD
    $dados = selectAllProdutos();

    // Validando se houve retorno por parte do banco
    if(!empty($dados))
        return $dados;
    else 
        return false;
}

// Função que busca produto pelo ID
function buscarProduto($id) {
    // Verificando se o ID informado é válido
    if(!empty($id) && is_numeric($id) && $id != 0) {
        // Import do arquivo de modelagem para manipular o BD
        require_once('model/bd/produto.php');

        // Chama a função da model que vai buscar no BD
        $dados = selectByIdProduto($id);

        // Valida se existem dados para serem devolvidos
        if(!empty($dados)) 
            return $dados;
        else 
            return false;
    } else 
    return array('idErro'   => 4,
                 'message'  => 'Não é possível buscar um registro sem informar um ID válido.');
}

// Função que solicita a inserção de um Produto no BD
function inserirProduto($dados){ 
    $dadosProduto = $dados['dados'];
    $files        = $dados['arquivos'];

    // Validação para verificar se o objeto está vazio
    if(!empty($dadosProduto)) {
        // Validação para verificar se os itens obrigatórios no BD estão preenchidos
        // Título, preço, quantidade, categoria e foto principal
        if(!empty($dadosProduto['txtTitulo']) && !empty($dadosProduto['txtPreco']) && !empty($dadosProduto['txtQuantidade']) && !empty($dadosProduto['sltCategoria']) && !empty($files['fileFotoMain']['name'])){
            // Fazendo o upload dos arquivos
            require_once('modules/upload.php');

            $nomeFotoPrincipal = uploadFile($files['fileFotoMain']);

            if(is_array($nomeFotoPrincipal))    
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
                "desconto" => !empty($dadosProduto['txtDesconto']) ? $dadosProduto['txtDesconto'] : 0 ,
                "destaque" => $dadosProduto['rdoDestaque'],
                "id_categoria" => $dadosProduto['sltCategoria'],
                "foto_principal" => $nomeFotoPrincipal
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
                'message'  => 'Erro. Há campos obrigatórios que necessitam ser preenchidos.');
    } 
}
















?>