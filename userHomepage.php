<?php
session_start();
// phpinfo(); // Works correctly
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('server.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Main Page</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="styles.css" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <input type="checkbox" id="cart" />
    <div class="sidebar">
        <div class="sidebar-menu">
            <span class="fas fa-user"></span>
            <a href="#">Profile</a>
        </div>
        <div class="sidebar-menu">
            <label for="cart" class="label-cart"><span class="fas fa-shopping-cart"></span></label>
            <a href="#">Basket</a>
        </div>
        <div class="sidebar-menu">
            <span class="fas fa-user"></span>
            <a href="#">Profile</a>
        </div>
        <div class="sidebar-menu">
            <span class="fas fa-sliders-h"></span>
            <a href="#">Setting</a>
        </div>
    </div>

    <div class="dashboard">
        <div class="dashboard-banner">
            <img src="images/background-wallpaper.png" alt="" />
            <div class="banner-promo">
                <h1>
                    <span>BEST </span>CRUST PIZZA <br />
                    IN TOWN
                </h1>
            </div>
        </div>
        <!-- <div class="dashboard-menu">
        <a href="#">Favourites</a>
        <a href="#">Best Seller</a>
        <a href="#">Near Me</a>
        <a href="#">Promotion</a>
        <a href="#">Top Rated</a>
        <a href="#">All</a>
      </div> -->
        <div class="dashboard-content">
            <?php
          $product_records = mysqli_query($db, "SELECT * FROM product");
          while($row = mysqli_fetch_array($product_records)) {
        ?>
            <div class="dashboard-card">
                <img src="images/<?php echo $row['product_image']; ?>" alt="" class="card-image" />
                <div class="card-detail">
                    <h3><?php echo $row['product_name']; ?></h3>
                    <br />
                    <p><?php echo $row['product_description']; ?></p>
                    <br />
                    <button
                        onclick="location.href='server.php?product_id=<?php echo $row['product_id']; ?>&customer_id=1'">Order</button>
                </div>
            </div>
            <?php
          }
        ?>
        </div>
    </div>
    <div class="dashboard-order">
        <h3>Order Menu</h3>
        <div class="order-address">
            <br />
            <p>Pickup Delivery</p>
            <br />
            <h4>221 B Baker Street, Malaysia</h4>
        </div>
        <div class="order-time">
            <br />
            <span class="fas fa-clock"></span> 30 mins
        </div>

        <div class="order-wrapper">
            <?php
          $cart_records = mysqli_query($db, "SELECT cart.*, product.product_name, product.product_image FROM cart INNER JOIN product ON cart.product_id = product.product_id");
          while($row = mysqli_fetch_array($cart_records)) {
        ?>
            <div class="order-card">
                <img src="images/<?php echo $row['product_image']; ?>" alt="" class="order-image" />
                <div class="order-detail">
                    <p><?php echo $row['product_name']; ?></p>
                    <i class="fas fa-times"></i><input type="text" value="<?php echo $row['cart_quantity']; ?>" />
                </div>
                <h4 class="order-price">$35</h4>
            </div>
            <?php
          }
        ?>
        </div>
        <hr class="divider" />
        <div class="order-total">
            <p>Subtotal <span>$15.6</span></p>
            <p>Tax (10%) <span>$15.6</span></p>
            <p>Delivery Fee <span>$3</span></p>

            <hr class="divider" />
            <br />
            <p>Total <span>$174.6 </span></p>
            <br />
        </div>
        <button class="checkout">Checkout</button>
    </div>

    <script src="" async defer></script>
</body>

</html>