<?php
/**
 * Objetivo: Arquivo responsável pela manipulação de dados de contatos
 *              Obs(Este arquivo fará ponte entre a VIEW e a MODEL)
 * Autor: Thales
 * Data: 19/03/2022
 * */

// Função para solicitar dados da model e encaminhar a lista de ususarios para a VIEW
function listaUsuarios()
{
    // Import do arquivo que vai buscar os dados no BD
    require_once('model/bd/usuario.php');

    // Chama a função que vai buscar os dados no BD e guarda seu contéudo na variável $dados
    $dados = selectAllUsuarios();

    // Validando se houve retorno por parte do banco
    if (!empty($dados))
        return $dados;
    else
        return false;
}

//  Função para inserir contato no BD
function inserirUsuario($dadosUsuario)
{
    // Validação para verificar se o objeto está vazio
    if (!empty($dadosUsuario)) {
        // Validação para verificar se os itens obrigatórios no BD estão preenchidos
        // Nome e email
        if (!empty($dadosUsuario['txtNome']) && !empty($dadosUsuario['txtEmail'])) {
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
                "nome"                 => $dadosUsuario['txtNome'],
                "telefone"             => $dadosUsuario['txtTelefone'],
                "email"                => $dadosUsuario['txtEmail'],
                "senha"                => $dadosUsuario['txtSenha'],
                "data_nascimento"      => $dadosUsuario['dateNascimento']
            );

            //  Import do arquivo de modelagem para manipular o BD
            require_once('cms/model/bd/usuario.php');

            // Chamando a função para inserir contato no BD
            if (insertUsuario($arrayDados))
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