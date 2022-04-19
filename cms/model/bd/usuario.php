<?php
/**
 * Obejtivo: Arquivo de funções que irão manipular o banco de dados.
 * Data: 19/04/2022
 * Autor: Thales Santos
 */

 // Import do arquivo que contém as funções para abir 
//  e fechar conexão do MySQL
require_once('conexaoMySQL.php');

// Função que lista todos os dados de usuarios do BD
function selectAllUsuarios() {
    // Abre conexão com o MySQL
    $conexao = conexaoMySQL();

    // Script SQL para listar todas os usuarios
    $sql = "select * from tbl_usuarios order by nome asc";

    // Executando Script no BD
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
                    "id"       => $rsDados['id_usuario'],
                    "nome"     => $rsDados['nome'],
                    "telefone" => $rsDados['telefone'],      
                    "email"    => $rsDados['email']
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
function insertUsuario($dadosUsuario)
{
    $statusResposta = (bool) false;

    // Abrindo conexão com o MySQL
    $conexao = conexaoMySQL();

    // Script para inserir dados no BD
    $sql = "INSERT INTO tbl_usuarios(
        nome,
        telefone,
        email,
        senha,
        data_nascimento
    ) values(
        '" . $dadosUsuario['nome'] . "',
        '" . $dadosUsuario['telefone'] . "',
        '" . $dadosUsuario['email'] . "',
        '" . $dadosUsuario['senha'] . "',
        " . $dadosUsuario['data_nascimento'] . "
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











?>