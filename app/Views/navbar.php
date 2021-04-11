<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="/images/logo.png" width="150">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <?php if($loginResponse == null): ?>
                        <a class="btn btn-primary nav-link" href="/login">Login</a>
                    <?php endif ?>

                    <?php if($loginResponse != null): ?>
                        <a class="btn btn-danger nav-link" href="/logout">Logout</a>
                    <?php endif ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
