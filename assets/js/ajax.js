function ajax_post_value(clear) {
    if (clear == true) {
        jQuery('.gnws-button-xemthem').attr('data-offset', 0);
        jQuery('.gnws-xemthem-wrap').empty();
    }
    var button = jQuery(".gnws-button-xemthem");
    var append = button.closest('.gnws-xemthem-wrap_all').find('.gnws-xemthem-wrap');
    append.addClass('loading');
    button.removeClass('d-none');
    button.addClass('loading');
    button.prop('disabled', true);
    var category = button.attr('data-category');
    var danh_muc_cau_chuyen = button.attr('data-danh_muc_cau_chuyen');
    var dich_vu = button.attr('data-dich_vu');
    var san_pham = button.attr('data-san_pham');
    var the_khach_hang = button.attr('data-the_khach_hang');
    var linh_vuc = button.attr('data-linh_vuc');
    var nang_luc = button.attr('data-nang_luc');
    var post_tag = button.attr('data-post_tag');
    var bvnb = button.attr('data-bvnb');
    var wrap = button.attr('data-wrap');
    var number = parseInt(button.attr('data-number'));
    var template = button.attr('data-template');
    var post_type = button.attr('data-post_type');
    var offset = parseInt(button.attr('data-offset'));
    var display_category = button.attr('data-display_category');
    var template_class = button.attr('data-template_class');
    var search_page = button.attr('data-search_page');
    var date_query = button.attr('data-date_query');
    if (jQuery('.gnws_form-search_ajax').length) {
        var search = jQuery('.gnws_value-search_ajax').val();
        jQuery('.gnws-button-xemthem').attr('data-search', search);
    } else {
        var search = '';
    }

    jQuery.ajax({
        type: "POST",
        url: ajax.ajax_url,
        data: {
            "action": "gnws_load_more_post",
            "category": category,
            "danh_muc_cau_chuyen": danh_muc_cau_chuyen,
            "dich_vu": dich_vu,
            "san_pham": san_pham,
            "the_khach_hang": the_khach_hang,
            "linh_vuc": linh_vuc,
            "nang_luc": nang_luc,
            "post_tag": post_tag,
            "bvnb": bvnb,
            "wrap": wrap,
            "number": number,
            "template": template,
            "post_type": post_type,
            "offset": offset,
            "display_category": display_category,
            "template_class": template_class,
            "search": search,
            "date_query": date_query,
            "search_page": search_page
        },
        success: function(response) {
            var result = JSON.parse(response);
            if (result.status == true) {
                if (clear == true) {
                    jQuery('.gnws-button-xemthem').attr('data-offset', 0);
                    jQuery('.gnws-xemthem-wrap').empty();
                }
                button.removeClass('loading');
                button.prop('disabled', false);
                button.attr('data-count', result.count);
                offset = offset + number;
                button.attr('data-offset', offset);
                if (offset >= result.count) {
                    button.addClass('d-none');
                }
                append.removeClass('loading');
                append.append(result.content);
            }
        }
    });
}
jQuery(".gnws-button-xemthem").click(function() {
    ajax_post_value();
});
jQuery(".gnws_button-search_ajax").click(function(event) {
    event.preventDefault();
    ajax_post_value(clear = true);
});
jQuery(".gnws-xemthem-wrap_all_total_select_date").change(function() {
    var value = jQuery(this).find(":selected").val();
    jQuery('.gnws-button-xemthem').attr('data-date_query', value);
    ajax_post_value(clear = true);
});
jQuery(".gnws-xemthem-wrap_all_total_select").change(function() {
    var select = jQuery(this);
    select.addClass('loading');
    var all_total = select.closest('.gnws-xemthem-wrap_all_total');
    var filter = select.closest('.gnws-xemthem-wrap_all_total_filter');
    var filter_item = filter.find('.filter-item');
    var button = all_total.find('.gnws-button-xemthem');
    jQuery(filter_item).each(function() {
        var filter_item_att = jQuery(this).attr('data-filter');
        var selectedValues = [];
        jQuery(jQuery(this).find('input')).each(function() {
            if (jQuery(this).is(":checked")) {
                selectedValues.push(jQuery(this).val());
            }
        });
        if (selectedValues.length === 0) {
            button.attr('data-' + filter_item_att, 0);
        } else {
            button.attr('data-' + filter_item_att, selectedValues.join(","));
        }
    });
    ajax_post_value(clear = true);
    select.removeClass('loading');
});