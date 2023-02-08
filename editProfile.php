<?php
session_start();
include('server.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);


$admin_id = $_SESSION['admin_id'];
// echo $admin_id;

if (isset($_GET['edit'])) {
$query = "SELECT * FROM user WHERE admin_id=$admin_id";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($result);
$admin_name = $row['admin_name'];
$admin_email = $row['admin_email'];
$admin_phone = $row['admin_phone'];
$admin_password = $row['admin_password'];
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Dashboard</title>
    <link rel="icon" type="image/x-icon" href="images/pizza_icon.png">
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
                <a href="product.php">
                    <span class="material-symbols-outlined">inventory</span>
                    <h3>Products</h3>
                </a>
                <a href="invoice.php">
                    <span class="material-symbols-outlined">receipt</span>
                    <h3>Invoices</h3>
                </a>
                <a href="editProfile.php" class="active">
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
            <h1>Edit Profile</h1>
            <div class="recent-table-list">
                <div class="recent-table-list-title-section">
                    <div class="recent-table-list-title-section-right">
                    </div>
                </div>
                <div class="container-login">
                    <form method="post" action="server.php">
                        <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
                        <div class="form-group">
                            <p>Name</p>
                            <input type="text" name="admin_name" value="<?php echo $admin_name; ?>">
                        </div>
                        <br />
                        <div class="form-group">
                            <p>Email</p>
                            <input type="email" name="admin_email" value="<?php echo $admin_email; ?>">
                        </div>
                        <br />
                        <div class="form-group">
                            <p>Contact Number</p>
                            <input type="text" name="admin_phone" value="<?php echo $admin_phone; ?>">
                        </div>
                        <br>
                        <div class="form-group">
                            <p>Password</p>
                            <input type="password" name="admin_password" value="<?php echo $admin_password; ?>">
                        </div>
                        <br>
                        <div>
                            <button class="button-login" input type="submit" name="adminUpdate">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>

        <div class=" right">
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
        </div>
        <script src="orders.js" async defer></script>
        <script src="index.js" async defer></script>
    </div>

</body>

</html>