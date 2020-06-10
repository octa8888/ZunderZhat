<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">ZunderZhat</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index">Global</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="private">Private</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="friend">Friends</a>
            </li>
        </ul>
        <form action="controller/logout_controller.php" method="POST" class="form-inline my-2 my-lg-0">
            <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Log Out</button>
        </form>
    </div>
</nav>