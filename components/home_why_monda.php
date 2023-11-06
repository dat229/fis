<?php

?>

<section class="why-monda">
    <div class="container">
        <div class="why-monda-text">
            <?php
            get_template_part(
                'components/section/content',
                null,
                array(
                    'title_tag' => 'h4',
                    'data' => array(
                        'title' => get_sub_field('tieu_de')['title'],
                        'mo_ta' => get_sub_field('tieu_de')['mo_ta'],
                    )
                )
            );
            ?>
        </div>
        <div class="why-monda-list">
            <?php
                if(get_sub_field('why-monda-list')){
                    foreach (get_sub_field('why-monda-list') as $itemList){
            ?>
                <div class="why-monda-child">
                    <div class="why-monda-child-image">
                        <picture>
                            <img src="<?php echo $itemList['icon'] ?>" alt="">
                        </picture>
                    </div>
                    <div class="why-monda-child-text">
                        <h4><?php echo $itemList['tieu_de'] ?></h4>
                        <p><?php echo $itemList['mo_ta'] ?></p>
                    </div>
                </div>
            <?php
                    }
                }
            ?>
        </div>
    </div>
</section>
