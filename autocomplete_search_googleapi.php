
<?php

class Form_GoogleAPI_Enchant
{
    public function __construct()
    {
        add_action('admin_post_nopriv_add_autocomplete', array($this, 'autocomplete_search'));
        add_action('admin_post_add_autocomplete', array($this, 'autocomplete_search'));
        add_action('wp_print_scripts', array($this, 'run_googleapi_script'));
        add_action('wp_footer', array($this, 'my_footer_scripts'));

    }

    public function run_googleapi_script()
    {
        wp_enqueue_script('googleapi', 'http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false&key=AIzaSyBbMTgfW8GI0ThohwYQ8BiSTPEZ1PnrWdc');
        wp_enqueue_script('handle_googleapi', plugin_dir_url(__FILE__) . '/scripts/handle_googleapi.js', $deps = array(), $ver = false, $in_footer = true);
    }


    public function my_footer_scripts()
    {
        ?>
        <script>
            jQuery("#search-box").on('keyup', function (e) {
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo plugins_url('ajax_handle.php', __FILE__)?>",
                    data: 'keyword=' + jQuery(this).val(),
                    success: function (data) {
                        jQuery("#search-results").empty().html(data);
                    }
                });
            });
        </script>
        <?php
    }

    public static function ajax_handle($value)
    {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);

        require_once(dirname(__FILE__) . '/../../../wp-config.php');
        require_once(dirname(__FILE__) . '/../../../wp-load.php');
        global $wpdb;
        $result = $wpdb->get_results("SELECT iso, nicename FROM wp_country WHERE nicename like '%" . $value . "%' LIMIT 0,6", ARRAY_A);

        if (!empty($result)) {
            foreach ($result as $country) { ?>
                <option data-iso="<?php echo $country['iso'] ?>" value="<?php echo $country['nicename']; ?>"></option>
                <?php
            }
        }
    }
}
