/*************************************************************
 * Objetivo: Arquivo de funções para Slider de imagens
 * Autor: Thales Santos
 * Data: 10/03/2022
 * Versão: 1.0
 ************************************************************/


'use strict'

// Simulando BD
const bd_slider = [
    {
        'id'    : 1,
        'name'  : 'banner 1',
        'url'   : './assets/img/slider-imgs/33bannera50640450.png'
    },
    {
        'id'    : 2,
        'name'  : 'banner 2',
        'url'   : './assets/img/slider-imgs/33_banner637818914128259926.png'
    },
    {
        'id'    : 3,
        'name'  : 'banner 3',
        'url'   : './assets/img/slider-imgs/21_banner637818908574778054.png'
    },
    {
        'id'    : 4,
        'name'  : 'banner 4',
        'url'   : 'assets/img/slider-imgs/0_2_100209681_1_1920.jpg'
    },
    {
        'id'    : 5,
        'name'  : 'banner 5',
        'url'   : 'assets/img/slider-imgs/0_0_100210217_3_1920.jpg'
    },
]


// Variáveis de ambiente
let current = 0
let auto = true
let countSlides
let currentSlide 

// Recuperando elementos HTML
/** controls */
const containerBalls = document.querySelector('.controls-balls')
const btnPrevius = document.getElementById('slider-controls-previus')
const btnNext = document.getElementById('slider-controls-next')
/** ** controls */


/** Slider */
const carregarSlides = (images) => {
    const slidesContainer = document. getElementById('slides-container')
    
    let slides = images.map(criarSlide)
    
    slidesContainer.replaceChildren(...slides)
    
    countSlides = document.querySelectorAll('#slides-container .slides')
    countSlides[0].id = 'currentSlide'

    currentSlide = document.getElementById('currentSlide')

    geraBalls()
    autoSlide()
}

const criarSlide = (img) => {
    let slide = document.createElement('div')
    slide.classList.add('slides')
    slide.innerHTML = `
        <a href="#${img.name}" class="link">
            <img src="${img.url}" alt="${img.name}">
        </a>
    `
    return slide
}
/** Slider */

// Função que gera Balls 
const geraBalls = () => {
    let balls = []
    
    for(let i = 0; i < countSlides.length; i++) {
        let div = document.createElement('div')    
        div.id = i
        balls[i] = div        
    }
    
    containerBalls.replaceChildren(...balls)
    
    document.getElementById('0').classList.add('currentImage')
    
    // Adicionando eventos de click em cada Ball
    const ballsDivs = document.querySelectorAll('.controls-balls div')
    for(let i=0; i< ballsDivs.length; i++) {
        ballsDivs[i].addEventListener('click', () => {
            current = ballsDivs[i].id
            auto = false
            slide()
        })
    }
}

// Troca de Slide
const slide =  () => {
    countSlides[0].id = 'currentSlide'
    
    if(current >= countSlides.length)
    current = 0
    else if(current < 0)    
    current = countSlides.length - 1
    
    document.querySelector('.controls-balls .currentImage').classList.remove('currentImage')
    
    let newMargin = currentSlide.clientWidth * current
    currentSlide.style.marginLeft = `-${newMargin}px`
    
    document.getElementById(`${current}`).classList.add('currentImage')
    
}

// Ação dos botões Next e previus
btnPrevius.addEventListener('click', () => {
    current--
    auto = false
    slide()
})

btnNext.addEventListener('click', () => {
    current++
    auto = false
    slide()
})

// Função que passa a cada 8s os slides
const autoSlide = ()  => {    
    setInterval(() => {
        if(auto){
            current++
            slide()
        }else
        auto = true
    }, 3000)
}
// Iniciando Slider
carregarSlides(bd_slider)