<?php
// phpinfo(); // Works correctly
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
include('server.php');

$customer_id = $_SESSION['customer_id'];


if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $rec = mysqli_query($db, "SELECT * FROM customer WHERE customer_id=$id");
  $record = mysqli_fetch_array($rec);
  $name = $record['customer_name'];
  $email = $record['customer_email'];
  $phone = $record['customer_phone'];
  $productName = $record['product_name'];
  $description = $record['product_description'];
  $product_image = $record['product_image'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Invoice | Siti Khadijah Online</title>
    <link rel="stylesheet" href="report.css" />
    <link rel="shortcut icon" type="image/png" href="favicon.png" />
</head>

<body>
    <div class="page" size="A4">
        <!--Top Section-->
        <div class="top-section">
            <div class="address">
                <div class="address-content">
                    <h1>Food Ordering System</h1>
                    <br />
                    <p>no name Sdn Bhd</p>
                </div>
            </div>
        </div>
        <hr />

        <!--Invoice Ingoi-->
        <div class="billing-invoice">
            <h3>Invoice</h3>
            <p>Food pickup</p>
        </div>

        <!--Billed to-->
        <div class="billing-to">
            <div class="sub-title">
                <p><strong>Sold to: </strong><?php echo $name; ?></p>
                <p><strong>Email : </strong><?php echo $email; ?></p>
                <p><strong>Phone Number: </strong>+60 <?php echo $phone; ?></p>
            </div>

            <div class="sub-title">
                <p><strong>Tax receipt: </strong>07km-49a7</p>
                <p><strong>Date : </strong>2023-01-05 14:23</p>
                <p><strong>SST No: </strong>+W10-18088-31001268</p>
            </div>
        </div>

        <!--Invoice Table-->
        <div class="table">
            <table>
                <tr>
                    <th>Dish</th>
                    <!-- <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Price</th> -->
                </tr>
                <?php
                $cart_records = mysqli_query($db, "SELECT cart.*, product.product_name, product.product_image, product.product_price FROM cart INNER JOIN product ON cart.product_id = product.product_id WHERE cart.customer_id = '$customer_id'");
                while($row = mysqli_fetch_array($receipt_results)) { ?>
                <tr>
                    <td><?php echo $row['product_name']; ?></td>
                    <td><?php echo $row['product_image']; ?></td>
                    <td><?php echo $row['product_price']; ?></td>
                </tr>
                <?php
                    }
                    ?>
            </table>
        </div>
        <!--Bottom Section-->
        <div class="bottom-section">
            <div class="status-content">
                <h4>Payment Status</h4>
                <p class="status paid"></p>
                <p>Payment Method : <span>Maybank2u</span></p>
            </div>
        </div>
    </div>
</body>

</html>