<?php
include '../helper/include.php';
if(isset($_POST['get_data'])){
    $sql="select pm.id as id, u.id as user1_id, u.username as user1_username, u1.id as user2_id, u1.username as user2_username from private_message pm join user u on pm.user_1=u.id join user u1 on pm.user_2=u1.id where user_1 = ".$_SESSION['user_id']." or user_2 = ".$_SESSION['user_id'];
    $res=$conn->query($sql);
    $arr=array();
    while($row=$res->fetch_assoc()){
        $arr[]=$row;
    }
    echo json_encode($arr);
}
else if(isset($_POST['get_messages'])){
    $sql="select * from private_message_detail pmv join user u on pmv.user_id=u.id join private_message pm on pm.id=pmv.msg_id where pmv.msg_id = ".$_POST['msg_id']." and (pm.user_1 = ".$_SESSION['user_id']." or pm.user_2 = ".$_SESSION['user_id'].") order by pmv.id";
    $res=$conn->query($sql);
    $arr=array();
    while($row=$res->fetch_assoc()){
        $arr[]=$row;
    }
    echo json_encode($arr);
}
else if(isset($_POST['message'])&&isset($_POST['msg_id'])){
    if($_POST['message']==""){
        header("location: ../private_chat?msg_id=".$_POST['msg_id']);
        return;
    }
    $sql = "insert into private_message_detail(msg_id, user_id, message) values(".$_POST['msg_id'].",". $_SESSION['user_id'] . ",'" . $_POST['message'] . "')";
    $conn->query($sql);

    header("location: ../private_chat?msg_id=".$_POST['msg_id']);
}
else if(isset($_POST['file_upload'])){
    $fileName=time()."_".explode('.',$_FILES['file']['name'])[0];
    // move_uploaded_file($_FILES['file']['tmp_name'], '../uploads/'.$fileName);
    $zip=new ZipArchive();
    $fileZip='../uploads/'.$fileName.'.zip';
    $zipping=$zip->open($fileZip,ZipArchive::CREATE);
    if($zipping){
        $zip->addFromString($_FILES['file']['name'], file_get_contents($_FILES['file']['tmp_name']));
        $zip->close();
        

        echo "upload success";
    }
    else{
        echo "upload fail";
    }

}