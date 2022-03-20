"use strict";

// Resgando checkbox
const countFilters = document.getElementById('quantidade-filtros')
const btnLimparFiltros = document.getElementById("limpar-filtros");
const chks = document.querySelectorAll(".filtro-chk > input");
const containerFiltros = document.querySelector(
  ".container-moda-filtros-selecionados-filtros"
);
console.log(chks[0]);

const atualizaContagem = () => {
    const count = containerFiltros.childElementCount
    
    if(count > 0) {
        btnLimparFiltros.style.display = "block"
        countFilters.textContent = `Filtros selecionados(${count})`
    }
    else {
        btnLimparFiltros.style.display = "none"
        countFilters.textContent = `Filtros`
    }
}

const adicionarFiltro = () => {
  chks.forEach((chk) => {
    chk.addEventListener("click", () => {
      if (chk.checked) {
        const filterDiv = document.createElement("div");
        filterDiv.classList.add("filtro-selecionado");
        filterDiv.id = `filter-${chk.id}`;

        filterDiv.innerHTML = `
                    <span>${chk.value}</span>

                    <img src="./assets/img/icons/close.png" alt="" data-filter-id="${chk.id}"/>
        `;

        containerFiltros.appendChild(filterDiv);

        const divChk = document.getElementById(`filter-${chk.id}`);
        divChk.lastElementChild.addEventListener("click", () => {
          divChk.parentNode.removeChild(divChk);
          chk.checked = false;
          atualizaContagem()
        });
        atualizaContagem()
      } else {
        const divChk = document.getElementById(`filter-${chk.id}`);

        if (divChk) {
          divChk.parentNode.removeChild(divChk);
          chk.checked = false;
          atualizaContagem()
        }
      }
    });
  });
};

adicionarFiltro();
btnLimparFiltros.addEventListener("click", () => {
  // Removendo todos os nós filhos de um elemento
  while (containerFiltros.firstChild) {
    containerFiltros.removeChild(containerFiltros.firstChild);
  }

  chks.forEach(chk => {
      chk.checked = false
  })
  btnLimparFiltros.style.display = "none"
  atualizaContagem()
});
