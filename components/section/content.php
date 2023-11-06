<?php
$title_tag = $args['title_tag'];

if (isset($args['class_mota'])) {
    $class_mota = $args['class_mota'];
} else {
    $class_mota = "";
}

$title = $args['data']['title'];
$mota = $args['data']['mo_ta'];

?>
<?php if ($title) { ?>
    <<?php echo $title_tag ?> >
        <?php echo $title ?>
    </<?php echo $title_tag ?>>
<?php } ?>
<div class="<?php echo $class_mota?>" >
    <p><?php echo $mota ?></p>
</div>
