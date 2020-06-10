<?php
include '../helper/include.php';

if(!isset($_POST['username'])||!isset($_POST['password'])){
    header("location: ".url('login'));
}

$username=$_POST['username'];
$password=$_POST['password'];

$sql="select * from user where username='".$username."' and password ='".$password."'";
$req=$conn->query($sql);
if($req->num_rows==1){
    $row=$req->fetch_assoc();
    $_SESSION['user_id']=$row['id'];
    header("location: ../index");
}
else{
    header("location: ../login");
}