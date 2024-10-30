<?php
if (!class_exists('LECSP_COMINGSOON')) {
    class LECSP_COMINGSOON
    {
        function __construct()
        {
            $this->lecsp_plugin_includes();
        }
        function lecsp_plugin_includes()
        {
            add_action('template_redirect', array($this, 'lecsp_template_redirect'));
        }
        function lecsp_is_valid_page()
        {
            return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
        }
        function lecsp_template_redirect()
        {
            if (is_user_logged_in()) {
                //do not display maintenance page
            } else {
                if (!is_admin() && !$this->lecsp_is_valid_page()) {  //show maintenance page
                    $this->lecsp_load_sm_page();
                }
            }
        }
        function lecsp_load_sm_page()
        {
            header('HTTP/1.0 503 Service Unavailable');
            require_once("lecsp-template.php");
            exit();
        }
    }
    $GLOBALS['lecsp_comingsoon'] = new LECSP_COMINGSOON();
}
