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
    // $sql = 'SELECT * FROM tbl_produtos ORDER BY id_produto DESC';
    $sql = 'SELECT * FROM tbl_produtos INNER JOIN tbl_categorias ON tbl_produtos.id_categoria = tbl_categorias.id_categoria ORDER BY id_produto DESC';

    $result = mysqli_query($conexao, $sql);
    $arrayDados = array();

    // Verificando se o banco retornou algo
    if ($result) {
        $cont = 0;

        // Import da função que busca a categoria pelo id
        // require_once('controller/controllerCategoria.php');

        while ($rsDados = mysqli_fetch_assoc($result)) {
            if ($rsDados) {
                $arrayDados[$cont] = array(
                    'id_produto' => $rsDados['id_produto'],
                    'titulo' => $rsDados['titulo'],
                    'preco' => $rsDados['preco'],
                    'destaque' => $rsDados['destaque'],
                    'desconto' => $rsDados['desconto'],
                    // 'categoria' => selectByIdCategoria($rsDados['id_categoria'])['nome'],
                    'categoria'     => $rsDados['nome'],
                    'id_categoria' => $rsDados['id_categoria'],
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

// Função que busca um produto pelo ID
function selectByIdProduto($id)
{
    // Abrindo conexão com o BD
    $conexao = conexaoMySQL();

    // Script SQL para buscar por ID
    // $sql = "SELECT * FROM tbl_produtos
    //          INNER JOIN tbl_categorias ON tbl_produtos.id_categoria = tbl_categorias.id_categoria
    //          WHERE tbl_produtos.id_produto = {$id} ORDER BY id_produto DESC";

    $sql = "SELECT 
                    tbl_produtos.id_produto, tbl_produtos.titulo, tbl_produtos.preco, tbl_produtos.desconto, tbl_produtos.destaque, tbl_produtos.foto_principal, tbl_produtos.quantidade,
                    tbl_categorias.id_categoria, tbl_categorias.nome AS nomeCategoria,
                    tbl_imagens.id_imagem, tbl_imagens.nome AS nomeImagem
                FROM tbl_produtos
                    INNER JOIN tbl_categorias ON tbl_produtos.id_categoria = tbl_categorias.id_categoria
                    INNER JOIN tbl_imagens ON tbl_imagens.id_produto = {$id} 
            WHERE tbl_produtos.id_produto = {$id};";

    die($sql);

    // Executando o Script
    $result = mysqli_query($conexao, $sql);
    $imagens = array();
    $cont = 0;

    if ($result) {
        while ($rsDados = mysqli_fetch_assoc($result)) {
            $auxiliar['nome'] = $rsDados['nomeImagem'];
            $auxiliar['id'] = $rsDados['id_imagem'];
            $imagens[$cont] = $auxiliar;

            $arrayDados = array(
                'id_produto'    => $rsDados['id_produto'],
                'titulo'        => $rsDados['titulo'],
                'preco'         => $rsDados['preco'],
                'quantidade' => $rsDados['quantidade'],
                'destaque'      => $rsDados['destaque'],
                'desconto'      => $rsDados['desconto'],
                'categoria'     => $rsDados['nomeCategoria'],
                'id_categoria'  => $rsDados['id_categoria'],
                'fotoPrincipal' => $rsDados['foto_principal'],

                'imagens' => !empty($imagens) ? $imagens : null,
            );
            $cont++;
        }

        echo '<pre>';
            print_r($arrayDados);
        echo'</pre>';

        die;



        // Solicita fechamento da conexão com o BD
        fecharConexaoMySQL($conexao);

        return $arrayDados;
    }
}

// Função que atualiza os dados do registro no BD
function updateProduto($dadosProduto)
{
    // Abre conexão com o BD
    $conexao = conexaoMySQL();

    // Variável de controle
    $statusResposta = (bool) false;
    $imagens        = $dadosProduto['imagens'];

    // Dados teste
    // $imagens = array(
    //     'imagem1' => array(
    //                 'nome' => '1169c8b910642cc6c68a63ccd4e4aa73.png',
    //                 'id'   => 1
    //             ),

    //     'imagem2' => array(
    //                 'nome' => '1169c8b910642cc6c68a63ccd4e4aa73.png',
    //                 'id'   => 2
    //             ),

    //     'imagem3' => array(
    //                 'nome' => '1169c8b910642cc6c68a63ccd4e4aa73.png',
    //                 'id'   => 3
    //             ),

    //     'imagem4' => array(
    //                 'nome' => '1169c8b910642cc6c68a63ccd4e4aa73.png',
    //                 'id'   => 4
    //             )
    // );


    echo '<pre>Produto.php: ';
    print_r($imagens); #print_r($files);
    echo '</pre>';

    die;


    foreach ($imagens as $imagem) {
        if (!empty($imagem['id'] && $imagem['nome'])) {
            $script = "UPDATE tbl_imagens SET
                            nome = '" . $imagem['nome'] . "' 
                        WHERE id_imagem = " . $imagem['id'];

            echo '<pre>Produto.php: ';
            print_r($script); #print_r($files);
            echo '</pre>';

            die;
            mysqli_query($conexao, $script);
        } else if (!empty($imagem['nome'])) {
            $script = " INSERT INTO tbl_imagens(nome, id_produto)
                            VALUES ('" . $imagem['nome'] . "', " . $dadosProduto['id'] . ")";

            echo '<pre>Produto.php: ';
            print_r($script); #print_r($files);
            echo '</pre>';

            die;
            mysqli_query($conexao, $script);
        }
    }

    // Script SQL para excluir os dados do BD
    $sql = "UPDATE tbl_produtos SET
                titulo = '{$dadosProduto['titulo']}',
                preco = '{$dadosProduto['preco']}',
                quantidade = '{$dadosProduto['quantidade']}',
                desconto = '{$dadosProduto['desconto']}',
                destaque = '{$dadosProduto['destaque']}',
                id_categoria = '{$dadosProduto['id_categoria']}',
                foto_principal = '{$dadosProduto['foto_principal']}'
            WHERE id_produto = {$dadosProduto['id']}";

    if (mysqli_query($conexao, $sql)) {
        if (mysqli_affected_rows($conexao))
            $statusResposta = true;
    }

    // Solicitando fechando de conexão com o BD
    fecharConexaoMySQL($conexao);

    return $statusResposta;
}


// Função que insere novo Produto no BD
function insertProduto($dadosProduto)
{
    // Resgatando o array que contém o nome todas as imagens
    $arrayImagens = $dadosProduto['imagens'];

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
            id_categoria,
            foto_principal
        ) values(
            '" . $dadosProduto['titulo'] . "',
            '" . $dadosProduto['preco'] . "',
            '" . $dadosProduto['quantidade'] . "',
            '" . $dadosProduto['desconto'] . "',
            '" . $dadosProduto['destaque'] . "',
            '" . $dadosProduto['id_categoria'] . "',
            '" . $dadosProduto['foto_principal'] . "')";

    if (mysqli_query($conexao, $sql)) {
        if (mysqli_affected_rows($conexao)) {

            // Validação paa verificar se há imagens para serem inseridas
            if (count($arrayImagens) > 0) {
                // Resgatando o id do último registro do Banco
                $id = mysqli_insert_id($conexao);

                // Array que vai receber o nome das imagens concatenado com o id do produto
                $array = array();

                // Formatando os elementos para script sql
                foreach ($arrayImagens as $nome) {
                    if (!empty($nome))
                        array_push($array, "'" . $nome . "'" . ', ' . $id);
                }

                // Variável que vai abrigar as string formatada de cada elemento
                $string = implode('),(', $array);

                // Script sql para inserir as imagens no banco
                $sql = "INSERT INTO tbl_imagens(nome, id_produto)
                                VALUES(" . $string . ")";

                // Validação para verificar se o nome das imagens foi inserido no banco
                if (mysqli_query($conexao, $sql))
                    if (mysqli_affected_rows($conexao))
                        $statusResposta = true;
            } else
                $statusResposta = true;
        }
    }

    // Solicitando fechando de conexão com o BD
    fecharConexaoMySQL($conexao);

    return $statusResposta;
}

// Função para gerar script sql para inserir as imagens

// Função que apaga um registro do BD
function deleteProduto($id)
{
    // Abre conexão com o BD
    $conexao = conexaoMySQL();

    // Variável de controle
    $statusResposta = (bool) false;

    // Script SQL para excluir os dados do BD
    $sql = "DELETE FROM tbl_produtos WHERE id_produto = {$id}";

    // Validando se o script está correto
    if (mysqli_query($conexao, $sql)) {
        // Validação para verificar se uma linha foi afetada (excluída)
        if (mysqli_affected_rows($conexao))
            $statusResposta = true;
    }

    // Solicita o fechamento de conexão com o BD
    fecharConexaoMySQL($conexao);

    return $statusResposta;
}
