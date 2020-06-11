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
    <title>Friend</title>
    <link rel="stylesheet" href="/ZunderZhat/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/ZunderZhat/css/index.css">
    <script src="/ZunderZhat/bootstrap/js/bootstrap.min.js"></script>
    <script>
        var currUser = <?= $_SESSION['user_id']; ?>
    </script>
    <script src="/ZunderZhat/js/jquery.js"></script>
    <script src="/ZunderZhat/js/friend.js"></script>
</head>

<body>
    <?php
    include 'header.php';
    ?>

    <div class="body-content">
        <form action="controller/friend_controller.php" method="POST">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Input your message" aria-label="Recipient's username" aria-describedby="button-addon2" name="username">
                <div class="input-group-append">
                    <input type="submit" name="send" class="btn btn-outline-secondary" type="button" id="button-addon2" value="Send">
                </div>
            </div>
        </form>
        <div class="friend-part">
            <!-- <div class="req">
                <h2>
                    User
                </h2>
                <div style="display:flex">
                    <form action="controller/friend_controller.php" method="post" style="margin-right:1vw">
                        <input type="hidden" name="user_id" value="">
                        <input type="hidden" name="req_id" value="">
                        <button type="submit" class="btn btn-primary" name="accept">Accept</button>
                    </form>
                    <form action="controller/friend_controller.php" method="post">
                        <input type="hidden" name="user_id" value="">
                        <button type="submit" class="btn btn-danger" name="reject">Reject</button>
                    </form>
                </div>
            </div> -->
        </div>
    </div>

</body>

</html>