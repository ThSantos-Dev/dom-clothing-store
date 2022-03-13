/*************************************************************
 * Objetivo: Arquivo de funções para Carousel de Produtos
 * Autor: Thales Santos
 * Data: 12/03/2022
 * Versão: 1.0
 ************************************************************/
"use strict";

const bd_carousel_products_destaques = [
  {
    id: 1,
    title:
      "Calça Jeans Havicssen Rasgada Masculina com 4 bolsos, costura dupla",
    url: "./assets/img/products/product1.png",
    descount: 42,
    ranking: 3.5,
    oldPrice: 99.99,
    newPrice: 69.99,
    freeShipping: false,
  },
  {
    id: 2,
    title: "Bermuda Zwiq Fina com Elástico Masculina 4 bolsos leve",
    url: "./assets/img/products/product2.png",
    descount: 23,
    ranking: 3,
    oldPrice: 78.99,
    newPrice: 69.99,
    freeShipping: true,
  },
  {
    id: 3,
    title:
      "Vestido farm t-shit curto tapecaroa tropical lenço verde com flores",
    url: "./assets/img/products/product3.png",
    descount: null,
    ranking: 4,
    oldPrice: null,
    newPrice: 169.99,
    freeShipping: true,
  },
  {
    id: 4,
    title: "Kit Camiseta Básica Hering Manga Curta Feminina bela estampa",
    url: "./assets/img/products/product4.png",
    descount: null,
    ranking: 3.5,
    oldPrice: null,
    newPrice: 89.99,
    freeShipping: true,
  },
  {
    id: 5,
    title: "Jaqueta Sarja Cambos Cropped Manga Bufante Verde Argila",
    url: "./assets/img/products/product5.png",
    descount: 76,
    ranking: 5,
    oldPrice: 99.99,
    newPrice: 69.99,
    freeShipping: true,
  },
  {
    id: 6,
    title: "Camisa Milano Manga Longa Masculina",
    url: "./assets/img/products/product10.png",
    descount: 20,
    ranking: 4.5,
    oldPrice: 99.99,
    newPrice: 79.99,
    freeShipping: true,
  },
];

const bd_carousel_products_promocoes = [
  {
    id: 1,
    title: "Camiseta Hering Básica Gola V Feminina",
    url: "./assets/img/products/product6.png",
    descount: 42,
    ranking: 3.5,
    oldPrice: 39.99,
    newPrice: 22.99,
    freeShipping: false,
  },
  {
    id: 2,
    title: "Jaqueta Sarja Cambos Cropped Manga Buffante",
    url: "./assets/img/products/product7.png",
    descount: 23,
    ranking: 3.5,
    oldPrice: 181.99,
    newPrice: 128.99,
    freeShipping: true,
  },
  {
    id: 3,
    title: "Camiseta Hering Básica Golva V Feminina",
    url: "./assets/img/products/product8.png",
    descount: 38,
    ranking: 3.5,
    oldPrice: 54.99,
    newPrice: 30.99,
    freeShipping: false,
  },
  {
    id: 4,
    title: "Kit Camiseta Vista Magalu Gola V 5 Peças",
    url: "./assets/img/products/product9.png",
    descount: 15,
    ranking: 3.5,
    oldPrice: 159.99,
    newPrice: 149.99,
    freeShipping: false,
  },
  {
    id: 5,
    title: "Camisa Milano Manga Longa Masculina",
    url: "./assets/img/products/product10.png",
    descount: 20,
    ranking: 3.5,
    oldPrice: 99.99,
    newPrice: 79.99,
    freeShipping: true,
  },
  {
    id: 6,
    title:
      "Calça Jeans Havicssen Rasgada Masculina com 4 bolsos, costura dupla",
    url: "./assets/img/products/product1.png",
    descount: 42,
    ranking: 3.5,
    oldPrice: 99.99,
    newPrice: 69.99,
    freeShipping: false,
  },
];

const carregarCardsCarousel = (products, idContainerCards) => {
  let cards = products.map(criarCardCarousel);
  console.log(cards);
  document.getElementById(idContainerCards).replaceChildren(...cards);
};

