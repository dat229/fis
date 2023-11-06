<?php
$style = get_sub_field('display') ?: 'style1';
$mo_ta_chung = get_sub_field('mo_ta_chung');

if ($style == 'style1') {
?>
<section class="about-us-1">
    <div class="about-text">
        <?php
        $button = get_sub_field( 'button');
        if ( $mo_ta_chung )
        {
            get_template_part(
                'components/section/content',
                null,
                array(
                    'title_tag' => 'h4',
                    'class_mota' => 'about-text-child',
                    'data' => array(
                        'title' => $mo_ta_chung['title'],
                        'mo_ta' => $mo_ta_chung['mo_ta'],
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
    <div class="about-image">
        <?php
            $gallery = get_sub_field('anh_ben_phai');
            foreach ($gallery as $key=>$item){
        ?>
            <div class="about-image-<?php echo $key+1?>">
                <picture>
                    <img src=" <?php echo $item ?> " alt="">
                </picture>
            </div>
        <?php }?>
    </div>
</section>
<?php }else if($style=='style2'){ ?>
<section class="about-us-2">
    <div class="about-image">
        <picture>
            <img src="<?php echo get_sub_field('anh_ben_trai')?>" alt="">
        </picture>
    </div>
    <div class="about-text">
        <?php
        $button = get_sub_field( 'button');
        if ( $mo_ta_chung )
        {
            get_template_part(
                'components/section/content',
                null,
                array(
                    'title_tag' => 'h4',
                    'class_mota' => 'about-text-child',
                    'data' => array(
                        'title' => $mo_ta_chung['title'],
                        'mo_ta' => $mo_ta_chung['mo_ta'],
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
<?php }else{
        $content = get_sub_field('content');
    ?>
<section class="about-us-3">
    <div class="about-us-3-title">
        <?php
        if ( $mo_ta_chung )
        {
            get_template_part(
                'components/section/content',
                null,
                array(
                    'title_tag' => 'h4',
                    'data' => array(
                        'title' => $mo_ta_chung['title'],
                        'mo_ta' => $mo_ta_chung['mo_ta'],
                    )
                )
            );
        }
        ?>
    </div>
    <div class="about-us-3-wrapper">
        <?php foreach ($content as $item){ ?>
        <div class="about-us-3-child">
            <?php
            if ( $item )
            {
                get_template_part(
                    'components/section/content',
                    null,
                    array(
                        'title_tag' => 'h5',
                        'data' => array(
                            'title' => $item['tieu_de'],
                            'mo_ta' => $item['mo_ta'],
                        )
                    )
                );
            }
            ?>
        </div>
        <?php }?>
    </div>
</section>
<?php }?>