<?php
include '../helper/include.php';

// sql injection
// csrf
// xss

if(!isset($_POST['csrf_token'])||$_SESSION['csrf_token']!=$_POST['csrf_token']){
    header("location: ".url('register'));
    return;
}

if (isset($_POST['get_data'])) { 
    $sql="select * from global_message gm join user u on gm.user_id=u.id";
    $res=$conn->query($sql);
    $arr=array();
    while($row=$res->fetch_assoc()){
        $row_raw=$row;
        $row=[];
        foreach($row_raw as $x=>$val){
            $row[$x]=htmlentities(($val));
        }
        $arr[]=$row;
    }
    echo json_encode($arr);
} else if(isset($_POST['message'])) {
    if($_POST['message']==""){
        header("location: ../index");
        return;
    }
    // $sql = "insert into global_message(user_id, message) values(" . $_SESSION['user_id'] . ",'" . $_POST['message'] . "')";
    // $conn->query($sql);
    $sql = "insert into global_message(user_id, message) values(?,?)";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("is",$_SESSION['user_id'],$_POST['message']);
    $stmt->execute();

    header("location: ../index");
}
