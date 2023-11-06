<?php
    $so_luong_kol = get_sub_field('so_luong');

    $args = array(
        'post_type' => 'kol',
        'post_status' => 'publish',
        'posts_per_page' => $so_luong_kol,
    );

    $list_kol = new WP_Query($args);

?>

<div class="container">
    <section class="public-figure">
        <div class="public-figure-text">
            <h4>Nhân vật công chúng</h4>
            <p>KOLs tại V-Top</p>
        </div>
        <div class="public-figure-list">
            <?php
                if($list_kol->have_posts()){
                    $classID = 1;
                    while ($list_kol->have_posts()){
                        $list_kol->the_post();
                        $list_social = get_field('link_socail');
            ?>
                <div class="public-figure-child">
                    <picture>
                        <img src="<?php fis_post_thumbnail_full() ?>" alt="">
                    </picture>
                    <div class="public-figure-child-info">
                        <div>
                            <h5 class="btn-show-info-d<?php echo $classID?>"><?php the_title() ?></h5>
                            <p>V-Top Channel</p>
                        </div>
                        <ul>
                            <li><?php the_field('so_luot_thich')?> lượt thích trên tiktok</li>
                            <li><?php the_field('followers')?> followers</li>
                            <li><?php the_field('video_thinh_hanh')?> virual videos</li>
                        </ul>
                        <div class="socail-info">
                            <?php
                                if($list_social){
                                    foreach ($list_social as $itemSocial){
                            ?>
                                <picture>
                                    <a href="<?php echo $itemSocial['link']?>">
                                        <img src="<?php echo $itemSocial['image'] ?>" alt="">
                                    </a>
                                </picture>
                            <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <h4><?php the_title() ?></h4>
                </div>
                <script !src="">
                    $(document).ready(function(){
                        $('.btn-show-info-d<?php echo $classID?>').click(function(){
                            $('.d<?php echo $classID?>').fadeIn()
                            $('.overlay').fadeIn()
                        })
                    });
                </script>
            <?php
                        $classID++;
                    }
                    wp_reset_postdata();
                }
            ?>
        </div>
    </section>
</div>
<?php
if($list_kol->have_posts()){
    $classID = 1;
    while ($list_kol->have_posts()){
    $list_kol->the_post();
    $list_image = get_field('danh_sach_anh');
    $list_social = get_field('link_socail');
?>
<section class="pockup-info d<?php echo $classID?>">
    <div class="pockup-info-child">
        <div class="info-image">
            <?php
            if($list_image){
                foreach ($list_image as $itemImage){
                    ?>
                    <div class="info-image-child">
                        <picture>
                            <img src="<?php echo $itemImage?>" alt="">
                        </picture>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <div class="info-detail">
            <h4><?php the_title() ?></h4>
            <div class="info-detail-child">
                <h5>Thông tin cơ bản:</h5>
                <ul>
                    <li>Tên / nghệ danh phát sóng trực tiếp: <?php the_field('nghe_danh') ?> </li>
                    <li>ID Tiktok: <?php the_field('id_tiktok') ?></li>
                    <li>Số người theo dõi: <?php the_field('so_nguoi_theo_doi') ?></li>
                    <li>Số người hâm mộ trên mọi nền tảng: <?php the_field('tong_so_nguoi_theo_doi') ?></li>
                    <li>Nhãn hiệu cá nhân: <?php the_field('nhan_hieu_ca_nhan') ?></li>
                    <li>Vị trí: <?php the_field('vi_tri') ?></li>
                </ul>
            </div>
            <div class="info-detail-child">
                <h5>Hồ sơ cá nhân</h5>
                <p><?php the_field('ho_so_ca_nhan') ?></p>
            </div>
            <div class="social">
                <h5>Social link</h5>
                <div class="social-link">
                    <?php
                    if($list_social){
                        foreach ($list_social as $itemSocial){
                            ?>
                            <picture>
                                <a href="<?php echo $itemSocial['link']?>">
                                    <img src="<?php echo $itemSocial['image'] ?>" alt="">
                                </a>
                            </picture>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
        $classID++;
    }
    wp_reset_postdata();
}
?>