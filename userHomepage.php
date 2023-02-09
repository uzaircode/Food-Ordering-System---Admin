<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
include('server.php');

$customer_id = $_SESSION['customer_id'];
$customer_name = $_SESSION['customer_id'];
$session_id = $_SESSION['session_id'];
$total = $_SESSION['total'];


echo $total;
echo $customer_id;


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// if(isset($_SESSION['customer_name'])) {
//   echo "Customer name: ".$_SESSION['customer_name'];
// } else {
//   echo "Session variable 'customer_name' is not set.";
// }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Main Page</title>
    <link rel="icon" type="image/x-icon" href="images/pizza_icon.png">
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <input type="checkbox" id="cart" />
    <div class="dashboard-wrapper">
        <div class="sidebar">
            <div class="sidebar-menu">
                <a href="userHomepage.php"><img src="images/company_logo.png" width="145" height="55" /></a>
            </div>
            <hr>
            <div class="sidebar-menu">
                <a href="customerProfile.php">
                    <img src="images/profile_icon.png" width="95" height="75" />
                    <a>Profile</a>
            </div>
            </a>
            <div class="sidebar-menu">
                <label for="cart" class="label-cart" id="label-cart">
                    <img src="images/cart_icon.png" width="85" height="60" />
                </label>
                <a>Basket</a>
            </div>
            <hr>
            <div class="sidebar-menu">
                <label for="cart" class="label-cart" id="label-cart">
                    <img src="images/call_item.png" width="85" height="60" />
                </label>
                <a href="#">+60 175838374</a>
                <a href="#" style="text-decoration: underline;">Call from above</a>
            </div>
            <div class="sidebar-menu">
                <label for="cart" class="label-cart" id="label-cart">
                    <img src="images/open_item.png" width="85" height="60" />
                </label>
                <a href="#">8:00—23:00</a>
            </div>
        </div>
        <div class="dashboard">
            <div class="dashboard-banner">
                <img src="images/background-wallpaper.png" alt="" />
                <div class="banner-promo">
                    <!-- <h1>
                        <span>BEST </span>CRUST PIZZA <br />
                        IN TOWN
                    </h1> -->
                </div>
            </div>
            <form class="search-bar" id="searchbar" method="post">
                <input type="text" name="searchTerm" id="search-input" placeholder="Search Menu">
                <input type="submit" name="search" value="Search">
            </form>
            <div id="result" class="dashboard-content">
                <?php
            if(isset($_POST['search'])) {
                $searchTerm = $_POST['searchTerm'];
                $query = mysqli_query($db, "SELECT * FROM product WHERE product_name LIKE '%$searchTerm%'");
            } else {
                $query = mysqli_query($db, "SELECT * FROM product");
            }
            // Connect to the database
            $db = mysqli_connect('localhost', 'root', '', 'admin_database');

            // Retrieve the products based on the search term
            $product_records = mysqli_query($db, "SELECT * FROM product WHERE product_name LIKE '%$searchTerm%'");

            // Display the products
            while($row = mysqli_fetch_array($product_records)) {
                echo '<div class="dashboard-card">
                <img src="images/' . $row['product_image'] . '" alt="" class="card-image" />
                <div class="card-detail">
                    <h3>' . $row['product_name'] . '</h3>
                    <br />
                    <p>' . $row['product_description'] . '</p>
                    <br />
                    <button class="order-button" onclick="addToCart(' . $customer_id . ', ' . $session_id . ', ' . $row['product_id'] . ')">Order</button>
                </div>
                </div>';
            }
            ?>
            </div>

        </div>
        <div class="dashboard-order" id="closeCart">
            <h3 style="text-align: center;">Shopping Basket</h3>
            <div class="order-wrapper">
                <?php
      $cart = mysqli_query($db, "SELECT * FROM cart WHERE session_id = '$session_id'");
      $cart_row = mysqli_fetch_array($cart);
      $cart_id = $cart_row['cart_id'];
      $cart_records = mysqli_query($db, "SELECT cart_items.*, product.product_name, product.product_image, product.product_price FROM cart_items INNER JOIN product ON cart_items.product_id = product.product_id WHERE cart_items.cart_id = '$cart_id'");

      $total = 0;
      while($row = mysqli_fetch_array($cart_records)) {
        $total += $row['product_price'] * $row['quantity'];
    ?>
                <div class="order-card" id="order-card-<?php echo $row['product_id']; ?>">
                    <img src="images/<?php echo $row['product_image']; ?>" alt="" class="order-image" />
                    <div class="order-detail">
                        <p style="margin-bottom: 5px;"><?php echo $row['product_name']; ?></p>
                        <i id="remove_<?php echo $row['product_id']; ?>" class="fas fa-times"
                            onclick="removeFromCart(<?php echo $customer_id ?>, <?php echo $session_id; ?>, <?php echo $row['product_id']; ?>)"></i>
                        <input type="text" value="<?php echo $row['quantity']; ?>" disabled />
                    </div>
                    <?php echo $row['product_price']; ?>
                </div>
                <?php
      }

    ?>
            </div>
            <hr class="divider" />
            <div class="order-total">
                <p>Subtotal <span>$<?php echo number_format($total, 2); ?></span></p>
                <p>Tax (10%) <span>$<?php echo number_format($total * 0.1, 2); ?></span></p>

                <hr class="divider" />
                <br />
                <p>Total <span id="order-total">$<?php echo number_format($total * 1.1, 2); ?></span></p>
                <br />
                <?php
                $tax_amount = $total * 0.1;
                $total_with_tax = $total + $tax_amount;

                // update the shopping_session table
                $query = "UPDATE shopping_session SET total='$total_with_tax' WHERE customer_id='$customer_id'";
                mysqli_query($db, $query);
                ?>
            </div>
            <button class="checkout" onclick="window.location.href='payment.php'">Checkout</button>
        </div>
    </div>


    <script src="index.js"></script>
</body>

</html>