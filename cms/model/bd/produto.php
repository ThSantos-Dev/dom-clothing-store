<?php

/**
 * Objetivo: Arquivo de funções que irão manipular o Banco de Dados
 * Autor: Thales Santos
 * Data: 06/05/2022
 */

// Import do arquivo responsável por abrir conexão com o BD
require_once('conexaoMySQL.php');

// Função que lista todos os Produtos do BD
function selectAllProdutos()
{
    // Abrindo conexão com o BD
    $conexao = conexaoMySQL();

    // Script SQL para retornar todos os dados da tabela
    $sql = 'SELECT * FROM tbl_produtos ORDER BY id_produto DESC';

    $result = mysqli_query($conexao, $sql);
    $arrayDados = array();

    // Verificando se o banco retornou algo
    if ($result) {
        $cont = 0;

        while ($rsDados = mysqli_fetch_assoc($result)) {
            if ($rsDados) {
                $arrayDados[$cont] = array(
                    'id' => $rsDados['id_produto'],
                    'titulo' => $rsDados['titulo'],
                    'preco' => $rsDados['preco'],
                    'destaque' => $rsDados['destaque'],
                    'desconto' => $rsDados['desconto'],
                    'fotoPrincipal' => $rsDados['foto_principal']
                );

                $cont++;
            }
        }

        // Solicita fechamento de conexão com o BD
        fecharConexaoMySQL($conexao);

        // Retornano o array contendo os dados do BD
        return $arrayDados;
    }
}

// Função que insere novo Produto no BD
function insertProduto($dadosProduto) {
    // Abre conexão com o BD
    $conexao = conexaoMySQL();

    // Variável de ambiente
    $statusResposta = false;

    // Script SQL para inserir Produto no banco
    $sql = "INSERT INTO tbl_produtos(
            titulo,
            preco,
            quantidade,
            desconto,
            destaque,
            foto_principal
        ) values(
            '". $dadosProduto['titulo'] ."',
            '". $dadosProduto['preco'] ."',
            '". $dadosProduto['quantidade'] ."',
            '". $dadosProduto['desconto'] ."',
            '". $dadosProduto['destaque'] ."',
            'react.png')";

    if(mysqli_query($conexao, $sql)) {
        if(mysqli_affected_rows($conexao))
            $statusResposta = true;
    }

    // Solicitando fechando de conexão com o BD
    fecharConexaoMySQL($conexao);

    return $statusResposta;
}