const criarCardCarousel = (product) => {
  const card = document.createElement("div");
  card.classList.add("card");

  const shortTitle = product.title.trim().slice(0, 40).trim();

  card.innerHTML = `
      <!-- Card Image -->
      <div class="card-image">
        <!-- Card Descount -->
        <div class="card-descount ${
          product.descount !== null ? "visible" : ""
        }">
          <span>-${product.descount}%</span>
        </div>
        <!-- Card Descount -->

        <img src="${product.url}" alt="${shortTitle}" />
      </div>
      <!-- // Card Image -->

      <!-- Card Details -->
      <div class="card-details">
        <!-- Card Details Title -->
        <div class="card-details-title">
          <a href="#">${shortTitle}...</a>
        </div>
        <!-- // Card Details Title -->

        <!-- Card Details Ranking -->
        <div class="card-details-ranking ${
          product.ranking !== null ? "visible" : ""
        }">
          ${rankingStars(product.ranking)}
        </div>
        <!-- // Card Details Ranking -->

        <!-- Card Old Price -->
        <div class="card-details-old-price ${
          product.oldPrice !== null ? "visible" : ""
        }">
          <span>R$${product.oldPrice}</span>
        </div>
        <!-- // Card Old Price -->

        <!-- Card New Price -->
        <div class="card-details-new-price">
          <span>R$${product.newPrice}</span>
        </div>
        <!-- // Card New Price -->

        <!-- Card Free Shipping -->
        <div class="card-details-free-shipping ${
          product.freeShipping ? "visible" : ""
        }">
          <div>
            <span>frete grátis</span>
          </div>
        </div>
        <!-- // Card Free Shipping -->
      </div>
      <!-- //Card Details -->  
    
    `;

  return card;
};

let rankingStars = (ranking) => {
  let stringRanking = ranking.toString().split(".");
  console.log(stringRanking);
  let integerRanking = parseInt(stringRanking[0]);
  console.log(integerRanking);

  let starF =
    '<img src="assets/img/icons/estrela-favorito-social-cheio.png" alt=""/>'.repeat(
      integerRanking
    );

  let max = integerRanking <= 4 && stringRanking[1] !== undefined ? 4 : 5;
  let star =
    '<img src="assets/img/icons/estrela-favorito-social-vazio.png" alt="">'.repeat(
      max - integerRanking
    );

  let starM = "";

  if (stringRanking[1] !== undefined)
    starM =
      '<img src="assets/img/icons/estrela-favorito-social-meio-cheio.png" alt=""/>';

  let accumulator = starF + starM + star;
  console.log(accumulator);
  return accumulator;
};

const carouselCards = (
  idBtnPrevius,
  idBtnNext,
  idContainerCards,
  idFirstCard
) => {
  // Variáveis de ambiente
  let current = 0;

  // Resgatando elementos HTML
  const btnPrevius = document.getElementById(idBtnPrevius);
  const btnNext = document.getElementById(idBtnNext);

  const containerCards = document.getElementById(idContainerCards);

  const countCards = containerCards.children;
  console.log(countCards);
  countCards[0].id = idFirstCard;

  // Verificando se deve exibir os controls ou não
  if (countCards.length > 5) {
    btnPrevius.classList.add("visible");
    btnNext.classList.add("visible");
  }

  // Funções para btnPrevius e btnNext
  const changeCards = () => {
    const firstCard = document.getElementById(idFirstCard);

    if (current >= countCards.length / 5) current = 0;
    else if (current < 0) current = countCards.length / 5 - 1;

    let newMargin = 1300 * current;
    firstCard.style.marginLeft = `-${newMargin}px`;
  };

  const cardPrevius = () => {
    current--;
    changeCards();
  };

  const cardNext = () => {
    current++;
    changeCards();
  };

  // Adicionando ação aos botões Previus e Next
  btnPrevius.addEventListener("click", cardPrevius);
  btnNext.addEventListener("click", cardNext);
};

// Iniciando o carousel Destaques
carregarCardsCarousel(
  bd_carousel_products_destaques,
  "destaques-carousel-cards-container"
);
carouselCards(
  "destaques-carousel-cards-controls-previus",
  "destaques-carousel-cards-controls-next",
  "destaques-carousel-cards-container",
  "destaques-carousel-cards-card-first-card"
);

// Iniciando o carousel de Promoções
carregarCardsCarousel(
  bd_carousel_products_promocoes,
  "promocoes-carousel-cards-container"
);
carouselCards(
  "promocoes-carousel-cards-controls-previus",
  "promocoes-carousel-cards-controls-next",
  "promocoes-carousel-cards-container",
  "promocoes-carousel-cards-card-first-card"
);
