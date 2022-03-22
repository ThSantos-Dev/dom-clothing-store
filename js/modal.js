"use strict";
import { bd_produtos } from "./db.js";
import { rankingStars } from "./carousel-product.js";

const containerTotalView = document.createElement("div");

// Função que adiciona click em cada imagem da lista
const changeMain = () => {
  const imgMain = document.querySelector(".modal-container-main-image img");
  const allImgList = document.querySelectorAll(
    ".modal-container-imgs > .modal-list-img"
  );

  allImgList.forEach((div) => {
    div.addEventListener("click", () => {
      let img = div.children[0];
      imgMain.src = img.src;
    });
  });
};

const deliveryTimeReturn = async () => {
  let isCEP = (cep) => (/^[0-9]{8}$/).test(cep);

  const btnChangeCep = document.getElementById("changeCep");
  const cep = document.getElementById("inputCep");

  if(isCEP(cep.value.toString())) {
    
    let data = await searchCEP(cep.value.toString());
    if (data.erro) alert("ERRO!\nO CEP informado não existe!");
    else {
      const containerDeliveryReturn = document.getElementById("cepReturn");
      const containerAddres = document.querySelector(
        "#modal-delivery-content-addres"
      );
      const containerDeliveryTime = document.getElementById(
        "modal-delivery-content-deliveryTime"
      );

      containerDeliveryReturn.classList.add("active");
      btnChangeCep.addEventListener("click", () => {
        containerDeliveryReturn.classList.remove("active");
      });
      containerAddres.innerHTML = `<span>${data.logradouro} - ${data.bairro} - ${data.uf}</span>`;
    }
  } else {
    alert("ERRO! \nVerifique se o CEP foi inserido corretamente, não é permitido caracteres NÃO NUMÉRICOS.\nO CEP deve possuir exatamente 8 digítos.")
  }
};

// Função responsável por buscar CEP na API VIACEP
const searchCEP = async (cep) => {
  let url = `https://viacep.com.br/ws/${cep}/json/`;
  let response = await fetch(url);

  let dados = await response.json();
  return dados;
};

//   Função que fecha o modal
const closeModal = () => {
  containerTotalView.classList.remove("active");
  document.querySelector('header')
    .classList.add('active')
};

