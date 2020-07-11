<?php
include '../helper/include.php';

// sql injection
// csrf
if(!isset($_POST['csrf_token'])||$_SESSION['csrf_token']!=$_POST['csrf_token']){
    header("location: ".url('register'));
    return;
}

if(!isset($_POST['username'])||!isset($_POST['password'])){
    header("location: ".url('register'));
    return;
}

$username=$_POST['username'];
if($username==""||$password==""){
    header("location: ../register?error=2");
    return;
}
$password=password_hash($_POST['password'],PASSWORD_BCRYPT);


// $sql="select username from user where username='".$username."'";
// $res=$conn->query($sql);
$sql="select username from user where username=?";
$stmt=$conn->prepare($sql);
$stmt->bind_param("s",$username);
$stmt->execute();
$res=$stmt->get_result();

if($res->num_rows==1){
    header("location: ../register?error=1");
    return;
}

// $sql="insert into user (username, password) values('".$username."','".$password."')";
// $conn->query($sql);

$sql="insert into user (username, password) values(?,?)";
$stmt=$conn->prepare($sql);
$stmt->bind_param("ss",$username,$password);
$stmt->execute();

header('location: ../login');

