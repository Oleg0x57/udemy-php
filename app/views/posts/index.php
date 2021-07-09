<?php require_once APP_ROOT . '/views/layouts/header.php'; ?>
<?php echo framework\helpers\SessionHelper::flashMessage('post_message');?>
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Posts</h1>
        </div>
        <div class="col-md-6">
            <a class="btn btn-primary float-end" href="<?php echo SITE_ROOT ?>/posts/add">
                <i class="fa fa-plus"></i>Add post
            </a>
        </div>
    </div>
<?php //\framework\helpers\ArrayHelper::d($data); ?>
<?php foreach ($data['posts'] as $post): ?>
    <div class="card card-body mb-3">
        <h4 class="card-title"><?php echo $post->title; ?></h4>
        <div class="bg-light p-2 mb-3">
            Written by <?php echo $post->user_name; ?> on <?php echo $post->created_at; ?>
        </div>
        <p class="card-text"><?php echo $post->body; ?></p>
        <a class="btn btn-dark" href="<?php echo SITE_ROOT ?>/posts/show/<?php echo $post->id ?>">More</a>
    </div>
<?php endforeach; ?>
<?php require_once APP_ROOT . '/views/layouts/footer.php'; ?>