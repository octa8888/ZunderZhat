<?php

include '../helper/include.php';

if (isset($_POST['get_req'])) {
    $sql="select fr.id, from_id, to_id, username from friend_request fr join user u on fr.from_id=u.id where to_id = ".$_SESSION['user_id'];
    $res=$conn->query($sql);
    $arr=array();
    while($row=$res->fetch_assoc()){
        $arr[]=$row;
    }
    echo json_encode($arr);
}
else if (isset($_POST['username'])) {
    $sql = "select id from user where username = '". $_POST['username']."' and id != ".$_SESSION['user_id'];
    $res = $conn->query($sql);
    if ($res->num_rows==1) {
        $row = $res->fetch_assoc();
        $userId = $row['id'];
        $sql = "select * from friend_request where (from_id = ".$_SESSION['user_id']." and to_id= ".$userId.") or (from_id = ".$userId." and to_id = ".$_SESSION['user_id'].")";
        $res=$conn->query($sql);
        if($res->num_rows==0){
            $sql="select * from private_message where (user_1 = ".$_SESSION['user_id']." and user_2= ".$userId.") or (user_1 = ".$userId." and user_2 = ".$_SESSION['user_id'].")";
            $res=$conn->query($sql);
            if($res->num_rows==0){
                $sql = "insert into friend_request(from_id, to_id) values(" . $_SESSION['user_id'] . ", '" . $userId . "')";
                $conn->query($sql);
                header("location: ../friend?msg=1");
                return;
            }
        }
        header("location: ../friend?msg=2");
        return;
    }
    header("location: ../friend?msg=3");
}
else if((isset($_POST['accept'])||isset($_POST['reject']))&&isset($_POST['friend_id'])&&isset($_POST['req_id'])){
    $sql="delete from friend_request where id = ".$_POST['req_id'];
    $conn->query($sql);
    if(isset($_POST['accept'])){
        $sql="insert into private_message(user_1, user_2) values(".$_POST['friend_id'].", ".$_SESSION['user_id'].")";
        $conn->query($sql);
    }
    header("location: ../friend");
}
