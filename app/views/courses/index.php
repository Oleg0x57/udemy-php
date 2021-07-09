<?php require_once APP_ROOT . '/views/layouts/header.php';?>
    <h1><?php echo isset($data['h1']) ?? ''?></h1>
<table>
    <thead>
    <th>ID</th>
    <th>title</th>
    <th>price</th>
    </thead>
    <tbody>

<?php foreach ($data['courses'] as $course) {?>
    <tr>
        <td><?php echo $course->id; ?></td>
        <td><?php echo $course->name; ?></td>
        <td><?php echo $course->cost; ?></td>
    </tr>
    <?php } ?>


    </tbody>
</table>
<?php require_once APP_ROOT . '/views/layouts/footer.php';?>