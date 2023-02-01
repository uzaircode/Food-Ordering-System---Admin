<?php
// initialize variables
$name = "";
$address = "";
$id = 0;
$edit_state = false;

$username = "";
$email = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'admin_database');

// if button is clicked
if(isset($_POST['save'])) {
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $description = $_POST['product_description'];
    $product_image = $_POST['upload'];

    $query = "INSERT INTO product (product_name, product_price, product_description, product_image) VALUES ('$name','$price','$description','$product_image')";
    mysqli_query($db, $query);
    header('location: product.php');
}

// update records
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

// delete records
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($db, "DELETE FROM product WHERE product_id=$id");
    header('location: product.php');
}

// retrieve records
$results = mysqli_query($db, "SELECT * FROM product");

// if the register button is clicked
if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($db, $_POST['admin_name']);
    $email = mysqli_real_escape_string($db, $_POST['admin_email']);
    $password = mysqli_real_escape_string($db, $_POST['admin_password']);

    // if (empty($username)) {
    //     array_push($errors, "Username is required");
    // }
    // if (empty($email)) {
    // array_push($errors, "email is required");
    // }
    // if (empty($password)) {
    // array_push($errors, "password is required");
    // }

    // if(count($errors) == 0) {

    // }

    $password = md5($password);
    $sql = "INSERT INTO user (admin_name, admin_email, admin_password) VALUES ('$username', '$email', '$password')";
    mysqli_query($db, $sql);

    session_start();
    // set session variable with the username
    $_SESSION['admin_name'] = $username;

    // redirect to register page
    header('location: product.php');


}

if(isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['admin_name']);
    header('location: login.php');
}

if (isset($_POST['login'])) {
  $admin_email = mysqli_real_escape_string($db, $_POST['admin_email']);
  $password = mysqli_real_escape_string($db, $_POST['admin_password']);

  // Check if the user exists in the database
  $query = "SELECT * FROM user WHERE admin_email='$admin_email' AND admin_password='$password'";
  $results = mysqli_query($db, $query);

  if (mysqli_num_rows($results) == 1) {
    // Store the user's information in a session
    $row = mysqli_fetch_assoc($results);
    $_SESSION['admin_name'] = $row['admin_name'];
    $_SESSION['admin_email'] = $row['admin_email'];
    header("location: product.php");
  } else {
    // If the login fails, redirect the user to the login page
    header("location: login.php");
  }

}
?>