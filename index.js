const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");
const themeToggler = document.querySelector(".theme-toggler");

const input = document.getElementById("upload");
const text = document.getElementById("text");
const btn = document.getElementById("upload-btn");

const deleteModal = document.getElementById("deleteModal");
const yesBtn = document.getElementById("yesBtn");
const productId = null;

document.addEventListener("DOMContentLoaded", function () {
  input.addEventListener("change", () => {
    const path = input.value.split("\\");
    const filename = path[path.length - 1];

    text.innerText = filename ? filename : "Product image";

    if (filename) btn.classList.add("chosen");
    else btn.classList.remove("chosen");
  });
});

document.addEventListener("DOMContentLoaded", function () {
  menuBtn.addEventListener("click", () => {
    sideMenu.style.display = "block";
  });
});

document.addEventListener("DOMContentLoaded", function () {
  closeBtn.addEventListener("click", () => {
    sideMenu.style.display = "none";
  });
});

const lightModeSpan = themeToggler.querySelector("span:nth-child(1)");
const darkModeSpan = themeToggler.querySelector("span:nth-child(2)");

const theme = localStorage.getItem("theme");

if (theme === "dark") {
  document.body.classList.add("dark-theme-variables");
  lightModeSpan.classList.remove("active");
  darkModeSpan.classList.add("active");
}

document.addEventListener("DOMContentLoaded", function () {
  themeToggler.addEventListener("click", () => {
    const themeToggler = document.querySelector(".theme-toggler");
    if (document.body.classList.contains("dark-theme-variables")) {
      document.body.classList.remove("dark-theme-variables");
      lightModeSpan.classList.add("active");
      darkModeSpan.classList.remove("active");
      localStorage.setItem("theme", "light");
    } else {
      document.body.classList.add("dark-theme-variables");
      lightModeSpan.classList.remove("active");
      darkModeSpan.classList.add("active");
      localStorage.setItem("theme", "dark");
    }
  });
});

const minus = document.querySelector(".fas.fa-times");
const quantity = document.querySelector("#quantity");

minus.addEventListener("click", function () {
  if (quantity.value > 0) {
    quantity.value--;
  }
});

// Orders.forEach((order) => {
//   const tr = document.createElement("tr");
//   const trContent = `
//                         <td>
//                          <div class="profile-photo recent-orders-center">
//                         <img src="${order.productImage}">
//                         </div>
//                         </td>
//                         <td>${order.productName}</td>
//                         <td>${order.productNumber}</td>
//                         <td>${order.paymentStatus}</td>
//                         <td class="primary"><span class="material-symbols-outlined" style="font-size: 1.3rem">edit_square</span></td>
//                         `;
//   //                         <td class="${
//   //   order.shipping === "Declined"
//   //     ? "danger"
//   //     : order.shipping === "pending"
//   //     ? "warning"
//   //     : "primary"
//   // }">${order.shipping}</td>
//   tr.innerHTML = trContent;
//   document.querySelector("table tbody").appendChild(tr);
// });
