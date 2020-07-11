<?php
include '../helper/include.php';

//sql injection
// csrf
if(!isset($_POST['csrf_token'])||$_SESSION['csrf_token']!=$_POST['csrf_token']){
    header("location: ".url('login'));
    return;
}

if(!isset($_POST['username'])||!isset($_POST['password'])){
    header("location: ".url('login'));
    return;
}

$username=$_POST['username'];
$password=$_POST['password'];

// $sql="select * from user where username='".$username."'";
// $res=$conn->query($sql);
$sql="select * from user where username= ?";
$stmt=$conn->prepare($sql);
$stmt->bind_param("s",$username);
$stmt->execute();
$res=$stmt->get_result();

if($res->num_rows==1){
    $row=$res->fetch_assoc();
    if(password_verify($password,$row['password'])){
        session_regenerate_id();
        $_SESSION['user_id']=$row['id'];
        header("location: ../index");
        return;
    }
}
header("location: ../login?error=1");