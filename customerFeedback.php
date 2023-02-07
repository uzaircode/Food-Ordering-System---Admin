<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
include('server.php');


$customer_id = $_SESSION['customer_id'];
$customer_name = $_SESSION['customer_name'];
$customer_phone = $_SESSION['customer_phone'];



echo $customer_id;
echo $cart_id;
echo $customer_phone;
echo $customer_name;


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// if(isset($_SESSION['customer_name'])) {
//   echo "Customer name: ".$_SESSION['customer_name'];
// } else {
//   echo "Session variable 'customer_name' is not set.";
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" type="image/x-icon" href="images/pizza_icon.png">
    <style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        padding: 50px;
    }

    * {
        box-sizing: border-box;
    }

    input[type=text],
    select,
    textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-top: 6px;
        margin-bottom: 16px;
        resize: vertical;
    }

    input[type=submit] {
        background-color: #04AA6D;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #45a049;
    }

    .container {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
    }
    </style>
    <title>Feedback</title>
</head>

<body>
    <div class="container">
        <form method="post" action="server.php">
            <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
            <div class="form-group">
                <label for="name">Name: </label>
                <input type="text" class="form-control" id="customer_name" name="name"
                    value=" <?php echo $customer_name ?>" disabled>
            </div>
            <div class="form-group">
                <label for="contact">Contact Information:</label>
                <input type="text" class="form-control" id="customer_information" name="contact"
                    value="<?php echo $customer_phone ?>" disabled>
            </div>
            <div class="form-group">
                <label for="order_feedback">Order Feedback:</label>
                <textarea class="form-control" id="order_feedback" name="feedback_order_description"></textarea>
            </div>
            <div class="form-group">
                <label for="pickup_experience">Pickup Experience:</label>
                <textarea class="form-control" id="pickup_experience" name="feedback_pickup_experience"></textarea>
            </div>
            <div class="form-group">
                <label for="overall_rating">Overall Rating:</label>
                <select class="form-control" id="overall_rating" name="feedback_rating">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="customerFeedbackSave">Submit</button>
        </form>
    </div>
</body>

</html>