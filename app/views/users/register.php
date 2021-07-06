<?php require_once APP_ROOT . '/views/layouts/header.php'; ?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body"
                <h2>Create an account</h2>
                <p>Please fill out this form to register with us</p>
                <form action="<?php echo SITE_ROOT; ?>/users/register" method="POST">
                    <div class="mb-3">
                        <label for="registerName" class="form-label">Name</label>
                        <input class="form-control <?php echo ($data['err_name'] === '') ? '' : 'is-invalid'; ?>"
                               id="registerName" aria-describedby="emailHelp" name="name"
                               value="<?php echo $data['name'] ?>">
                        <div class="invalid-feedback">
                            <?php echo $data['err_name']; ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="registerEmail" class="form-label">Email address</label>
                        <input type="email"
                               class="form-control <?php echo ($data['err_email'] === '') ? '' : 'is-invalid'; ?>"
                               id="registerEmail" aria-describedby="emailHelp" name="email"
                               value="<?php echo $data['email'] ?>">
                        <div class="invalid-feedback">
                            <?php echo $data['err_email']; ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="registerPassword" class="form-label">Password</label>
                        <input type="password"
                               class="form-control <?php echo ($data['err_password'] === '') ? '' : 'is-invalid'; ?>"
                               id="registerPassword" name="password" value="<?php echo $data['password'] ?>">
                        <div class="invalid-feedback">
                            <?php echo $data['err_password']; ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="registerConfirmPassword" class="form-label">Confirm password</label>
                        <input type="password"
                               class="form-control <?php echo ($data['err_confirm_password'] === '') ? '' : 'is-invalid'; ?>"
                               id="registerConfirmPassword"
                               name="confirm_password"
                               value="<?php echo $data['confirm_password'] ?>">
                        <div class="invalid-feedback">
                            <?php echo $data['err_confirm_password']; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                        <div class="col">
                            <a href="<?php echo SITE_ROOT; ?>/users/login" class="btn btn-light btn-block">Already have an account? Login</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
<?php require_once APP_ROOT . '/views/layouts/footer.php'; ?>