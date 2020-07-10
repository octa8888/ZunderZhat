<?php
include '../helper/include.php';

// sql injection
// csrf
// xss
if(!isset($_POST['csrf_token'])||$_SESSION['csrf_token']!=$_POST['csrf_token']){
    header("location: ".url('register'));
    return;
}

if(isset($_POST['get_data'])){
    // $sql="select pm.id as id, u.id as user1_id, u.username as user1_username, u1.id as user2_id, u1.username as user2_username from private_message pm join user u on pm.user_1=u.id join user u1 on pm.user_2=u1.id where user_1 = ".$_SESSION['user_id']." or user_2 = ".$_SESSION['user_id'];
    // $res=$conn->query($sql);
    $sql="select pm.id as id, u.id as user1_id, u.username as user1_username, u1.id as user2_id, u1.username as user2_username from private_message pm join user u on pm.user_1=u.id join user u1 on pm.user_2=u1.id where user_1 = ? or user_2 = ?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("ii",$_SESSION['user_id'],$_SESSION['user_id']);
    $stmt->execute();
    $res=$stmt->get_result();
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
}
else if(isset($_POST['get_messages'])){
    // $sql="select * from private_message_detail pmv join user u on pmv.user_id=u.id join private_message pm on pm.id=pmv.msg_id where pmv.msg_id = ".$_POST['msg_id']." and (pm.user_1 = ".$_SESSION['user_id']." or pm.user_2 = ".$_SESSION['user_id'].") order by pmv.id";
    // $res=$conn->query($sql);
    $sql="select * from private_message_detail pmv join user u on pmv.user_id=u.id join private_message pm on pm.id=pmv.msg_id where pmv.msg_id = ? and (pm.user_1 = ? or pm.user_2 = ?) order by pmv.id";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("iii",$_POST['msg_id'],$_SESSION['user_id'],$_SESSION['user_id']);
    $stmt->execute();
    $res=$stmt->get_result();
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
}
else if(isset($_POST['message'])&&isset($_POST['msg_id'])){
    if($_POST['message']==""){
        header("location: ../private_chat?msg_id=".$_POST['msg_id']);
        return;
    }
    if(checkMsgUser($conn,$_POST['msg_id'],$_SESSION['user_id'])){
        // $sql = "insert into private_message_detail(msg_id, user_id, message, type) values(".$_POST['msg_id'].",". $_SESSION['user_id'] . ",'" . $_POST['message'] . "','text')";
        // $conn->query($sql);
        $sql = "insert into private_message_detail(msg_id, user_id, message, type) values(?,?,?,'text')";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("iis",$_POST['msg_id'],$_SESSION['user_id'],$_POST['message']);
        $stmt->execute();
    }
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

        if(checkMsgUser($conn,$_POST['msg_id'],$_SESSION['user_id'])){
            // $sql = "insert into private_message_detail(msg_id, user_id, message, type) values(".$_POST['msg_id'].",". $_SESSION['user_id'] . ",'" . $fileName . ".zip','file')";
            // $conn->query($sql);
            $fileName=$fileName.'.zip';
            $sql = "insert into private_message_detail(msg_id, user_id, message, type) values(?,?,?,'file')";
            $stmt=$conn->prepare($sql);
            $stmt->bind_param("iis",$_POST['msg_id'],$_SESSION['user_id'],$fileName);
            $stmt->execute();
        }

        echo "upload success";
    }
    else{
        echo "upload fail";
    }

}

function checkMsgUser($conn, $msgId,$userId){
    // $sql="select * from private_message where id = ".$msgId." and (user_1 = ".$userId." or user_2 = ".$userId.")";
    // $res=$conn->query($sql);
    $sql="select * from private_message where id = ? and (user_1 = ? or user_2 = ?)";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("iii",$msgId,$userId,$userId);
    $stmt->execute();
    $res=$stmt->get_result();
    if($res->num_rows==0){
        return false;
    }
    return true;
}