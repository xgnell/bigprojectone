<?php
$root_path = $_SERVER["DOCUMENT_ROOT"];
require_once($root_path . "/config/db.php");

if (empty($_POST["name"]) || empty($_POST["email"]) || 
	empty($_POST["gender"]) || empty($_POST["passwd"]) || 
	empty($_POST["address"]) || empty($_POST["birth_year"]) || 
	empty($_POST["birth_month"]) || empty($_POST["birth_day"]) || 
	empty($_POST["phone"])) {
	header('location:/public/templates/account/fail.php');
}
// Get all signup data
$customer_name = $_POST["name"];
$customer_email = $_POST["email"];
$customer_gender = $_POST["gender"];
$customer_passwd = $_POST["passwd"];
$customer_address = $_POST["address"];
$customer_birth_year = $_POST["birth_year"];
$customer_birth_month = $_POST["birth_month"];
$customer_birth_day = $_POST["birth_day"];
$customer_phone = $_POST["phone"];

sql_cmd("
	INSERT INTO customers (name, gender, birth, phone, email, passwd, address)
	VALUES ('$customer_name', $customer_gender, '$customer_birth_year-$customer_birth_month-$customer_birth_day', '$customer_phone', '$customer_email', '$customer_passwd', '$customer_address');
");
	header('location:/public/templates/account/success.php');
?>