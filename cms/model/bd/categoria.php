<?php
/**
 * Obejtivo: Arquivo de funções que irão manipular o banco de dados.
 * Data: 09/04/2022
 * Autor: Thales Santos
 */

 // Import do arquivo que contém as funções para abir 
//  e fechar conexão do MySQL
require_once('conexaoMySQL.php');

 // Função que insere uma CATEGORIA no BD
function insertCategoria($nome) {
    $statusResposta = false;

    // Abre conexão com o MySQL
    $conexao = conexaoMySQL();

    // Script SQL para inserir uma CATEGORIA no BD
    $sql = "INSERT INTO tbl_categorias(
        nome
    ) values (
        $nome
    )";

    // Chamada da função mysqli_query($conexao, $sql) que executa um Script no BD
    if(mysqli_query($conexao, $sql)) {
        if(mysqli_affected_rows($conexao))
            $statusResposta = true;
    }

    // Fechando conexão com o BD
    fecharConexaoMySQL($conexao);

    return $statusResposta;
}
?>