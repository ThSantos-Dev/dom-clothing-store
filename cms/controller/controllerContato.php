<?php

/**
 * Objetivo: Arquivo responsável pela manipulação de dados de contatos
 *              Obs(Este arquivo fará ponte entre a VIEW e a MODEL)
 * Autor: Thales
 * Data: 04/03/2022
 * */

//  Função para inserir contato no BD
function inserirContato($dadosContato)
{
    // Validação para verificar se o objeto está vazio
    if (!empty($dadosContato)) {
        // Validação para verificar se os itens obrigatórios no BD estão preenchidos
        // Nome e email
        if (!empty($dadosContato['txtNome']) && !empty($dadosContato['txtEmail'])) {
            /**
             * Criação do array de dados que será encaminhado a model para 
             * inserção no BD, é importante criar este array conforme
             * as necessidades de manipulação do BD.
             * 
             * OBS.: criar as chaves do Array conforme os nomes dos atributos do BD
             ****************************************************************************/

            $atualizacoes_email = (int) 0;

            if (isset($_POST['txtAtualizacoes']))
                $atualizacoes_email = 1;

            $arrayDados = array(
                "nome"                 => $dadosContato['txtNome'],
                "telefone"             => $dadosContato['txtTelefone'],
                "email"                => $dadosContato['txtEmail'],
                "obs"                  => $dadosContato['txtMensagem'],
                "atualizacoes_email"   => $atualizacoes_email
            );

            //  Import do arquivo de modelagem para manipular o BD
            require_once('cms/model/bd/usuario.php');

            // Chamando a função para inserir contato no BD
            if (insertContato($arrayDados))
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

// Função para solicitar dados da model e encaminhar a lista de contatos para a VIEW
function listaContatos()
{
    // Import do arquivo que vai buscar os dados no BD
    require_once('model/bd/contato.php');

    // Chama a função que vai buscar os dados no BD e guarda seu contéudo na variável $dados
    $dados = selectAllContatos();

    // Validando se houve retorno por parte do banco
    if (!empty($dados))
        return $dados;
    else
        return false;
}

// Função para exluir contato no BD
function excluirContato($id)
{
    // Validação para verificar se o $id é um número VÁLIDO
    if ($id != 0 && !empty($id) && is_numeric($id)) {
        // Import do arqivo de modelagem para manipular o BD
        require_once('cms\model\bd\contato.php');

        // Chama a função da model 
        if (deleteContato($id))
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
