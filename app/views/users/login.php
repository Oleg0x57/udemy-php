<?php require_once APP_ROOT . '/views/layouts/header.php';?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <?php echo framework\helpers\SessionHelper::flashMessage('registered_success');?>
                    <h2>Login</h2>
                    <p>Please fill your credentials for login</p>
                    <form action="<?php echo SITE_ROOT;?>/users/login" method="POST">
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Email address</label>
                            <input type="email"
                                   class="form-control <?php echo ($data['err_email'] === '') ? '' : 'is-invalid'; ?>"
                                   id="loginEmail" aria-describedby="emailHelp" name="email"
                                   value="<?php echo $data['email'] ?>">
                            <div class="invalid-feedback">
                                <?php echo $data['err_email']; ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Password</label>
                            <input type="password"
                                   class="form-control <?php echo ($data['err_password'] === '') ? '' : 'is-invalid'; ?>"
                                   id="loginPassword" name="password" value="<?php echo $data['password'] ?>">
                            <div class="invalid-feedback">
                                <?php echo $data['err_password']; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                            <div class="col">
                                <a href="<?php echo SITE_ROOT; ?>/users/register" class="btn btn-light btn-block">Have no account? Register</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php require_once APP_ROOT . '/views/layouts/footer.php';?>