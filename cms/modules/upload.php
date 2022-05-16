<?php
/**************************************************************************************
 * Objetivo: Arquivo responsável em realizar uploads de arquivos 
 * Autor: Thales Santos
 * Data: 25/04/2022
 * Versão: 1.0
 *************************************************************************************/

//  Função para realizar upload de uma imagem
function uploadFile($arrayFile)
{
    // Import do arquivo de configurações do projeto
    require_once('modules/config.php');

    // Variável criada para preservação do conteudo de $arrayFile
    $arquivo = $arrayFile;
    $sizeFile = (int) 0;
    $typeFile = (string) null;
    $nameFile = (string) null;
    $tempFile = (string) null;

    // Validação para identificar se existe um arquivo válido (maior que 0 e que tenha uma extensão)
    if ($arquivo['size'] > 0 && $arquivo['type'] != "") {
        // Recupera o Tamanho do arquivo que é em Bytes e converte para KB (/1024)
        $sizeFile = $arquivo['size'] / 1024;

        // Recupera o Tipo do arquivo
        $typeFile = $arquivo['type'];

        // Recupera o Nome do arquivo
        $nameFile = $arquivo['name'];

        // Recupera o Caminho do arquivo temporário
        $tempFile = $arquivo['tmp_name'];


        // Validando o tamanho do arquivo
        if ($sizeFile <= MAX_SIZE_FILE_UPLOAD) {
            // Validação para permitir somente as extensões válidas
            if (in_array($typeFile, EXT_ALLOWED_FILE_UPLOAD)) {
                // Separa somente o nome do arquivo sem a sua extensão
                $nome = pathinfo($nameFile, PATHINFO_FILENAME);

                // Separa somente o nome do arquivo sem a sua extensão
                $extensao = pathinfo($nameFile, PATHINFO_EXTENSION);

                /** 
                 * Existem diverosos algoritmos para criptgrafia de dados
                 * md5()
                 * sha1()
                 * hash()
                 * 
                 * */

                // md5()    - gerando uma criptografia de dados
                // uniqid() - gerando uma sequência numérica diferente tendo como base, configurações da maquina
                // time()   - pega a HORA:MINUTO:SEGUNDO que esta sendo feito o upload da foto
                $nomeCriptografado = md5($nome . uniqid(time()));

                //  Montamos novamente o nome do arquivo com a extensão
                $foto = $nomeCriptografado . "." . $extensao;

                // Envia o arquivo da pasta temporária do Apache para a pasta criada no Projeto
                if (move_uploaded_file($tempFile, PATH_FILE_UPLOAD . $foto)) {
                    return $foto;
                } else {
                    return array(
                        'id' => 13,
                        'message' => 'Não foi possível mover o arquivo para o servidor.'
                    );
                }
            } else {
                return array(
                    'id' => 12,
                    'message' => 'A extensão do arquivo selecionado não é permitida no upload.'
                );
            }
        } else {
            return array(
                'id' => 10,
                'message' => 'Tamanho de arquivo inválido no upload. Tamanho máximo de: ' . MAX_SIZE_FILE_UPLOAD
            );
        }
    } else {
        return array(
            'id' => 11,
            'message' => 'Não é possível  realizar o upload sem um arquivo selecionado.'
        );
    }
}

//  Função para realizar upload de várias imagens
function uploadFiles($arrayFiles)
{
    $filesName = array();
        
    foreach ($arrayFiles as $file){
        array_push($filesName,  uploadFile($file));
    }
    
    return $filesName;
}
