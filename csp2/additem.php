<?php
session_start();
require "connection.php";

$target_dir = "assets/img/products/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

$name = mysqli_real_escape_string($conn, $_POST["name"]);
$price = mysqli_real_escape_string($conn, $_POST["price"]);
if (isset($_POST["processor"])) {
    $processor = mysqli_real_escape_string($conn, $_POST["processor"]);
} else {
    $processor = "NULL";
}
if (isset($_POST["screensize"])) {
    $screensize = mysqli_real_escape_string($conn, $_POST["screensize"]);
} else {
    $screensize = "NULL";
}
if (isset($_POST["ram"])) {
    $ram = mysqli_real_escape_string($conn, $_POST["ram"]);
} else {
    $ram = "NULL";
}
if (isset($_POST["hdd"])) {
    $hdd = mysqli_real_escape_string($conn, $_POST["hdd"]);
} else {
    $hdd = "NULL";
}
if (isset($_POST["gpu"])) {
    $gpu = mysqli_real_escape_string($conn, $_POST["gpu"]);
} else {
    $gpu = "NULL";
}
$description = mysqli_real_escape_string($conn, $_POST["description"]);
$image = mysqli_real_escape_string($conn, $target_file);
$brand = mysqli_real_escape_string($conn, $_POST["brand"]);
$category = mysqli_real_escape_string($conn, $_POST["category"]);

$sql = "INSERT INTO products (name, price, image, processor, screen_size, ram, hdd, gpu, item_description, brand_id, category_id, priority_id) VALUES ('$name', '$price', '$image', '$processor', '$screensize', '$ram', '$hdd', '$gpu', '$description', '$brand', '$category', 1)";

mysqli_query($conn, $sql) or trigger_error("Query failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);

header("location: admin.php#v-pills-products");
