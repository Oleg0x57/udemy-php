<?php require_once APP_ROOT . '/views/layouts/header.php'; ?>
    <div class="card">
        <div class="card-body">
            <h2>Edit post</h2>
            <p>Edit post <?php echo $data['title'] ?></p>
            <form action="<?php echo SITE_ROOT; ?>/posts/edit/<?php echo $data['id']; ?>" method="POST">
                <div class="mb-3">
                    <label for="loginEmail" class="form-label">Title address</label>
                    <input class="form-control <?php echo ($data['err_title'] === '') ? '' : 'is-invalid'; ?>"
                           id="loginTitle" aria-describedby="titleHelp" name="title"
                           value="<?php echo $data['title'] ?>">
                    <div class="invalid-feedback">
                        <?php echo $data['err_title']; ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="loginBody" class="form-label">Body</label>
                    <textarea class="form-control <?php echo ($data['err_body'] === '') ? '' : 'is-invalid'; ?>"
                              id="loginBody" name="body"><?php echo $data['body'] ?></textarea>
                    <div class="invalid-feedback">
                        <?php echo $data['err_body']; ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Save</button>
                <a href="<?php echo SITE_ROOT; ?>/posts/index" class="btn btn-warning float-end">
                    <i class="fa fa-backward"></i> Cancel</a>
            </form>
        </div>
    </div>
<?php require_once APP_ROOT . '/views/layouts/footer.php'; ?>