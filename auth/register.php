<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="/ZunderZhat/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/ZunderZhat/css/login-register.css">
    <script src="/ZunderZhat/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <form action="controller/register_controller.php" method="POST" class="form-container">
        <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username">
            <div style="color:red">
                <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == 1) {
                        echo "Username already exists";
                    }
                }
                ?>
            </div>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        <br>
        <br>
        <a href="login">Already have account ?</a>
    </form>

</body>

</html>