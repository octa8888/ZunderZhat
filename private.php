<?php
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
    <script src="/ZunderZhat/js/private.js"></script>
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <div class="body-content">
        <div class="chat-part">
            <!-- <div class="chat-content" style="cursor:pointer; width:100% !important;">
                <div class="user">
                    user1
                </div>
            </div> -->
        </div>
    </div>

</body>

</html>