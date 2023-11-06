<?php
$style = get_sub_field('display') ?: 'style1';

if ($style == 'style1') {
?>
<section class="banner-1">
    <picture>
        <img src="<?php echo get_sub_field('banner_thu_nhat'); ?>" alt="">
    </picture>
</section>
<?php }else{ ?>
<section class="banner-2">
    <picture>
        <img src="<?php echo get_sub_field('banner_thu_hai'); ?>" alt="">
    </picture>
    <div class="text-banner">
        <p><?php echo get_sub_field('name'); ?></p>
        <?php
        $content = get_sub_field( 'tieu_de');
        $button = get_sub_field( 'button');
        if ( $content )
        {
            get_template_part(
                'components/section/content',
                null,
                array(
                    'title_tag' => 'h4',
                    'data' => array(
                        'title' => $content['title'],
                        'mo_ta' => $content['mo_ta'],
                    )
                )
            );
        }
        if ( $button )
        {
            get_template_part(
                'components/section/button',
                null,
                array(
                    'data' => array(
                        'title' => $button['button_title'],
                        'link' => $button['button_link'],
                    )
                )
            );
        }
        ?>
    </div>
</section>
<?php } ?>