<?php require_once APP_ROOT . '/views/layouts/header.php'; ?>
    <a href="<?php echo SITE_ROOT; ?>/posts/index" class="btn btn-warning"><i class="fa fa-backward"></i> Back</a>
    <h1><?php echo $data['post']->title; ?></h1>
    <div class="bg-secondary text-white p-2 mb-3">
        Written by <?php echo $data['post']->user_name; ?> on <?php echo $data['post']->created_at; ?>
    </div>
    <p><?php echo $data['post']->body; ?></p>
<?php if ($data['post']->user_id === $_SESSION['user_id']): ?>
    <a href="<?php echo SITE_ROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-dark"><i
                class="fa fa-pencil"></i> Edit</a>
<form class="float-end" method="post" action="<?php echo SITE_ROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>">
    <input  class="btn btn-danger" type="submit" value="Delete">
</form>
<?php endif; ?>
<?php require_once APP_ROOT . '/views/layouts/footer.php'; ?>