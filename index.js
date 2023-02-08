const sideMenu = document.querySelector("closeCart");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");
const themeToggler = document.querySelector(".theme-toggler");

const labelCart = document.querySelector(".label-cart");

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
    sideMenu.style.display = "none";
  });
});

document.addEventListener("DOMContentLoaded", function () {
  closeBtn.addEventListener("click", () => {
    sideMenu.style.display = "none";
  });
});

if (labelCart) {
  labelCart.addEventListener("click", function () {
    const dashboardOrder = document.querySelector(".dashboard-order");
    if (dashboardOrder.style.display === "none") {
      dashboardOrder.style.display = "block";
    } else {
      dashboardOrder.style.display = "none";
    }
  });
}

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

function removeFromCart(productId, customerId) {
  $.ajax({
    type: "POST",
    url: "server.php",
    data: {
      product_id: productId,
      customer_id: customerId,
      action_id: "delete_from_cart",
    },
    success: function (data) {
      console.log("Data received: ", data);
      if (data == "success") {
        $("#remove_" + productId)
          .closest(".order-wrapper")
          .remove();

        // retrieve updated cart items
        $.ajax({
          type: "GET",
          url: "server.php",
          data: {
            customer_id: customerId,
          },
          success: function (data) {
            // update cart container with returned data
            $(".order-wrapper").load(location.href + " .order-wrapper");
          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.error("AJAX error: ", errorThrown);
            alert("Something went wrong, please try again.");
          },
        });
      } else {
        console.error("Something went wrong: ", data);
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.error("AJAX error: ", errorThrown);
      alert("Something went wrong, please try again.");
    },
  });
}

function addToCart(customerId, sessionId, productId) {
  $.ajax({
    type: "POST",
    url: "server.php",
    data: {
      customer_id: customerId,
      session_id: sessionId,
      product_id: productId,
      action_id: "add_to_cart",
    },
    success: function (data) {
      console.log("Data sent: ", {
        customer_id: customerId,
        session_id: sessionId,
        product_id: productId,
        action_id: "add_to_cart",
      });
      console.log("Data received: ", data);
      // alert("Item added to cart successfully!");
      // refresh the order-card div
      $(".order-wrapper").load(location.href + " .order-wrapper");
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.error("AJAX error: ", errorThrown);
      alert("Something went wrong, please try again.");
    },
  });
}

$("#search-button").click(function () {
  var searchTerm = $("#search-input").val();

  $.ajax({
    type: "POST",
    url: "search.php",
    data: { searchTerm: searchTerm },
    success: function (response) {
      $("#result").html(response);
    },
  });
});

function handleCheckboxClick() {
  const checkbox = document.querySelector('input[type="checkbox"]');
  const inputs = document.querySelectorAll('input[type="text"]');
  checkbox.addEventListener("click", function () {
    inputs.forEach(function (input) {
      input.disabled = checkbox.checked;
    });
  });
}

window.addEventListener("load", handleCheckboxClick);

$(document).ready(function () {
  $('input[type="checkbox"]').click(function () {
    if (this.checked) {
      $('input[type="text"]').prop("disabled", true);
    } else {
      $('input[type="text"]').prop("disabled", false);
    }
  });
});
