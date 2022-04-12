<?php

/**
 * Obejtivo: Arquivo de funções que irão manipular o banco de dados.
 * Data: 04/04/2022
 * Autor: Thales Santos
 */

// Import do arquivo que contém as funções para abir 
//  e fechar conexão do MySQL
require_once('conexaoMySQL.php');

// Função que lista todos os contatos do BD
function selectAllContatos()
{
    // Abre a conexão com o BD
    $conexao = conexaoMySQL();

    // Script sql para listar todos os contatos
    $sql = "SELECT * FROM tbl_contatos order by id_contato desc";

    // Chamando mysqli passando os dados de conexao e script a ser executado
    $result = mysqli_query($conexao, $sql);
    $arrayDados = array();

    // Validando se o BD  retornou registros
    if ($result) {

        // Convertendo retorno do banco para o formato de array, para que   
        // assim o PHP consiga manipular 
        $cont = 0;
        while ($rsDados = mysqli_fetch_assoc($result)) {
            if ($rsDados) {
                // Cria um array com os dados do BD
                $arrayDados[$cont] = array(
                    "id"                    => $rsDados['id_contato'],
                    "nome"                  => $rsDados['nome'],
                    "telefone"              => $rsDados['telefone'],
                    "email"                 => $rsDados['email'],
                    "obs"                   => $rsDados['obs'],
                    "atualizacoes_email"     => $rsDados['atualizacoes_email']
                );

                $cont++;
            }
        }

        // Solicita o fechamento da conexao com o BD
        fecharConexaoMySQL($conexao);

        // Retornando o array contendo os dados do BD
        return $arrayDados;
    }
}

// Função que insere UM contato no BD
function insertContato($dadosContato)
{
    $statusResposta = (bool) false;

    // Abrindo conexão com o MySQL
    $conexao = conexaoMySQL();

    // Script para inserir dados no BD
    $sql = "INSERT INTO tbl_contatos(
        nome,
        telefone,
        email,
        obs,
        atualizacoes_email
    ) values(
        '" . $dadosContato['nome'] . "',
        '" . $dadosContato['telefone'] . "',
        '" . $dadosContato['email'] . "',
        '" . $dadosContato['obs'] . "',
        " . $dadosContato['atualizacoes_email'] . "
    )";

    // Chamada da função mysqli_query($conexao, $sql) que executa um script no BD
    if (mysqli_query($conexao, $sql)) {
        // Validação para verificar se uma linha foi afetada (acrescentada) no BD
        if (mysqli_affected_rows($conexao))
            $statusResposta = true;
    }

    // fechando conexão com o MySQL
    fecharConexaoMySQL($conexao);

    return $statusResposta;
}

// Função para excluir um contato pelo ID
function deleteContato($id)
{
    // Abrindo conexão com o BD
    $conexao = conexaoMySQL();

    // Variável de controle
    $statusResposta = (bool) false;

    // Script SQL para excluir os dados no BD
    $sql = "delete from tbl_contatos where id_contato=" . $id;

    // Validação para verificar se o script SQL está correto, sem erro de sintaxe e execut no BD
    if (mysqli_query($conexao, $sql)) {
        // Validação para verificar se uma linha foi afetada (excluida) no BD
        if (mysqli_affected_rows($conexao))
            $statusResposta = true;
    }

    // Solicita fechamento da conexão com o BD
    fecharConexaoMySQL($conexao);

    return $statusResposta;
}