const criarModal = (idProduct) => {
  const bd = bd_produtos;
  const id = idProduct.split("-")[1];

  containerTotalView.id = "container-total-view";
  document.querySelector('header')
    .classList.remove('active')

  const product = bd.filter((product) => {
    if (product.id == id) return true;
    else return false;
  });

  const dados = product[0];

  containerTotalView.innerHTML = `
  <div class="modal" id="modal">
  <!-- Imagem que representa o botão de "fechar" -->
  <div class="close-modal" id="close-modal">
    <img src="assets/img/icons/close.png" alt="" />
  </div>
  <!-- // Imagem que representa o botão de "fechar" -->

  <!-- Container Image List -->
  <div class="modal-container-img-list">
    <!-- Container Images -->
    <div class="modal-container-imgs">
      <div class="modal-list-img">
        <img src="${dados.url}" alt="" />
      </div>
      <div class="modal-list-img">
        <img src="assets/img/products/product2.png" alt="" />
      </div>
      <div class="modal-list-img">
        <img src="assets/img/products/product3.png" alt="" />
      </div>
      <div class="modal-list-img">
        <img src="assets/img/products/product4.png" alt="" />
      </div>
    </div>
    <!-- // Container Images -->
  </div>
  <!-- // Container Image List -->

  <!-- Container Main Image -->
  <div class="modal-container-main-image">
    <img src="${dados.url}" alt="" />

    <!-- Descount -->
    <div class="modal-main-image-descount ${dados.descount ? 'visible' : ''}">
      <span>-${dados.descount}%</span>
    </div>
    <!-- // Descount -->
  </div>
  <!-- // Container Main Image -->

  <!-- Container Content -->
  <div class="modal-container-content">
    <!-- Title -->
    <div class="modal-content-title">
      <h1>
        ${dados.title}
      </h1>
    </div>
    <!-- // Title -->

    <!-- Ranking -->
    <div class="modal-content-ranking">
      ${rankingStars(dados.ranking)}
    </div>
    <!-- // Ranking -->

    <!-- Free Shipping -->
    <div class="modal-content-freeShipping ${
      dados.freeShipping ? "visible" : null
    }">
      <span>frete grátis</span>
    </div>
    <!-- // Free Shipping -->

    <!-- Old Price -->
    <div class="modal-content-oldPrice ${dados.oldPrice ? "visible" : ''}">
      <span>R$${dados.oldPrice}</span>
    </div>
    <!-- // Old Price -->

    <!-- New Price -->
    <div class="modal-content-newPrice">
      <span>R$${dados.newPrice}</span>
    </div>
    <!-- // New Price -->

    <!-- Select Size -->
    <div class="modal-content-selectSize">
      <label for="sltSize">Selecione um tamanho:</label>
      <select name="sltSize" id="">
        <option value="">P</option>
        <option value="">M</option>
        <option value="">g</option>
        <option value="">gg</option>
      </select>
    </div>
    <!-- // Select Size -->

    <!-- Delivery -->
    <div id="container-delivery">
      <div class="modal-content-delivery-container">
        <!-- Title - Delivery -->
        <div class="modal-delivery-content-title">
          <img src="assets/img/icons/delivery-truck.png" alt="" />

          <span>calcular prazo de entrega</span>
        </div>
        <!-- // Title - Delivery -->

        <!-- Container - Input and Button -->
        <div class="modal-delivery-container-input-button">
          <!-- Input -->
          <div class="modal-delivery-content-input">
            <label for="txtCep">cep</label>
            <input type="number" id="inputCep" placeholder="0000000" />
          </div>
          <!-- // Input -->

          <!-- Button -->
          <div class="modal-delivery-button">
            <button id="btnCalcular">calcular</button>
          </div>
          <!-- // Button -->
        </div>
        <!-- // Container - Input and Button -->
      </div>

      <!-- CEP RETURN -->
      <div class="modal-delivery-cepReturn" id="cepReturn">
        <!-- Title - Delivery -->
        <div class="modal-delivery-content-title">
          <img src="assets/img/icons/delivery-truck.png" alt="" />

          <span>Prazos e valores</span>
        </div>
        <!-- // Title - Delivery -->

        <!-- Addres -->
        <div id="modal-delivery-content-addres">
          <span>Rua das Flores - Centro - Jandira - São Paulo</span>
        </div>
        <!-- // Addres -->

        <!-- Delivery Time -->
        <div id="modal-delivery-content-deliveryTime">
          <span>Entrega em: 2 dias úteis por R$00,00</span>
        </div>
        <!-- // Delivery Time -->

        <!-- Change CEP -->
        <div class="modal-delivery-changeCep" id="changeCep">
          <span>Alterar CEP</span>
        </div>
        <!-- // Change CEP -->
      </div>
      <!-- CEP RETURN -->
    </div>
    <!-- // Delivery -->

    <!-- Buttons -->
    <div class="modal-content-buttons-container">
      <div class="modal-buttons-button">
        <button>adc. a sacola</button>
      </div>

      <div class="modal-buttons-button">
        <button>comprar</button>
      </div>
    </div>
    <!-- // Buttons -->
  </div>
  <!-- // Container Content -->
</div>
<!-- // Modal -->
  `;

  document.getElementById("spacing-body").appendChild(containerTotalView);

  containerTotalView.classList.add("active");

  // Resgatando Elementos do HTML

  const btnCalc = document.getElementById("btnCalcular");
  // Adicionando Click
  btnCalc.addEventListener("click", deliveryTimeReturn);

  const btnClose = document.querySelector("#modal > #close-modal");
  btnClose.addEventListener("click", closeModal);
};

const openModal = () => {
  const cards = document.querySelectorAll('.card')

  cards.forEach(card => {
    card.addEventListener('click', () => {
      criarModal(card.dataset.idProduct)
      changeMain();
    })
  })

}
openModal()
