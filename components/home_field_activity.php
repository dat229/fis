<?php
$style = get_sub_field('display_field_activity') ?: 'style1';

if ($style == 'style1') {
?>
<section class="field-activity-1">
    <div class="field-activity-image">
        <picture>
            <img src="<?php echo get_sub_field('image')?>" alt="">
        </picture>
    </div>
    <div class="field-activity-text">
        <div class="field-activity-text-child">
            <?php
            $mo_ta_1 = get_sub_field('mo_ta_1');
            if ( $mo_ta_1 )
            {
                get_template_part(
                    'components/section/content',
                    null,
                    array(
                        'title_tag' => 'h4',
                        'data' => array(
                            'title' => $mo_ta_1['title'],
                            'mo_ta' => $mo_ta_1['mo_ta'],
                        )
                    )
                );
            }
            ?>
        </div>
        <div class="tabs">
            <?php
            $list_field_activity_1 = get_sub_field('list_field_activity_1');
            foreach ($list_field_activity_1 as $key=>$item){ ?>
                <div class="tabs-child <?php if($key==1){echo 'showw';} ?>">
                    <div class="tabs-title">
                        <h5><?php echo $item['title']?></h5>
                    </div>
                    <div class="tabs-content">
                        <p><?php echo $item['mo_ta']?></p>
                        <?php
                        $button = $item['button'];
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
                </div>
            <?php }?>
        </div>
        <div class="learn-more">
            <?php
            $buttonMain = get_sub_field('button');
            if ( $buttonMain )
            {
                get_template_part(
                    'components/section/button',
                    null,
                    array(
                        'data' => array(
                            'title' => $buttonMain['button_title'],
                            'link' => $buttonMain['button_link'],
                        )
                    )
                );
            }
            ?>
        </div>
    </div>
</section>
<?php }else{ ?>
<section class="field-activity-2">
    <div class="container">
        <div class="field-activity-title">
            <?php
            $mo_ta_thu_hai = get_sub_field('mo_ta_thu_hai')[0];
            if ( $mo_ta_thu_hai )
            {
                get_template_part(
                    'components/section/content',
                    null,
                    array(
                        'title_tag' => 'h4',
                        'data' => array(
                            'title' => $mo_ta_thu_hai['title'],
                            'mo_ta' => $mo_ta_thu_hai['mo_ta'],
                        )
                    )
                );
            }
            ?>
        </div>
        <div class="field-activity-list">
            <?php
            $list_field_activity_2 = get_sub_field('list_field_activity_2');
            foreach ($list_field_activity_2 as $item){ ?>
                <div class="field-activity-child">
                    <picture>
                        <img src="<?php echo $item['image'] ?>" alt="">
                    </picture>
                    <?php
                        get_template_part(
                            'components/section/content',
                            null,
                            array(
                                'title_tag' => 'h5',
                                'data' => array(
                                    'title' => $item['title'],
                                    'mo_ta' => $item['mo_ta'],
                                )
                            )
                        );
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php } ?>