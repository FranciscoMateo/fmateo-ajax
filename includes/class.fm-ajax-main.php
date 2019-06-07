<?php
if (!class_exists('FM_Ajax_Main')) {
    class FM_Ajax_Main
    {
        protected static $_instance = null;
        public function __construct()
        {
            $require = array(
                'common' => array(
                    'includes/class.fm-ajax-shortcodes.php',
                ),
            );
            $this->_require($require);

            add_action('init', array('FM_Ajax_Shortcodes', 'init'));

            add_action('wp_ajax_fm_ajax_search_action', array($this, 'search_field_action'));
            add_action('wp_ajax_nopriv_fm_ajax_search_action', array($this, 'search_field_action'));
        }

        public function search_field_action()
        {
            $results = array();

            if (isset($_POST['to_search']) && !empty($_POST['to_search'])) {
                $terms_args = array(
                    'name' => $_POST['to_search'],
                    'number' => 1
                );
                $term_object = get_terms('category', $terms_args);
                                
                if(!empty($term_object)){
                    $args = array(
                        'posts_per_page' => -1,
                        'cat' => $term_object[0]->term_id
                    );
                    $posts = get_posts($args);
    
                    foreach ($posts as $post) {
                        $results[] = array(
                            'title' => get_the_title($post),
                            'permalink' => get_permalink($post),
                        );
                    }
                }                
            }
            wp_send_json($results);
        }

        protected function _require($require_classes)
        {
            foreach ($require_classes as $section => $classes) {
                foreach ($classes as $class) {
                    if ('common' == $section || ('frontend' == $section && !is_admin() || (wp_doing_ajax())) || ('admin' == $section && is_admin()) && file_exists(FM_AJAX_PATH . $class)) {
                        require_once FM_AJAX_PATH . $class;
                    }
                }
            }
        }
        public static function instance()
        {
            if (is_null(self::$_instance)) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }
    }
}
