<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
// phpinfo(); // Works correctly
ini_set('display_errors', 1);
include('server.php');

$customer_id = $_SESSION['customer_id'];


echo $customer_id;
// echo $customer_email;


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="icon" type="image/x-icon" href="images/pizza_icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    body {
        font-family: Arial;
        font-size: 17px;
        padding: 8px;
    }

    * {
        box-sizing: border-box;
    }

    .row {
        display: -ms-flexbox;
        /* IE10 */
        display: flex;
        -ms-flex-wrap: wrap;
        /* IE10 */
        flex-wrap: wrap;
        margin: 0 -16px;
    }

    .col-25 {
        -ms-flex: 25%;
        /* IE10 */
        flex: 25%;

    }

    .col-50 {
        -ms-flex: 50%;
        /* IE10 */
        flex: 50%;
    }

    .col-75 {
        -ms-flex: 75%;
        /* IE10 */
        flex: 75%;
    }

    .col-25,
    .col-50,
    .col-75 {
        padding: 0 16px;
    }

    .container {
        background-color: #f2f2f2;
        padding: 5px 20px 15px 20px;
        border: 1px solid lightgrey;
        border-radius: 3px;
    }

    input[type=text] {
        width: 100%;
        margin-bottom: 20px;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    label {
        margin-bottom: 10px;
        display: block;
    }

    .icon-container {
        margin-bottom: 20px;
        padding: 7px 0;
        font-size: 24px;
    }

    .btn {
        background-color: #04AA6D;
        color: white;
        padding: 12px;
        margin: 10px 0;
        border: none;
        width: 100%;
        border-radius: 3px;
        cursor: pointer;
        font-size: 17px;
    }

    .btn:hover {
        background-color: #45a049;
    }

    a {
        color: #2196F3;
    }

    hr {
        border: 1px solid lightgrey;
    }

    span.price {
        float: right;
        color: grey;
    }

    /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
    @media (max-width: 800px) {
        .row {
            flex-direction: column-reverse;
        }

        .col-25 {
            margin-bottom: 20px;
        }
    }
    </style>
</head>

<body>

    <h2>Responsive Checkout Form</h2>
    <p>Resize the browser window to see the effect. When the screen is less than 800px wide, make the two columns stack
        on top of each other instead of next to each other.</p>
    <div class="row">
        <div class="col-75">
            <div class="container">
                <form method="post" action="server.php">
                    <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
                    <div class="row">
                        <div class="col-50">
                            <h3>Payment</h3>
                            <label for="fname">Accepted Cards</label>
                            <div class="icon-container">
                                <i class="fa fa-cc-visa" style="color:navy;"></i>
                                <i class="fa fa-cc-amex" style="color:blue;"></i>
                                <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                <i class="fa fa-cc-discover" style="color:orange;"></i>
                            </div>
                            <label for="cname">Name on Card</label>
                            <input type="text" id="cname" name="card_name" placeholder="John More Doe"
                                value="<?php echo (!empty($_SESSION['card_name'])) ? $_SESSION['card_name'] : ''; ?>"
                                <?php echo (empty($_SESSION['card_name'])) ? '' : 'disabled'; ?>>
                            <label for="ccnum">Credit card number</label>
                            <input type="text" id="ccnum" name="card_number" placeholder="1111-2222-3333-4444"
                                value="<?php echo (!empty($_SESSION['card_number'])) ? $_SESSION['card_number'] : ''; ?>">
                            <label for="expmonth">Exp Month</label>
                            <input type="text" id="expmonth" name="card_expired_month" placeholder="September"
                                value="<?php echo (!empty($_SESSION['card_expired_month'])) ? $_SESSION['card_expired_month'] : ''; ?>">
                            <div class="row">
                                <div class="col-50">
                                    <label for="expyear">Exp Year</label>
                                    <input type="text" id="expyear" name="card_expired_year" placeholder="2018"
                                        value="<?php echo (!empty($_SESSION['card_expired_year'])) ? $_SESSION['card_expired_year'] : ''; ?>">
                                </div>
                                <div class="col-50">
                                    <label for="cvv">CVV</label>
                                    <input type="text" id="cvv" name="card_cvv" placeholder="352"
                                        value="<?php echo (!empty($_SESSION['card_cvv'])) ? $_SESSION['card_cvv'] : ''; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <label>
                        <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
                    </label>
                    <input type="hidden" name="form_submitted" value="1">
                    <button onclick="location.href='server.php'" name="customerCardSave">Order now</button>
                </form>
            </div>
        </div>
        <div class=" col-25">
            <div class="container">
                <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i>
                        <b>4</b></span>
                </h4>
                <?php
          $cart_records = mysqli_query($db, "SELECT cart_item.*, product.product_name, product.product_image, product.product_price FROM cart_item INNER JOIN product ON cart_item.product_id = product.product_id WHERE cart_item.customer_id = '$customer_id'");
                while ($row = mysqli_fetch_array($cart_records)) {
            ?>
                <p><a href="#"><?php echo $row['product_name']; ?></a> <span
                        class="price"><?php echo $row['product_price']; ?></span></p>
                <?php
            }
            ?>
                <hr>
                <p>Total <span class="price" style="color:black"><b>$30</b></span></p>
            </div>
        </div>

    </div>

</body>

</html>