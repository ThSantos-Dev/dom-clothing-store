<?php
/**
 * Obejtivo: Arquivo de funções que irão manipular o banco de dados.
 * Data: 19/04/2022
 * Autor: Thales Santos
 */

 // Import do arquivo que contém as funções para abir 
//  e fechar conexão do MySQL
require_once('conexaoMySQL.php');

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
        data_nascimento,
        sexo
    ) values(
        '" . $dadosUsuario['nome'] . "',
        '" . $dadosUsuario['telefone'] . "',
        '" . $dadosUsuario['email'] . "',
        '" . $dadosUsuario['senha'] . "',
        '" . $dadosUsuario['data_nascimento'] . "',
        '" . $dadosUsuario['sexo'] . "'
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

// Função para excluir um usuário
function deleteUsuario($id) {
    // Abre conexao com o BD
    $conexao = conexaoMySQL();

    // Variável de controle
    $statusResposta = (bool) false;

    // Script SQL para excluir os dados no BD
    $sql = "DELETE FROM tbl_usuarios where id_usuario =" .$id;

    // Validação para verificar se o script SQL está correto, sem erro de sintaxe e executa no BD
    if(mysqli_query($conexao, $sql)){
        // Validação para verificar se uma linha foi afetada (excluída) no BD
        if(mysqli_affected_rows($conexao))
            $statusResposta = true;
    }

    // Solicita fechamento da conexao com o BD
    fecharConexaoMySQL($conexao);

    return $statusResposta;
}

function updateUsuario($dados) {
    // Abre a conexão com o BD
    $conexao = conexaoMySQL();

    // Variavel de controle 
    $statusResposta = (bool) false;

    // Script SQL para atualizar os dados no BD
    $sql = "
        update tbl_usuarios set
        nome            = '" . $dados['nome']     . "',
        telefone        = '" . $dados['telefone'] . "',
        senha           = '" . $dados['senha']  . "',
        email           = '" . $dados['email']    . "',
        data_nascimento = '" . $dados['data_nascimento'] . "',
        sexo            = '" . $dados['sexo'] . "'
        where id_usuario = " . $dados['id'];

    // Executando script no BD
    if(mysqli_query($conexao, $sql)) {
        if(mysqli_affected_rows($conexao))
            $statusResposta = true;
    }

    // Fechando conexão com o BD
    fecharConexaoMySQL($conexao);
    return $statusResposta;
}

// Função que busca usuário pelo ID
function selectUsuarioById($id) {
    // Abre a conexão com o BD
    $conexao = conexaoMySQL();

    // script para buscar um Usuario do dados do BD
    $sql = "select * from tbl_usuarios where id_usuario = ".$id;
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
                "id"                   => $rsDados['id_usuario'],
                "nome"                 => $rsDados['nome'],
                "telefone"             => $rsDados['telefone'],
                "email"                => $rsDados['email'],
                "data_nascimento"      => $rsDados['data_nascimento'],
                "sexo"                 => $rsDados['sexo']
            );

        }

        // Solicita o fechamento da conexão com o BD
        fecharConexaoMySQL($conexao);

        return $arrayDados;
    }

}

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





?>