export const showPreview = event => {
    const container = event.target.parentNode
    const [input, image] = container.children

    console.log(container.children)

    input.onchange = () => {
      const [file] = input.files

      if(file)
        image.src = URL.createObjectURL(file)
    }
}

/**
 * Função que carrega imagem para preview
 * @param {String} idImage ID da imagem que receberá o conteúdo da input
 * @param {String} idInput ID da input que contém o arquivo de preview
 * @return {VoidFunction} Sem retorno
 */
export const showPreviewMain = (idImage, idInput) => {
  const image = document.getElementById(idImage)
  const input = document.getElementById(idInput)

  input.onchange = () => {
    const [file] = input.files

    if(file)
      image.src = URL.createObjectURL(file)
  }
}


/**
 * Função que carrega mais de uma imagem por vez nas áreas de preview 
 * @param {Sting} imageSelector Seletor CSS que leva a todas as tag img
 * @param {String} idFileInput ID da input type="file" que contém todas as imagens
 * @return {VoidFunction} Sem retorno
 */
export const uploadMultiplePreview = (imageSelector, idFileInput) => {
  const imageTags = document.querySelectorAll(imageSelector)
  console.log(imageTags)

  const imagesFile = document.getElementById(idFileInput)
  
  imagesFile.onchange = () => {
    const files = imagesFile.files

    for (let i = 0; i <= imageTags.length -1; i++) {
      if(files[i])
        imageTags[i].src = URL.createObjectURL(files[i])
    }
  }
  
}
