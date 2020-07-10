<nav class="navbar navbar-expand-lg navbar-light" style="background-color:#6c757d;">
    <a class="navbar-brand" href="/ZunderZhat" style="color:white">ZunderZhat</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index" style="color:white">Global</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="private" style="color:white">Private</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="friend" style="color:white">Friends</a>
            </li>
        </ul>
        <?php
            $_SESSION['csrf_token']=bin2hex(random_bytes(32));
        ?>
        <form action="controller/logout_controller.php" method="POST" class="form-inline my-2 my-lg-0">
            <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']?>">
            <button class="btn btn-1 btn-outline-danger my-2 my-sm-0" type="submit">Log Out</button>
        </form>
    </div>
</nav>