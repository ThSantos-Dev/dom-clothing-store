
import {toggleModal} from "../modal.js"
import {showPreview, showPreviewMain, uploadMultiplePreview} from "./previewImages.js"

document.querySelector('.modal-images-lateral').addEventListener('click', showPreview)
document.querySelector('.modal-image-main').addEventListener('click', showPreview)
document.getElementById('singleImage').addEventListener('click',() => showPreviewMain('previewFotoMain', 'singleImage'))
document.getElementById('multipleImages').addEventListener('click',() => uploadMultiplePreview('.modal-images-lateral .modal-images img','multipleImages'))

document.getElementById('btnModal').addEventListener('click', () =>  toggleModal('modal-container'))
document.getElementById('btnCancelar').addEventListener('click', () =>  toggleModal('modal-container'))
document.getElementById('closeModal').addEventListener('click', () =>  toggleModal('modal-container'))
// document.getElementById('modal-container').addEventListener('click', () => toggleModal('modal-container'))




toggleModal('modal-container')






