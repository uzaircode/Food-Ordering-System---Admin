<?php
session_start();
include('server.php');
$customer_id = $_SESSION['customer_id'];
echo $customer_id;
$query = "SELECT * FROM payment_method WHERE customer_id='$customer_id'";
$results = mysqli_query($db, $query);

if (mysqli_num_rows($results) > 0) {
  while ($row = mysqli_fetch_assoc($results)) {
    // access each payment method information
    $card_id = $row['card_id'];
    $card_name = $row['card_name'];
    $card_number = $row['card_number'];
    $card_expired_month = $row['card_expired_month'];
    $card_expired_year = $row['card_expired_year'];
    $card_cvv = $row['card_cvv'];
    // do something with the payment method information
  }
}

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
                <div class="dashboard-menu">
                    <a href="customerProfile.php">Manage Profile</a>
                    <a href="customerOrder.php">My Orders</a>
                    <a href="#">My Payment Methods</a>
                </div>
            </div>
            <div class="dashboard-content-profile">
                <div class="recent-table-list profile-content">
                    <h1>Manage Payment method</h1>

                    <div class="recent-table-list-title-section">
                        <div class="recent-table-list-title-section-right">
                        </div>
                    </div>
                    <div class="container-login">
                        <form method="post" action="server.php">
                            <input type="hidden" name="card_id" value="<?php echo $card_id; ?>">
                            <div class="form-group">
                                <p>Card Name</p>
                                <input type="text" name="customer_name"
                                    value="<?php echo $_SESSION['customer_name']; ?>">
                            </div>
                            <br />
                            <div class="form-group">
                                <p>Card Number</p>
                                <input type="text" name="card_number" value="<?php echo $card_number; ?>">
                            </div>
                            <br />
                            <div class="form-group">
                                <p>Card Expired Month</p>
                                <input type="text" name="card_expired_month" value="<?php echo $card_expired_month; ?>">
                            </div>
                            <br>
                            <div class="form-group">
                                <p>Card Expired Year</p>
                                <input type="text" name="card_expired_year" value="<?php echo $card_expired_year; ?>">
                            </div>
                            <br>
                            <br>
                            <div class="form-group">
                                <p>Card CVV</p>
                                <input type="password" name="card_cvv" value="<?php echo $card_cvv; ?>">
                            </div>
                            <div>
                                <button class="button-login" input type="submit" name="customerPaymentUpdate">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <input type="checkbox" id="cart" />

    </div>
    <script src="index.js"></script>
</body>


</html>