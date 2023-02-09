<?php
session_start();
include('server.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);


$admin_id = $_SESSION['staff_id'];
// echo $admin_id;

if (isset($_GET['edit'])) {
$query = "SELECT * FROM staff WHERE staff_id=$staff_id";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($result);
$staff_name = $row['staff_name'];
$staff_email = $row['staff_email'];
$staff_phone = $row['staff_phone'];
$staff_password = $row['staff_password'];
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
                <a href="staffDashboard.php">
                    <span class="material-symbols-outlined">dashboard</span>
                    <h3>Dashboard</h3>
                </a>
                <a href="staffOrder.php">
                    <span class="material-symbols-outlined">receipt_long</span>
                    <h3>Orders</h3>
                </a>
                <a href="staffEditProfile.php" class="active">
                    <span class="material-symbols-outlined">settings</span>
                    <h3>Settings</h3>
                </a>
                <a href="staffLogin.php">
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
                        <input type="hidden" name="staff_id" value="<?php echo $staff_id; ?>">
                        <div class="form-group">
                            <p>Name</p>
                            <input type="text" name="staff_name" value="<?php echo $staff_name; ?>">
                        </div>
                        <br />
                        <div class="form-group">
                            <p>Email</p>
                            <input type="email" name="staff_email" value="<?php echo $staff_email; ?>">
                        </div>
                        <br />
                        <div class="form-group">
                            <p>Contact Number</p>
                            <input type="text" name="staff_phone" value="<?php echo $staff_phone; ?>">
                        </div>
                        <br>
                        <div class="form-group">
                            <p>Password</p>
                            <input type="password" name="staff_password" value="<?php echo $staff_password; ?>">
                        </div>
                        <br>
                        <div>
                            <button class="button-login" input type="submit" name="staffUpdate">
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