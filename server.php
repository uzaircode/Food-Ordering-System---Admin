<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
$customer_name = "";
$customer_email = "";
$customer_id = "";
$customer_phone = "";
$customer_password = "";

$admin_name = "";
$admin_password = "";
$admin_email = "";
$admin_phone = "";

$cart_id = "1";


$productId = "";
$customerId = "";

$customer_id = "";
$feedback_order_description = "";
$feedback_pickup_description = "";
$feedback_rating = "";

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


// save customer feedbacks
if(isset($_POST['customerFeedbackSave'])) {
  $customer_id = $_POST['customer_id'];
  $feedback_order_description = $_POST['feedback_order_description'];
  $feedback_pickup_experience = $_POST['feedback_pickup_experience'];
  $feedback_rating = $_POST['feedback_rating'];

  $query = "INSERT INTO feedback (customer_id, feedback_order_description, feedback_pickup_experience, feedback_rating) VALUES ('$customer_id', '$feedback_order_description','$feedback_pickup_experience','$feedback_rating')";
  mysqli_query($db, $query);
  header('location: feedback.php');
}

// update product records
if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($db, $_POST['product_name']);
    $price = mysqli_real_escape_string($db, $_POST['product_price']);
    $description = mysqli_real_escape_string($db, $_POST['product_description']);
    $product_image = $_POST['upload'];
    $id = mysqli_real_escape_string($db, $_POST['id']);

    $query = "UPDATE product SET product_name='$name', product_price='$price', product_description='$description', product_image='$product_image' WHERE product_id=$id";
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

// retrieve product records
$customer_results = mysqli_query($db, "SELECT * FROM customer");

// retrieve customer receipts
$receipt_results = mysqli_query($db, "SELECT `receipt`.*, `customer`.* FROM `receipt` INNER JOIN `customer` ON `receipt`.`customer_id` = `customer`.`customer_id`");

// retrieve customer feedbacks
$feedback_results = mysqli_query($db, "SELECT * FROM feedback");



// if the admin register button is clicked
if (isset($_POST['register'])) {
  $username = mysqli_real_escape_string($db, $_POST['admin_name']);
  $email = mysqli_real_escape_string($db, $_POST['admin_email']);
  $password = mysqli_real_escape_string($db, $_POST['admin_password']);

  $password = md5($password);
  $sql = "INSERT INTO user (admin_name, admin_email, admin_password) VALUES ('$username', '$email', '$password')";
  mysqli_query($db, $sql);

  // Get the `admin_id` of the newly created user
  $admin_id = mysqli_insert_id($db);

  // Start the session
  session_start();

  // Set the `admin_id` session variable
  $_SESSION['admin_id'] = $admin_id;
  $_SESSION['admin_name'] = $username;
  $_SESSION['admin_email'] = $email;

  // Redirect to the desired page
  header('location: index.php');
}




// if the customer register button is clicked
if (isset($_POST['customerRegister'])) {
  $customer_username = mysqli_real_escape_string($db, $_POST['customer_name']);
  $password = mysqli_real_escape_string($db, $_POST['customer_password']);
  $email = mysqli_real_escape_string($db, $_POST['customer_email']);

  $password = md5($password);
  $sql = "INSERT INTO customer (customer_name, customer_password, customer_email, customer_phone) VALUES ('$customer_username', '$password', '$email', '0189002414')";
  mysqli_query($db, $sql);

  session_start();
  // set session variable with the username
  $_SESSION['customer_name'] = $customer_username;

  // redirect to register page
  header('location: userLogin.php');

}

// if the admin login button is clicked
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
    $_SESSION['admin_id'] = (int)$row['admin_id'];

    header("location: index.php");
  } else {
    // If the login fails, redirect the user to the login page
    header("location: login.php");
  }
}

