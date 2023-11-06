<?php
    $args = array(
        'post_type' => 'event_kol',
        'post_status' => 'publish',
        'posts_per_page' => 3
    );
    $get_post = new WP_Query($args);

?>

<div class="container">
    <section class="event-news">
        <div class="event-news-title">
            <?php
                get_template_part(
                    'components/section/content',
                    null,
                    array(
                        'title_tag' => 'h4',
                        'data' => array(
                            'title' => get_sub_field('title'),
                            'mo_ta' => get_sub_field('mo_ta'),
                        )
                    )
                );
            ?>
        </div>
        <div class="event-news-list">
            <?php
//            print_r($get_post);
                if($get_post->have_posts()){
                    while ($get_post->have_posts()){
                        $get_post->the_post();
                        echo get_the_ID();
            ?>
                <a href="<?php the_permalink(get_the_ID()) ?>">
                    <div class="event-news-child">
                        <picture>
                            <img src="<?php echo fis_post_thumbnail_full() ?>" alt="">
                        </picture>
                        <div class="event-news-child-text">
                            <p>
                                <img src="<?php echo get_template_directory_uri();?>/dist/img/date.svg" alt="">
                                <span><?php the_date('d/M/y') ?></span>
                            </p>
                            <h5><?php the_title() ?> </h5>
                        </div>
                    </div>
                </a>
            <?php
                    }
                    wp_reset_postdata();
                }
            ?>
        </div>
    </section>
</div>