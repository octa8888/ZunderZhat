<?php
include '../helper/include.php';

if(!isset($_POST['username'])||!isset($_POST['password'])){
    header("location: ".url('register'));
}

$username=$_POST['username'];
$password=$_POST['password'];

if($username==""||$password==""){
    header("location: ../register?error=2");
    return;
}

$sql="select username from user where username='".$username."'";
$req=$conn->query($sql);
if($req->num_rows==1){
    header("location: ../register?error=1");
    return;
}

$sql="insert into user (username, password) values('".$username."','".$password."')";

$conn->query($sql);

header('location: ../login');

