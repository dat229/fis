<?php

/**
 * CF7
 */
function create_shortcode_button()
{
    if (get_sub_field('title_form')) {
        $title_form = get_sub_field('title_form');
    } else {
        $title_form = get_field('cdc_form_title_form', 'option');
    }
    return $title_form;
}
add_shortcode('title_button', 'create_shortcode_button');


function create_shortcode_cf7_linh_vuc()
{
    ob_start();
    if (get_sub_field('cf7_linh_vuc')) {
?>
        <div class="col-field">
            <div class="form-group">
                <span class="wpcf7-form-control-wrap" data-name="your-linhvuc"><input size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" value="" type="text" name="your-linhvuc" /></span>
                <label for="">
                    <?php _e('Lĩnh vực', 'fis') ?><span>*</span>
                </label>
            </div>
        </div>
        <?php if (have_rows('cf7_khu_vuc')) { ?>
            <div class="col-area">
                <div class="form-group">
                    <span class="wpcf7-form-control-wrap" data-name="your-khuvuc">
                        <select class="wpcf7-form-control wpcf7-select" aria-invalid="false" name="your-khuvuc">
                            <option value="<?php _e('Khu vực', 'fis') ?>"><?php _e('Khu vực', 'fis') ?></option>
                            <?php while (have_rows('cf7_khu_vuc')) : the_row(); ?>
                                <option value="<?php the_sub_field('khuvuc') ?>"><?php the_sub_field('khuvuc') ?></option>
                            <?php endwhile; ?>
                        </select>
                    </span>
                </div>
            </div>
        <?php } ?>
<?php
    }
    $list_post = ob_get_contents();


    ob_end_clean();


    return $list_post;
}
add_shortcode('cf7_linh_vuc', 'create_shortcode_cf7_linh_vuc');
