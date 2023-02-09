<?php
// phpinfo(); // Works correctly
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
include('server.php');

$customer_id = $_SESSION['customer_id'];


if (isset($_GET['edit'])) {
  $receipt_id = $_GET['edit'];
  $rec = mysqli_query($db, "SELECT * FROM receipt WHERE receipt_id=$id");
  $record = mysqli_fetch_array($rec);


  $query = "SELECT customer.*, receipt.*
            FROM customer
            INNER JOIN receipt ON customer.customer_id = receipt.customer_id
            WHERE receipt.receipt_id = $receipt_id";
  $result = mysqli_query($db, $query);
  $row = mysqli_fetch_assoc($result);
  $customer_name = $row['customer_name'];
  $customer_email = $row['customer_email'];
  $customer_phone = $row['customer_phone'];

$query1 = "SELECT ci.product_id, ci.quantity, p.product_name, p.product_price
FROM cart_items ci
JOIN cart c ON c.cart_id = ci.cart_id
JOIN `order` o ON o.session_id = c.session_id
JOIN receipt ro ON ro.order_id = o.order_id
JOIN product p ON ci.product_id = p.product_id
WHERE ro.receipt_id = $receipt_id";


  $receipt_order_results = mysqli_query($db, $query1);
  // and so on for all the customer information
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Invoice</title>
    <link rel="stylesheet" href="report.css" />
    <link rel="shortcut icon" type="image/png" href="favicon.png" />
</head>

<body>
    <div class="page" size="A4">
        <!--Top Section-->
        <div class="top-section">
            <div class="address">
                <div class="address-content">
                    <h1>Pizza Moto</h1>
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
                <p><strong>Sold to : </strong><?php echo $customer_name; ?></p>
                <p><strong>Email : </strong><?php echo $customer_email; ?></p>
                <p><strong>Phone Number: </strong>+6<?php echo $customer_phone; ?></p>
            </div>

            <div class="sub-title">
            </div>
        </div>

        <!--Invoice Table-->
        <div class="table">
            <table>
                <thread>
                    <tr>
                        <th>Dish</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Price</th>
                    </tr>
                </thread>

                <body>
                    <?php
                    while ($receipt_order_row = mysqli_fetch_assoc($receipt_order_results)) {
                        ?>
                    <tr>
                        <td><?php echo $receipt_order_row['product_name']; ?></td>
                        <!-- <td><?php echo $receipt_order_row['product_price']; ?></td> -->
                        <td>2</td>
                        <td>15.99</td>
                        <td>31.98</td>
                    </tr>
                    <?php
                    }
                    ?>
                </body>
            </table>
        </div>
        <!--Bottom Section-->
        <div class="bottom-section">
            <div class="status-content">
                <h4>Payment Status</h4>
                <p class="status paid"></p>
            </div>
        </div>
    </div>
</body>

</html>