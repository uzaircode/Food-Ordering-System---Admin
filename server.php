<?php
// initialize variables
$name = "";
$address = "";
$id = 0;
$edit_state = false;

$username = "";
$email = "";
$password = "";
$errors = array();
$customer_username = "";
$customer_email = "";
$customer_id = "";

$productId = "";
$customerId = "";

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'admin_database');

// add product records
if(isset($_POST['save'])) {
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $description = $_POST['product_description'];
    $product_image = $_POST['upload'];

    $query = "INSERT INTO product (product_name, product_price, product_description, product_image) VALUES ('$name','$price','$description','$product_image')";
    mysqli_query($db, $query);
    header('location: product.php');
}

// update product records
if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($db, $_POST['product_name']);
    $price = mysqli_real_escape_string($db, $_POST['product_price']);
    $description = mysqli_real_escape_string($db, $_POST['product_description']);
    $product_image = $_POST['upload'];
    $id = mysqli_real_escape_string($db, $_POST['id']);

    $query = "UPDATE product SET product_name='$name', product_price='$price', product_description='$description', product_image='$upload' WHERE product_id=$id";
    mysqli_query($db, $query);
    header('location: product.php');
}

// delete product records
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($db, "DELETE FROM product WHERE product_id=$id");
    header('location: product.php');
}

// retrieve product records
$results = mysqli_query($db, "SELECT * FROM product");

// if the admin register button is clicked
if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($db, $_POST['admin_name']);
    $email = mysqli_real_escape_string($db, $_POST['admin_email']);
    $password = mysqli_real_escape_string($db, $_POST['admin_password']);

    $password = md5($password);
    $sql = "INSERT INTO user (admin_name, admin_email, admin_password) VALUES ('$username', '$email', '$password')";
    mysqli_query($db, $sql);

    session_start();
    // set session variable with the username
    $_SESSION['admin_name'] = $username;
    $_SESSION['admin_email'] = $email;

    // redirect to register page
    header('location: product.php');


}

// if the customer register button is clicked
if (isset($_POST['customerRegister'])) {
  $customer_username = mysqli_real_escape_string($db, $_POST['customer_name']);
  $password = mysqli_real_escape_string($db, $_POST['customer_password']);
  $email = mysqli_real_escape_string($db, $_POST['customer_email']);

  $password = md5($password);
  $sql = "INSERT INTO customer (customer_name, customer_password, customer_email) VALUES ('$customer_username', '$password', '$email')";
  mysqli_query($db, $sql);

  session_start();
  // set session variable with the username
  $_SESSION['customer_name'] = $customer_username;

  // redirect to register page
  header('location: product.php');

}

// if the login button is clicked
if (isset($_POST['login'])) {
  $admin_email = mysqli_real_escape_string($db, $_POST['admin_email']);
  $password = mysqli_real_escape_string($db, $_POST['admin_password']);

  // Check if the user exists in the database
  $password = md5($password);
  $query = "SELECT * FROM user WHERE admin_email='$admin_email' AND admin_password='$password'";
  $results = mysqli_query($db, $query);

  if (mysqli_num_rows($results) == 1) {
    // Fetch the user's information
    $row = mysqli_fetch_assoc($results);
    // Store the user's information in a session
    $_SESSION['admin_name'] = $row['admin_name'];
    $_SESSION['admin_email'] = $row['admin_email'];
    header("location: product.php");
  } else {
    // If the login fails, redirect the user to the login page
    header("location: login.php");
  }

}

// if the customer login button is clicked
if (isset($_POST['customerLogin'])) {
  $customer_email = mysqli_real_escape_string($db, $_POST['customer_email']);
  $password = mysqli_real_escape_string($db, $_POST['customer_password']);

  // Check if the user exists in the database
  $query = "SELECT * FROM customer WHERE customer_email='$customer_email' AND customer_password='$password'";
  $results = mysqli_query($db, $query);

  if (mysqli_num_rows($results) == 1) {
    // Fetch the user's information
    $row = mysqli_fetch_assoc($results);
    // Store the user's information in a session
    session_start();
    $_SESSION['customer_name'] = $row['customer_name'];
    $_SESSION['customer_id'] = (int)$row['customer_id'];


    header("location: userHomepage.php");
  } else {
    // If the login fails, redirect the user to the login page
    header("location: userLogin.php");
  }
}


// if the logout button is clicked
if(isset($_GET['logout'])) {
    $_SESSION = array();
    session_destroy();
    header('location: login.php');
}

// retrieve customer records
$customer_records = mysqli_query($db, "SELECT * FROM customer");

// retrieve order records
$order_records = mysqli_query($db, "SELECT `order`.*, `customer`.`customer_name` FROM `order` INNER JOIN `customer` ON `order`.`customer_id` = `customer`.`customer_id`");


// record order when customer order
// if(isset($_SESSION['customer_id'])) {

//     $cart_records = mysqli_query($db, "SELECT cart_id FROM cart WHERE customer_id = '$customer_id'");
//     $row = mysqli_fetch_array($cart_records);
//     $_SESSION['customer_id'] = $row['customer_id'];
//     $_SESSION['cart_id'] = (int)$row['cart_id'];

//     // Perform your database operation here to record the order
//     mysqli_query($db, "INSERT INTO `order` (customer_id, cart_id) VALUES ('$customer_id', '$cart_id')");
// }

// record cart when customer place add to cart
if(isset($_GET['product_id'])) {
  $customer_id = $_GET['customer_id'];
  $product_id = $_GET['product_id'];

  // Check if a cart item with the same customer ID and product ID already exists
  $check_cart_item = mysqli_query($db, "SELECT * FROM cart WHERE customer_id = '$customer_id' AND product_id = '$product_id'");
  if(mysqli_num_rows($check_cart_item) > 0) {
    // If it exists, update the quantity of that item
    mysqli_query($db, "UPDATE cart SET cart_quantity = cart_quantity + 1 WHERE customer_id = '$customer_id' AND product_id = '$product_id'");
  } else {
    // If it doesn't exist, insert a new cart item
    mysqli_query($db, "INSERT INTO cart (customer_id, product_id, cart_quantity) VALUES ('$customer_id', '$product_id', 1)");
  }
  echo "<script>window.location.reload();</script>";
  header("location: userHomepage.php");

}


//record cart when customer order
// if(isset($_GET['cart_id'])) {
//   $customer_id = $_GET['customer_id'];
//   $product_id = $_GET['product_id'];

//   mysqli_query($db, "INSERT INTO cart (customer_id, product_id) VALUES ('$customer_id', '$product_id)");
// }
?>