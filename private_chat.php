<?php
debug_backtrace() || header("location: index");

include 'helper/include.php';
if (!isset($_SESSION['user_id'])) {
    header("location: login");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Private Chat</title>
    <link rel="stylesheet" href="/ZunderZhat/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/ZunderZhat/css/index.css">
    <script src="/ZunderZhat/bootstrap/js/bootstrap.min.js"></script>
    <script>
        var currUser = <?= $_SESSION['user_id']; ?>
    </script>
    <script src="/ZunderZhat/js/jquery.js"></script>
    <script src="/ZunderZhat/js/private_chat.js"></script>
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <script>
        var msgId = <?=$_GET['msg_id']?>;
        var csrf_token = "<?=$_SESSION['csrf_token']?>";
    </script>

    <div class="body-content">
        <div class="chat-part" id="file_upload" ondrop="uploadFile(event)" ondragover="return false">
            <!-- <div class="chat-content">
                <div class="user">
                    user1
                </div>
                <div class="content">
                    content
                </div>
            </div> -->
        </div>
        <form action="/ZunderZhat/controller/private_chat_controller.php" method="POST">
            <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']?>">
            <input type="hidden" name="msg_id" value="<?=$_GET['msg_id']?>">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Input your message" name="message">
                <div class="input-group-append">
                    <input type="submit" name="send" class="btn btn-outline-secondary" type="button" id="button-addon2" value="Send">
                </div>
            </div>
        </form>
    </div>

</body>

</html>