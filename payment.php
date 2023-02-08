<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);


session_start();
// phpinfo(); // Works correctly
ini_set('display_errors', 1);
include('server.php');

$customer_id = $_SESSION['customer_id'];
$session_id = $_SESSION['session_id'];


// echo $customer_id;
// echo $session_id;



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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
    body {
        font-family: Arial;
        font-size: 17px;
        padding: 8px;
        background-color: #f5f5f5;
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
        background-color: #ffffff;
        padding: 5px 20px 15px 20px;
        border: 3px solid black;
        border-radius: 15px;
    }

    form input[type="text"] {
        border: 2px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
        padding: 10px 12px;
        width: 100%;
        box-sizing: border-box;
        margin-bottom: 20px;
        transition: all 0.3s ease-in-out;
    }

    form input[type="text"]:focus,
    form input[type="email"]:focus,
    form input[type="password"]:focus {
        border-color: black;
        outline: none;
    }

    label {
        margin-bottom: 10px;
        display: block;
    }

    .icon-container {
        margin: 20px 0px;
        padding: 7px 0;
        font-size: 24px;
    }

    .btn {
        background-color: black;
        color: white;
        padding: 12px;
        margin: 10px 0;
        border: none;
        width: 100%;
        border-radius: 20px;
        cursor: pointer;
        font-size: 17px;
        font-weight: bold;
    }

    input .input-cash {
        color: #4b4b4b;
    }

    .btn:hover {
        background-color: #701820;
    }

    a {
        color: #4b4b4b;
        text-decoration: none;
        font-weight: bold;
    }

    hr {
        border: 1px solid lightgrey;
    }

    h4 {
        font-size: 1.3rem;
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

    input[type="checkbox"] {}

    label {
        color: #4b4b4b;
    }
    </style>
</head>

<body>

    <h2>Payment Form</h2>

    <div class="row">
        <div class="col-75">
            <div class="container">
                <form method="post">
                    <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
                    <input type="hidden" name="cart_id" value="<?php echo $cart_id; ?>">
                    <div class="row">
                        <div class="col-50">
                            <div class="icon-container">
                                <i class="fa fa-cc-visa" style="color:navy;"></i>
                                <i class="fa fa-cc-amex" style="color:blue;"></i>
                                <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                <i class="fa fa-cc-discover" style="color:orange;"></i>
                            </div>
                            <label for="cname">Customer Email</label>
                            <input type="text" name="customer_email" value="<?php echo $_SESSION['customer_email']; ?>"
                                disabled>
                            <label for="cname">Customer Name</label>
                            <input type="text" name="name_phone" value="<?php echo $_SESSION['customer_name']; ?>"
                                disabled>
                            <label for="cname">Customer Phone Number</label>
                            <input type="text" name="customer_phone" value="<?php echo $_SESSION['customer_phone']; ?>"
                                disabled>
                            <hr>
                            <br>
                            <label for="cname">Name on Card</label>
                            <input type="text" id="cname" name="card_name" placeholder="John Doe"
                                value="<?php echo (!empty($_SESSION['card_name'])) ? $_SESSION['card_name'] : ''; ?>"
                                <?php echo (empty($_SESSION['card_name'])) ? '' : 'disabled'; ?>>
                            <label for="ccnum">Credit card number</label>
                            <input type="text" id="ccnum" name="card_number" placeholder="1111-2222-3333-4444"
                                value="<?php echo (!empty($_SESSION['card_number'])) ? $_SESSION['card_number'] : ''; ?>">
                            <label for="expmonth">Expired Month</label>
                            <input type="text" id="expmonth" name="card_expired_month" placeholder="September"
                                value="<?php echo (!empty($_SESSION['card_expired_month'])) ? $_SESSION['card_expired_month'] : ''; ?>">
                            <div class="row">
                                <div class="col-50">
                                    <label for="expyear">Expired Year</label>
                                    <input type="text" id="expyear" name="card_expired_year" placeholder="2023"
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
                        <input type="checkbox" name="sameadr"> Pay with cash
                    </label>
                    <input type="hidden" name="form_submitted" value="1">
                    <button class="btn" name="submit">Place your order</button>
                </form>
            </div>
        </div>
        <div class=" col-25">
            <div class="container">
                <h4>Shopping Cart</h4>
                <?php
            $cart = mysqli_query($db, "SELECT * FROM cart WHERE customer_id = '$customer_id' OR session_id = '$session_id'");
            $cart_row = mysqli_fetch_array($cart);
            $cart_id = $cart_row['cart_id'];
            $cart_records = mysqli_query($db, "SELECT cart_items.*, product.product_name, product.product_image, product.product_price FROM cart_items INNER JOIN product ON cart_items.product_id = product.product_id WHERE cart_items.cart_id = '$cart_id'");
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
        <script>
        $(document).ready(function() {
            $('input[type="checkbox"]').click(function() {
                if (this.checked) {
                    $('input[type="text"]').prop('disabled', true).removeAttr('placeholder');
                } else {
                    $('input[type="text"]').prop('disabled', false);
                }
            });
        });
        </script>

    </div>
    <script src="index.js"></script>
</body>

</html>