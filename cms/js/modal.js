/**************************************************************
 * Objetivo: arquvo de funções para lógica de exibição modal  *     
 * Data: 30/04/2022                                           *
 * Autor: Thales Santos                                       *           
 *************************************************************/

'use strict'


// Variável de ambiente
let show = true

/** 
 * Função para exibir/ocultar a modal
 * 
 * @param {String} idFormContainer ID do container do formulário
 * @return {VoidFunction} Sem retorno
 * */ 
export const toggleModal = (idFormContainer) => {
    // Resgantando elementos HTML
    const formContainer = document.getElementById(idFormContainer);

    document.body.style.overflowY = show ? 'hidden' : 'auto'
    
    formContainer.classList.toggle('active', show)
    show = !show
}















