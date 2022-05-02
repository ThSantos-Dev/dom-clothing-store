'use strict';

// Imports
import { toggleModal } from "../modal.js";

// Eventos
document.getElementById('btnModal').addEventListener('click', () =>  toggleModal('formCadastroUsuario'))
document.getElementById('btnCancelar').addEventListener('click', () => toggleModal('formCadastroUsuario'))


