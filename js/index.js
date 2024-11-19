const btnCart = document.querySelector(".container-cart-icon");
const containerCartProducts = document.querySelector(".container-cart-products");

btnCart.addEventListener("click", () => {
  containerCartProducts.classList.toggle("hidden-cart");
});
document.addEventListener("click", function (e) {
  if (!containerCartProducts.contains(e.target) && !btnCart.contains(e.target)) {
    containerCartProducts.classList.add("hidden-cart");
  }
});

const cartInfo = document.querySelectorAll(".cart-product");
const rowProduct = document.querySelector(".row-product");

const productsList = document.querySelectorAll(".container");

let allProducts = [];

const valorTotal = document.querySelector(".total-pagar");

const countProducts = document.querySelector("#contador-productos");

const cartEmpty = document.querySelector(".cart-empty");
const cartTotal = document.querySelector(".cart-total");

document.addEventListener("click", function (e) {
  if (e.target && e.target.classList.contains("btn")) {
    handleAddToCart(e);
  }
});

function handleAddToCart(e) {
  const product = e.target.closest(".cont-info-descripcion");

  const infoProduct = {
    quantity: 1,
    title: product.querySelector("h3").textContent,
    price: parseInt(
      product.querySelector("p.price").textContent.replace("$", "").replace(/\./g, ""),
      10
    ),
  };

  const exists = allProducts.some((product) => product.title === infoProduct.title);

  if (exists) {
    const products = allProducts.map((product) => {
      if (product.title === infoProduct.title) {
        product.quantity++;
        return product;
      } else {
        return product;
      }
    });
    allProducts = [...products];
  } else {
    allProducts = [...allProducts, infoProduct];
  }

  showHTML();
}

rowProduct.addEventListener("click", (e) => {
  if (e.target.classList.contains("icon-close")) {
    const product = e.target.closest(".cart-product");
    const title = product.querySelector(".titulo-producto-carrito").textContent;

    allProducts = allProducts.filter((product) => product.title !== title);

    showHTML();
  }
});

const showHTML = () => {
  if (!allProducts.length) {
    cartEmpty.classList.remove("hidden");
    rowProduct.classList.add("hidden");
    cartTotal.classList.add("hidden");
  } else {
    cartEmpty.classList.add("hidden");
    rowProduct.classList.remove("hidden");
    cartTotal.classList.remove("hidden");
  }

  rowProduct.innerHTML = "";

  let total = 0;
  let totalOfProducts = 0;

  allProducts.forEach((product) => {
    const containerProduct = document.createElement("div");
    containerProduct.classList.add("cart-product");

    containerProduct.innerHTML = `
      <div class="info-cart-product">
        <span class="cantidad-producto-carrito">${product.quantity}</span>
        <p class="titulo-producto-carrito">${product.title}</p>
        <span class="precio-producto-carrito">$${formatPrice(product.price)}</span>
      </div>
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="icon-close"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M6 18L18 6M6 6l12 12"
        />
      </svg>
    `;

    rowProduct.append(containerProduct);

    total += product.quantity * product.price;
    totalOfProducts += product.quantity;
  });

  valorTotal.innerText = `$${formatPrice(total)}`;
  countProducts.innerText = totalOfProducts;
};

function formatPrice(price) {
  return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

/****************************** Login ********************************/

document.addEventListener("DOMContentLoaded", function () {
  const userActionsToggle = document.getElementById("userActionsToggle");
  const userActions = document.querySelector(".user-actions");

  userActionsToggle.addEventListener("click", function () {
    userActions.classList.toggle("hidden-user-actions");
  });
});
