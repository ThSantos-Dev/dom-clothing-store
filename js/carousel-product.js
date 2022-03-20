/*************************************************************
 * Objetivo: Arquivo de funções para Carousel de Produtos
 * Autor: Thales Santos
 * Data: 12/03/2022
 * Versão: 1.0
 ************************************************************/
"use strict";

import {bd_carousel_products_destaques, bd_carousel_products_promocoes, bd_produtos} from "./db.js"

// Funções
const carregarCardsCarousel = (products, idContainerCards) => {
  let cards = products.map(criarCardCarousel);
  document.getElementById(idContainerCards).replaceChildren(...cards);
};

const criarCardCarousel = (product) => {
  const card = document.createElement("div");
  card.classList.add("card");
  card.setAttribute('data-id-product', `product-${product.id}`);

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
        <div class="card-details-title" >
          <span>${shortTitle}...</span>
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

export const rankingStars = (ranking) => {
  let stringRanking = ranking.toString().split(".");
  let integerRanking = parseInt(stringRanking[0]);

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

// Carregando cards na section Moda
carregarCardsCarousel(bd_produtos, 'container-moda-produtos')

