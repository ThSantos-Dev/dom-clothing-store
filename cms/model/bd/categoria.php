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
function insertCategoria($dados) {
    $statusResposta = false;

    // Abre conexão com o MySQL
    $conexao = conexaoMySQL();

    // Script SQL para inserir uma CATEGORIA no BD
    $sql = "INSERT INTO tbl_categorias(
        nome
    ) values (
        '".$dados['nome']."'
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

// Função que lista todos os dados de categoria do BD
function selectAllCategorias() {
    // Abre conexão com o MySQL
    $conexao = conexaoMySQL();

    // Script SQL para listar todas as categorias
    $sql = "select * from tbl_categorias order by nome asc";

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
                    "id_categoria"          => $rsDados['id_categoria'],
                    "nome"                  => $rsDados['nome'],
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

// Função para excluir uma categoria
function deleteCategoria($id) {
    // Abrindo conexão com o BD
    $conexao = conexaoMySQL();

    // Variável de controle
    $statusResposta = (bool) false;

    // Script SQL para excluir os dados no BD
    $sql = "DELETE FROM tbl_categorias where id_categoria=" . $id;

    // Validação para verificar se o script SQL está correto, sem erro de sintaxe e executa no BD
    if(mysqli_query($conexao, $sql)){
        // Validação para verificar se uma linha foi afetada (excluída) no BD
        if(mysqli_affected_rows($conexao))
            $statusResposta = true;
    }

    // Solicita fechamento da conexão com o BD
    fecharConexaoMySQL($conexao);

    return $statusResposta;
}

// Função para buscar uma categoria pelo ID 
function selectByIdCategoria($id) {
    // Abre a conexão com o BD
    $conexao = conexaoMySQL();

    // script para buscar uma Categoria do dados do BD
    $sql = "select * from tbl_categorias where id_categoria = ".$id;
    $result = mysqli_query($conexao, $sql);

    // Valida se o BD retornou registros
    if ($result) {
        // dentro do if o $rsDados recebe os dados do banco

        /**
         * mysqli_fetch_assoc() - permite converter os dados do BD em um array para 
         *                          manipulação no PHP 
         * Nesta repetição estamos, convertendo os dados do BD em um array ($rsDados),
         * além de o próprio if conseguir gerenciar se o banco retornou dados
         * e atribui a variável $rsDados
         * 
         */
        if ($rsDados = mysqli_fetch_assoc($result)) {
            // Cria um array com dados do BD
            $arrayDados= array(
                "id"        => $rsDados['id_categoria'],
                "nome"      => $rsDados['nome'],
            );
        }

        // Solicita o fechamento da conexão com o BD
        fecharConexaoMySQL($conexao);

        return $arrayDados;
    }
}

// Função para atualizar categoria
function updateCategoria($dados) {
    // Abre a conexão com o BD
    $conexao = conexaoMySQL();

    // Declaração de variável  oara utilizar no return dessa função
    $statusResposta = (bool) false;

    // Script SQL para atualizar os dados no BD
    $sql = "
        update tbl_categorias set
            nome= '" . $dados['nome'] .  "'
        where id_categoria =  " . $dados['id'];
        
    // Executa Script no BD
    // msyqli_query(dados de conexao, script sql)
    // Validação para verificar se o script SQL está correto
    if (mysqli_query($conexao, $sql)) {
        // Validação para verificar se uma linha foi afetada (acrescentada) no BD
        if (mysqli_affected_rows($conexao))
            $statusResposta = true;
    }

    // Solicita o fechamento da conexão com o BD
    fecharConexaoMySQL($conexao);
    return $statusResposta;

}

?>