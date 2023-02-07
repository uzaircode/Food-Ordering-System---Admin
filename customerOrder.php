<?php
session_start();
include('server.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);


$customer_id = $_SESSION['customer_id'];
echo $customer_id;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animated Step Progress Bar</title>
    <link rel="icon" type="image/x-icon" href="images/pizza_icon.png">
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>" />
    <!-- <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>" /> -->

    <!-- UniIcon CDN Link  -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>

<body>
    <div class="dashboard-wrapper">
        <div class="sidebar">
            <div class="sidebar-menu">
                <span class="fas fa-user"></span>
                <a href="userHomepage.php">Profile</a>
            </div>
            <div class="sidebar-menu">
                <label for="cart" class="label-cart">
                    <span class="fas fa-shopping-cart"></span>
                </label>
                <a href="#">Basket</a>
            </div>
            <div class="sidebar-menu">
                <span class="fas fa-user"></span>
                <a href="customerProfile.php">Profile</a>
            </div>
            <div class="sidebar-menu">
                <span class="fas fa-sliders-h"></span>
                <a href="#">Setting</a>
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
            <div class="dashboard-content">
                <div class="progress-main">
                    <h1>tracking</h1>
                    <ul>
                        <li>
                            <i class="icon uil uil-capture"></i>
                            <div class="progress one">
                                <p>1</p>
                                <i class="uil uil-check"></i>
                            </div>
                            <p class="text">Add To Cart</p>
                        </li>
                        <li>
                            <i class="icon uil uil-clipboard-notes"></i>
                            <div class="progress two">
                                <p>2</p>
                                <i class="uil uil-check"></i>
                            </div>
                            <p class="text">Fill Details</p>
                        </li>
                        <li>
                            <i class="icon uil uil-credit-card"></i>
                            <div class="progress three">
                                <p>3</p>
                                <i class="uil uil-check"></i>
                            </div>
                            <p class="text">Make Payment</p>
                        </li>
                        <li>
                            <i class="icon uil uil-exchange"></i>
                            <div class="progress four">
                                <p>4</p>
                                <i class="uil uil-check"></i>
                            </div>
                            <p class="text">Order in Progress</p>
                        </li>
                        <li>
                            <i class="icon uil uil-map-marker"></i>
                            <div class="progress five">
                                <p>5</p>
                                <i class="uil uil-check"></i>
                            </div>
                            <p class="text">Order Arrived</p>
                        </li>
                    </ul>
                    <main>
                        <br>
                        <h1>Recent Orders</h1>
                        <div class="recent-table-list">
                            <div class="recent-table-list-title-section">
                            </div>
                            <table>
                                <thread>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        <th>Status</th>
                                    </tr>
                                </thread>
                                <!-- <tbody>
                        <tr>
                            <td>#18402</td>
                            <td>Mr. Raan</td>
                            <td class="success">PAID</td>
                        </tr>
                    </tbody> -->
                                <tbody>
                                    <?php while($row = mysqli_fetch_array($order_records)) { ?>
                                    <tr>
                                        <td>#<?php echo $row['order_id']; ?></td>
                                        <td><?php echo $row['customer_name']; ?></td>
                                        <td class="success">PAID</td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </main>
                </div>
            </div>
        </div>

        <input type="checkbox" id="cart" />

    </div>
    <script src="index.js"></script>
</body>

</html>