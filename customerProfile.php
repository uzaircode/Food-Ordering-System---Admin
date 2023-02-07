<?php
session_start();
include('server.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);


if (isset($_GET['edit'])) {
$query = "SELECT * FROM customer WHERE customer_id=$customer_id";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($result);
$customer_name = $row['customer_name'];
$customer_email = $row['customer_email'];
$customer_phone = $row['customer_phone'];
$customer_password = $row['customer_password'];
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
                <img src="images/profile_icon.png" width="95" height="75" />
                <a href="customerProfile.php">Profile</a>
            </div>
            <div class="sidebar-menu">
                <label for="cart" class="label-cart" id="label-cart">
                    <img src="images/cart_icon.png" width="85" height="60" />
                </label>
                <a href="#">Basket</a>
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
                    <a href="customerPaymentMethod.php">My Payment Methods</a>
                </div>
            </div>
            <div class="dashboard-content-profile">
                <div class="recent-table-list profile-content">
                    <h1>My Profile</h1>
                    <div class="recent-table-list-title-section">
                        <div class="recent-table-list-title-section-right">
                        </div>
                    </div>
                    <div class="container-login">
                        <form method="post" action="server.php">
                            <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
                            <div class="form-group">
                                <p>Name</p>
                                <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                            </div>
                            <br />
                            <div class="form-group">
                                <p>Email</p>
                                <input type="email" name="customer_email" value="<?php echo $customer_email; ?>">
                            </div>
                            <br />
                            <div class="form-group">
                                <p>Contact Number</p>
                                <input type="text" name="customer_phone" value="<?php echo $customer_phone; ?>">
                            </div>
                            <br>
                            <div class="form-group">
                                <p>Password</p>
                                <input type="password" name="customer_password"
                                    value="<?php echo $customer_password; ?>">
                            </div>
                            <br>
                            <div>
                                <button class="button-login" input type="submit" name="customerUpdate">
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