// if the customer login button is clicked
if (isset($_POST['customerLogin'])) {
  $customer_email = mysqli_real_escape_string($db, $_POST['customer_email']);
  $password = mysqli_real_escape_string($db, $_POST['customer_password']);

  $password = md5($password);
  // Check if the user exists in the database
  $query = "SELECT * FROM customer WHERE customer_email='$customer_email' AND customer_password='$password'";
  $results = mysqli_query($db, $query);

  if (mysqli_num_rows($results) == 1) {
    // Fetch the user's information
    $row = mysqli_fetch_assoc($results);
    // Store the user's information in a session
    session_start();
    $_SESSION['customer_name'] = $row['customer_name'];
    $_SESSION['customer_email'] = $row['customer_email'];
    $_SESSION['customer_phone'] = $row['customer_phone'];
    $_SESSION['customer_id'] = (int)$row['customer_id'];


    header("location: userHomepage.php");
  } else {
      $error = mysqli_error($db);
      header("location: userLogin.php?error=$error");
      echo $error;
    // If the login fails, redirect the user to the login page
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
if(isset($_POST['form_submitted'])) {
  if(isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];

    $check_cart = mysqli_query($db, "SELECT * FROM cart WHERE customer_id = '$customer_id'");
    $cart = mysqli_fetch_assoc($check_cart);
    $cart_id = $cart['cart_id'];

    // update the foreign key of order_id in the customer table
    $update_customer_query = "UPDATE customer SET cart_id = $cart_id  WHERE customer_id = '$customer_id'";
    mysqli_query($db, $update_customer_query);


    // insert new order into order table
    $result = mysqli_query($db, "INSERT INTO `order` (customer_id, cart_id) VALUES ('$customer_id', '$cart_id')");

    $order_id = mysqli_insert_id($db);

    // insert order information into receipt table
    $receipt_result = mysqli_query($db, "INSERT INTO receipt (order_id, customer_id, cart_id) VALUES ('$order_id', '$customer_id', '$cart_id')");

    if ($receipt_result) {
        unset($_SESSION['cart_id']);
        header('location: userHomepage.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($db);
    }
  }
}


// record cart when customer place add to cart
if (isset($_POST['action_id'])) {
  $action_id = $_POST['action_id'];
if ($action_id == "add_to_cart") {
  if(isset($_POST['product_id']) && isset($_POST['customer_id'])) {
    $product_id = $_POST['product_id'];
    $customer_id = $_POST['customer_id'];

    // Check if a cart with the same customer ID already exists
    $check_cart = mysqli_query($db, "SELECT * FROM cart WHERE customer_id = '$customer_id'");

    if(mysqli_num_rows($check_cart) > 0) {
    // If it exists, insert a new cart with a new cart ID
    mysqli_query($db, "INSERT INTO cart (customer_id, cart_quantity) VALUES ('$customer_id', 1)");
    $cart_id = mysqli_insert_id($db);
    } else {
    // If it doesn't exist, insert a new cart
    mysqli_query($db, "INSERT INTO cart (customer_id, cart_quantity) VALUES ('$customer_id', 1)");
    $cart_id = mysqli_insert_id($db);
    }

    // Check if a cart item with the same cart ID and product ID already exists
    $check_cart_item = mysqli_query($db, "SELECT * FROM cart_item WHERE customer_id = '$customer_id' AND product_id = '$product_id'");

    if(mysqli_num_rows($check_cart_item) > 0) {
      // If it exists, update the quantity of that item
      mysqli_query($db, "UPDATE cart_item SET product_quantity = product_quantity + 1 WHERE cart_id = '$cart_id' AND product_id = '$product_id'");
    } else {
      // If it doesn't exist, insert a new cart item
      mysqli_query($db, "INSERT INTO cart_item (cart_id, customer_id, product_id, product_quantity) VALUES ('$cart_id','$customer_id', '$product_id', 1)");
    }
    echo "success";
    exit;
  }
} else if ($action_id == "delete_from_cart") {
    if(isset($_POST['customer_id']) && isset($_POST['product_id'])) {
    $customer_id = $_POST['customer_id'];
    $product_id = $_POST['product_id'];

    $delete_query = "DELETE FROM cart_item WHERE product_id = $product_id AND customer_id = $customer_id";
    $result = mysqli_query($db, $delete_query);
    if (!$result) {
        die("Query failed: " . mysqli_error($db));
    }
    echo "success";
    exit;
}
  } else {
    // handle unknown action_id here
  }
}

// update admin profile
if (isset($_POST['adminUpdate'])) {
  $admin_name = mysqli_real_escape_string($db, $_POST['admin_name']);
  $admin_email = mysqli_real_escape_string($db, $_POST['admin_email']);
  $admin_phone = mysqli_real_escape_string($db, $_POST['admin_phone']);
  $admin_password = mysqli_real_escape_string($db, $_POST['admin_password']);
  $admin_id = mysqli_real_escape_string($db, $_POST['admin_id']);

  // Hash the password before storing it in the database
  $admin_password = md5($admin_password);

  $query = "UPDATE user SET admin_name='$admin_name', admin_email='$admin_email', admin_phone='$admin_phone', admin_password='$admin_password' WHERE admin_id=$admin_id";
  mysqli_query($db, $query);
  header('location: index.php');
}

if (isset($_POST['customerUpdate'])) {
  $customer_name = mysqli_real_escape_string($db, $_POST['customer_name']);
  $customer_email = mysqli_real_escape_string($db, $_POST['customer_email']);
  $customer_phone = mysqli_real_escape_string($db, $_POST['customer_phone']);
  $customer_password = mysqli_real_escape_string($db, $_POST['customer_password']);
  $customer_id = mysqli_real_escape_string($db, $_POST['customer_id']);

  // Hash the password before storing it in the database
  $customer_password = md5($customer_password);

  $query = "UPDATE customer SET customer_name='$customer_name', customer_email='$customer_email', customer_phone='$customer_phone', customer_password='$customer_password' WHERE customer_id=$customer_id";
  mysqli_query($db, $query);
  header('location: customerProfile.php');
}




?>