<?php
/**************************************************************************************
 * Objetivo: Arquivo responsável pela criação de constante e variáveis do projeto
 * Autor: Thales Santos
 * Data: 13/05/2022
 * Versão: 1.0
 *************************************************************************************/

    //  Limitação de 5MB para upload de imagens
    const MAX_SIZE_FILE_UPLOAD = 5120;

    // Extensões de arquivos permitiadas para upload de imagens
    const EXT_ALLOWED_FILE_UPLOAD = array("image/jpg", "image/png", "image/jpeg", "image/gif");

    // Diretório onde os arquivos ficarão salvos
    const PATH_FILE_UPLOAD = 'uploads/';



?>