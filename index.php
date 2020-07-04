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
    <title>Home</title>
    <link rel="stylesheet" href="/ZunderZhat/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/ZunderZhat/css/index.css">
    <script src="/ZunderZhat/bootstrap/js/bootstrap.min.js"></script>
    <script>
        var currUser = <?= $_SESSION['user_id']; ?>
    </script>
    <script src="/ZunderZhat/js/jquery.js"></script>
    <script src="/ZunderZhat/js/index.js"></script>
</head>

<body>
    <?php
    include 'header.php';
    ?>

    <div class="body-content">
        <div class="chat-part">
            <!-- <div class="chat-content">
                <div class="user">
                    user1
                </div>
                <div class="content">
                    content
                </div>
            </div> -->
        </div>
        <form action="controller/global_chat_controller.php" method="POST">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Input your message" aria-label="Recipient's username" aria-describedby="button-addon2" name="message">
                <div class="input-group-append">
                    <input type="submit" name="send" class="btn btn-outline-secondary" type="button" id="button-addon2" value="Send">
                </div>
            </div>
        </form>

    </div>

</body>

</html>