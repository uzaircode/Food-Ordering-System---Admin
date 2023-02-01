<?php
// initialize variables
$name = "";
$address = "";
$id = 0;
$edit_state = false;

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

// retrieve records
$results = mysqli_query($db, "SELECT * FROM product");
?>