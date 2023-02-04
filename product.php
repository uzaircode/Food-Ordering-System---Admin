<?php
session_start();
// phpinfo(); // Works correctly
ini_set('display_errors', 1);
include('server.php');
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
                <a href="index.php">
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
                <a href="#" class="active">
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
                <a href="login.php?logout='1'">
                    <span class="material-symbols-outlined">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>

        <main>
            <h1>Recent Products</h1>
            <div class="recent-table-list">
                <div class="recent-table-list-title-section">
                    <div class="recent-table-list-title-section-right">
                        <button onclick="window.location.href='addProduct.php'">Add Product</button>
                    </div>
                </div>
                <br>
                <table>
                    <thread>
                        <tr>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thread>
                    <tbody>
                        <?php while($row = mysqli_fetch_array($results)) { ?>
                        <tr>
                            <td><img src="images/<?php echo $row['product_image']; ?>" alt="product image"></td>
                            <!-- <td><img src="images/pizza2.jpeg" alt=""></td> -->
                            <td><?php echo $row['product_name']; ?></td>
                            <td><a href="editProduct.php?edit=<?php echo $row['product_id']; ?>"><span
                                        class="material-symbols-outlined warning">edit_note</span></a></td>
                            <td><a href="server.php?del=<?php echo $row['product_id']; ?>"><span
                                        class="material-symbols-outlined danger">delete_sweep</span></a></td>
                            <!-- <td>Due</td>
                        <td class="primary">Details</td> -->
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div id="deleteModal" class="modal">
                    <div class="modal-content">
                        <p>Are you sure you want to delete?</p>
                        <button id="yesBtn">Yes</button>
                        <button id="noBtn">No</button>
                    </div>
                </div>
            </div>
        </main>

        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <div class="theme-toggler" id="themeToggler">
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
        </div>
    </div>

    <script src="index.js"></script>
</body>

</html>