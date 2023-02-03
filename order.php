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
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"
    />
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
          <a href="order.php"  class="active">
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
                <tbody>
                    <!-- <tr>
                        <td>#18402</td>
                        <td>Mr. Raan</td>
                        <td class="success">PAID</td>
                    </tr> -->
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
    </div>
    <script src="orders.js" async defer></script>
    <script src="index.js"></script>

  </body>
</html>
