<?php
include '../helper/include.php';

if(!isset($_POST['username'])||!isset($_POST['password'])){
    header("location: ".url('register'));
}

$username=$_POST['username'];
$password=$_POST['password'];

$sql="insert into user (username, password) values('".$username."','".$password."')";

$conn->query($sql);

header('location: ../login');

