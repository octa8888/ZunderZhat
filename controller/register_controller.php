<?php
include '../helper/include.php';

if(!isset($_POST['username'])||!isset($_POST['password'])){
    header("location: ".url('register'));
}

$username=$_POST['username'];
$password=$_POST['password'];

$sql="select username from user where username='".$username."'";
$req=$conn->query($sql);
if($req->num_rows==1){
    header("location: ../register?error=1");
    die();
}

$sql="insert into user (username, password) values('".$username."','".$password."')";

$conn->query($sql);

header('location: ../login');

