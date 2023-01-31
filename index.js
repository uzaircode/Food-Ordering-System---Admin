const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");
const themeToggler = document.querySelector(".theme-toggler");

menuBtn.addEventListener("click", () => {
  sideMenu.style.display = "block";
});

closeBtn.addEventListener("click", () => {
  sideMenu.style.display = "none";
});

themeToggler.addEventListener("click", () => {
  document.body.classList.toggle("dark-theme-variables");
  localStorage.setItem("toggled", "true");

  //   themeToggler.querySelector("span").classList.toggle("active");
  themeToggler.querySelector("span:nth-child(1)").classList.toggle("active");
  themeToggler.querySelector("span:nth-child(2)").classList.toggle("active");
});

Orders.forEach((order) => {
  const tr = document.createElement("tr");
  const trContent = `
                        <td>
                         <div class="profile-photo recent-orders-center">
                        <img src="${order.productImage}">
                        </div>
                        </td>
                        <td>${order.productName}</td>
                        <td>${order.productNumber}</td>
                        <td>${order.paymentStatus}</td>
                        <td class="primary"><span class="material-symbols-outlined" style="font-size: 1.3rem">edit_square</span></td>
                        `;
  //                         <td class="${
  //   order.shipping === "Declined"
  //     ? "danger"
  //     : order.shipping === "pending"
  //     ? "warning"
  //     : "primary"
  // }">${order.shipping}</td>
  tr.innerHTML = trContent;
  document.querySelector("table tbody").appendChild(tr);
});
