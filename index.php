<?php
session_start();
// phpinfo(); // Works correctly
ini_set('display_errors', 1);
include('server.php');

// $admin_id = $_SESSION['admin_id'];
// echo $admin_id;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Dashboard</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>" />
</head>

<body>
    <div class="container">
        <aside>
            <div class="sidebar">
                <a href="index.php" class="active">
                    <span class="material-symbols-outlined">dashboard</span>
                    <h3>Dashboard</h3>
                </a>
                <a href="customer.php">
                    <span class="material-symbols-outlined">person</span>
                    <h3>Customers</h3>
                </a>
                <a href="order.php">
                    <span class="material-symbols-outlined">receipt_long</span>
                    <h3>Orders</h3>
                </a>
                <a href="feedback.php">
                    <span class="material-symbols-outlined">auto_awesome</span>
                    <h3>Feedbacks</h3>
                </a>
                <a href="product.php">
                    <span class="material-symbols-outlined">inventory</span>
                    <h3>Products</h3>
                </a>
                <a href="invoice.php">
                    <span class="material-symbols-outlined">receipt</span>
                    <h3>Invoices</h3>
                </a>
                <a href="editProfile.php">
                    <span class="material-symbols-outlined">settings</span>
                    <h3>Settings</h3>
                </a>
                <a href="login.php">
                    <span class="material-symbols-outlined">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>

        <main>
            <h1>Dashboard</h1>
            <div class="insights">
                <div class="sales">
                    <span class="material-symbols-outlined">monitoring</span>
                    <div class="middle">
                        <div class="left">
                            <h3 class="text-muted">Total Sales</h3>
                            <h1>$25,024</h1>
                        </div>
                    </div>
                </div>

                <div class="expenses">
                    <span class="material-symbols-outlined">bar_chart</span>
                    <div class="middle">
                        <div class="left">
                            <h3 class="text-muted">Total Expenses</h3>
                            <h1>$14,160</h1>
                        </div>
                    </div>
                </div>

                <div class="income">
                    <span class="material-symbols-outlined">stacked_line_chart</span>
                    <div class="middle">
                        <div class="left">
                            <h3 class="text-muted">Total Income</h3>
                            <h1>$10,0864</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="recent-table-list">
                <h2>Recent Products</h2>
                <table>
                    <thread>
                        <tr>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Product Number</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thread>
                    <tbody>
                        <?php while($row = mysqli_fetch_array($results)) { ?>
                        <tr>
                            <td><img src="images/<?php echo $row['product_image']; ?>" alt="product image"></td>
                            <!-- <td><img src="images/pizza2.jpeg" alt=""></td> -->
                            <td><?php echo $row['product_name']; ?></td>
                            <td><?php echo $row['product_id']; ?></td>
                            <td class="warning">Pending</td>
                            <td class="primary">Details</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </main>

        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <div class="theme-toggler">
                    <span class="material-symbols-outlined active">light_mode</span>
                    <span class="material-symbols-outlined">dark_mode</span>
                </div>
                <div class="profile">
                    <div class="info">
                        <?php if (isset($_SESSION["admin_name"])): ?>
                        <p>Hey, <b><?php echo $_SESSION['admin_name']; ?></b></p>
                        <small class="text-muted">Admin</small>
                        <?php endif ?>
                    </div>
                    <div class="profile-photo">
                        <span class="material-symbols-outlined">account_circle</span>
                    </div>
                </div>
            </div>
            <div class="recent-updates">
                <h2>Recent Updates</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profile-photo">
                            <img src="images/anise.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Anise</b> received his order of Night lion tech GPS drone.</p>
                            <small class="text-muted">2 Minutes Ago</small>
                            <p>hello</p>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="images/haziq.jpeg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Haziq Fikri</b> received his order of Night lion tech GPS drone.</p>
                            <small class="text-muted">2 Minutes Ago</small>
                            <p>hello</p>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="images/nik-fikri.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Nik Fikri</b> received his order of Night lion tech GPS drone.</p>
                            <small class="text-muted">2 Minutes Ago</small>
                            <p>hello</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sales-analytics">
                <h2>Sales Analytics</h2>
                <div class="item online">
                    <div class="icon">
                        <span class="material-symbols-outlined">shopping_cart</span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>ONLINE ORDERS</h3>
                            <small class="text-muted">Last 24 Hours</small>
                        </div>
                        <h5 class="success">+39%</h5>
                        <h3>3849</h3>
                    </div>
                </div>
                <div class="item online">
                    <div class="icon">
                        <span class="material-symbols-outlined">local_mall</span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>ONLINE ORDERS</h3>
                            <small class="text-muted">Last 24 Hours</small>
                        </div>
                        <h5 class="danger">-17%</h5>
                        <h3>1100</h3>
                    </div>
                </div>
                <div class="item online">
                    <div class="icon">
                        <span class="material-symbols-outlined">person</span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>NEW CUSTOMERS</h3>
                            <small class="text-muted">Last 24 Hours</small>
                        </div>
                        <h5 class="danger">+25%</h5>
                        <h3>849</h3>
                    </div>
                </div>
                <div class="item add-product">
                    <div>
                        <span class="material-symbols-outlined">add</span>
                        <h3>Add Product</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="orders.js" async defer></script>
    <script src="index.js"></script>

</body>

</html>