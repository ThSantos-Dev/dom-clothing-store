<?php
/**
 * Objetivo: Arquivo responsável pela manipulação de dados de contatos
 *              Obs(Este arquivo fará ponte entre a VIEW e a MODEL)
 * Autor: Thales
 * Data: 12/03/2022
 * */

//  Função para inserir categoria no BD
function inserirCategoria($categoria) {
    // Validação para verificar se o objeto está vazio
    if (!empty($categoria)) {
        // Validação para verificar se os itens obrigatórios no BD estão preenchidos
        // Nome
        if (!empty($categoria['txtCategoria'])) {
            /**
             * Criação do array de dados que será encaminhado a model para 
             * inserção no BD, é importante criar este array conforme
             * as necessidades de manipulação do BD.
             * 
             * OBS.: criar as chaves do Array conforme os nomes dos atributos do BD
             ****************************************************************************/

            $arrayDados = array(
                "nome" => $categoria['txtCategoria'],
            );

            //  Import do arquivo de modelagem para manipular o BD
            require_once('model/bd/categoria.php');

            // Chamando a função para inserir contato no BD
            if (insertCategoria($arrayDados))
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

// Função para listar todas as categorias
function listaCategorias(){
    // Import do arquivo que vai buscar os dados no BD
    require_once('model/bd/categoria.php');

    // Chama a função que vai buscar os dados no BD e guarda seu contéudo na variável $dados
    $dados = selectAllCategorias();

    // Validando se houve retorno por parte do banco
    if (!empty($dados))
        return $dados;
    else
        return false;
}

// Função para excluir categoria no BD
function excluirCategoria($id){ 
    // Validação para verificar se o $id é um número VÁLIDO
    if ($id != 0 && !empty($id) && is_numeric($id)) {
        // Import do arqivo de modelagem para manipular o BD
        require_once('model\bd\categoria.php');

        // Chama a função da model 
        if (deleteCategoria($id))
            return true;
        else
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

// Função para buscar categoria no BD pelo ID do registro
function buscarCategoria($id) {
    // Validação para verificar se o $id contém um número VÁLIDO.
    if($id != 0 && !empty($id) && is_numeric($id)){
        // Import do arquivo de modelagem para manipular o BD.
        require_once('model/bd/categoria.php');
        
        // Chama a função na model que vai buscar no BD 
        $dados = selectByIdCategoria($id);

        // Valida se existem dados para serem devolvidos
        if(!empty($dados))
            return $dados;
        else
            return false;
    } else 
        return array('idErro'   => 4,
                        'message'  => 'Não é possível buscar um registro sem informar um ID válido.');
}

// Função para atualizar categoria
function atualizarCategoria($dados, $idCategoria) {
    // Validação para verificar se o objeto está vazio
    if (!empty($dados)) {
        // Validação para verificar se os itens obrigatórios no BD estão preenchidos
        // Nome
        if (!empty($dados['txtCategoria']) && is_numeric($idCategoria) && !empty($idCategoria)    ) {
            /**
             * Criação do array de dados que será encaminhado a model para 
             * inserção no BD, é importante criar este array conforme
             * as necessidades de manipulação do BD.
             * 
             * OBS.: criar as chaves do Array conforme os nomes dos atributos do BD
             ****************************************************************************/

            $arrayDados = array(
                "id"   => $idCategoria,
                "nome" => $dados['txtCategoria']
            );

            //  Import do arquivo de modelagem para manipular o BD
            require_once('model/bd/categoria.php');

            // Chamando a função para inserir contato no BD
            if (updateCategoria($arrayDados))
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



?>