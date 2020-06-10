<?php
include '../helper/include.php';

if(isset($_POST['get_data'])){
    $sql="select u.id, iv_key, u.id as user1_id, u.username as user1_username, u1.id as user2_id, u1.username as user2_username from private_message pm join user u on pm.user_1=u.id join user u1 on pm.user_2=u1.id where user_1 = ".$_SESSION['user_id']." or user_2 = ".$_SESSION['user_id'];
    $res=$conn->query($sql);
    $arr=array();
    while($row=$res->fetch_assoc()){
        $arr[]=$row;
    }
    echo json_encode($arr);
}