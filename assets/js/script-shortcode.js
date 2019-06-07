jQuery(document).ready(function ($) {

    init_ajax_search();

    function init_ajax_search() {
        refresh_to_empty_message();
        $('.ajax_search_button').on('click', function () {
            $ajax_search_input = $('.ajax_search_input').val();

            if (0 >= $ajax_search_input.length) {
                refresh_to_empty_message();
            } else {
                start_search($ajax_search_input);
            }
        });
    }

    function start_search(to_search) {

        $.ajax({
            url: fm_ajax_data.ajax_url,
            type: 'POST',
            data: {
                action: 'fm_ajax_search_action',
                to_search: to_search
            },
            beforeSend: function () {
                $('.ajax_search_result_list').text(fm_ajax_data.messages.searching);
            },
            success: function (results) {
                if (0 <= results.length) {

                    $('.ajax_search_result_list').text('');

                    results.forEach(function (result) {
                        $list_item = $('<li>');
                        $a_item = $('<a>');

                        $a_item.attr('href', result.permalink);
                        $a_item.text(result.title);

                        $list_item.append($a_item);
                        $('.ajax_search_result_list').append($list_item);
                    });
                }
            }
        });
    }

    function refresh_to_empty_message() {
        $('.ajax_search_result_list').text(fm_ajax_data.messages.empty);
    }

});