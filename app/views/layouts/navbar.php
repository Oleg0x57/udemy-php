<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo SITE_ROOT?>"><?php echo APP_NAME?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php echo SITE_ROOT?>/site">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo SITE_ROOT?>/site/about">About</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <?php if (\framework\helpers\SessionHelper::isLoggedIn()):?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo SITE_ROOT?>/users/logout">Logout</a>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?php echo SITE_ROOT?>/users/register">Register</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo SITE_ROOT?>/users/login">Login</a>
                </li>
                <?php endif;?>
            </ul>
        </div>
    </div>
</nav>