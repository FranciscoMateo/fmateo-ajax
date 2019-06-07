<?php
if (!class_exists('FM_Ajax_Shortcodes')) {

    class FM_Ajax_Shortcodes
    {

        public static function init()
        {
            $shortcodes = array(
                'ajax_search' => __CLASS__ . '::ajax_search',
            );

            foreach ($shortcodes as $shortcode => $function) {
                add_shortcode($shortcode, $function);
            }
        }

        public static function ajax_search()
        {
            wp_register_style('fm-ajax-shortcode-style', plugins_url('/..', __FILE__) . '/assets/css/style-shortcode.css');
            wp_enqueue_style('fm-ajax-shortcode-style');

            wp_register_script('fm-ajax-shortcode-script', plugins_url('/..', __FILE__) . '/assets/js/script-shortcode.js', array('jquery'));

            $data_to_js = array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'messages' => array(
                    'empty' => 'Rellena el texto para empezar a buscar...',
                    'searching' => 'Buscando...',
                    'not_found' => 'No se ha encontrado ningún resultado...',
                    'error' => 'Ha habido algún error...',
                ),
            );

            wp_localize_script('fm-ajax-shortcode-script', 'fm_ajax_data', $data_to_js);
            wp_enqueue_script('fm-ajax-shortcode-script');

            load_template(FM_AJAX_PATH . 'templates/ajax-search.php');

        }
    }
}
