<?php
include '../helper/include.php';
if (isset($_POST['get_data'])) { 
    $sql="select * from global_message gm join user u on gm.user_id=u.id";
    $res=$conn->query($sql);
    $arr=array();
    while($row=$res->fetch_assoc()){
        $arr[]=$row;
    }
    echo json_encode($arr);
} else if(isset($_POST['message'])) {
    if($_POST['message']==""){
        header("location: ../index");
        return;
    }
    $sql = "insert into global_message(user_id, message) values(" . $_SESSION['user_id'] . ",'" . $_POST['message'] . "')";
    $conn->query($sql);

    header("location: ../index");
}
