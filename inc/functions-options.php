<?php
/**
 * Functions Skillfully needs for Options Framework
 * @package skillfully
 * since Skillfully 1.0
 */
 
/**
 * Options Framework.
 *
 *
 */
 
require_once( get_template_directory() . "/inc/support/support.php"); // Load support tab
 
if ( current_user_can( 'install_plugins' ) ) {	
	skillfully_of_check();
}

function skillfully_of_check() {
	if ( !function_exists('of_get_option') ) {
		add_action('admin_notices', 'skillfully_of_check_notice');
	}
}

// Options Framework Admin Notice
function skillfully_of_check_notice() { ?>
	<div class="updated">
		<p><?php _e('The Options Framework plugin is required for this theme to function properly.', 'skillfully'); ?> <a href="<?php echo esc_url(network_admin_url('plugin-install.php?tab=plugin-information&plugin=options-framework&TB_iframe=true&width=640&height=517')); ?>" class="thickbox onclick"><?php _e('Install now', 'skillfully'); ?></a>.</p>
	</div>
<?php }

if ( !function_exists( 'of_get_option' ) ) {
	function of_get_option($name, $default = 'false') {

		$optionsframework_settings = get_option('optionsframework');

		// Gets the unique option id
		$option_name = $optionsframework_settings['id'];

		if ( get_option($option_name) ) {
			$options = get_option($option_name);
		}

		if ( !empty($options[$name]) ) {
			return $options[$name];
		} else {
			return $default;
		}
	}
}

add_action('optionsframework_custom_scripts', 'skillfully_custom_scripts');

function skillfully_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	// adds support tab
	jQuery(".embed-themes").html("<iframe width='770' height='390' src='http://themes.designcrumbs.com/iframe/index.html'></iframe>");

});
</script>

<?php
}

/* Removes the code stripping */

add_action('admin_init','optionscheck_change_santiziation', 100);

function optionscheck_change_santiziation() {
    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
    add_filter( 'of_sanitize_textarea', 'of_sanitize_textarea_custom' );
}

function of_sanitize_textarea_custom($input) {
    global $allowedposttags;
        $of_custom_allowedtags["embed"] = array(
			"src" => array(),
			"type" => array(),
			"allowfullscreen" => array(),
			"allowscriptaccess" => array(),
			"height" => array(),
			"width" => array()
		);
		$of_custom_allowedtags["script"] = array(
			"type" => array()
		);
		$of_custom_allowedtags["iframe"] = array(
			"height" => array(),
			"width" => array(),
			"src" => array(),
			"frameborder" => array(),
			"allowfullscreen" => array()
		);
		$of_custom_allowedtags["object"] = array(
			"height" => array(),
			"width" => array()
		);
		$of_custom_allowedtags["param"] = array(
			"name" => array(),
			"value" => array()
		);

	$of_custom_allowedtags = array_merge($of_custom_allowedtags, $allowedposttags);
	$output = wp_kses( $input, $of_custom_allowedtags);
	return $output;
}

/* 
 * Recreate the default filters on the_content
 * this will make it much easier to output the meta content with proper/expected formatting
 * call with - echo apply_filters('skillfully_meta_content', $text); where $text = of_get_option('ID');
*/
add_filter( 'skillfully_meta_content', 'wptexturize' );
add_filter( 'skillfully_meta_content', 'convert_smilies' );
add_filter( 'skillfully_meta_content', 'convert_chars'  );
add_filter( 'skillfully_meta_content', 'wpautop' );
add_filter( 'skillfully_meta_content', 'shortcode_unautop'  );
add_filter( 'skillfully_meta_content', 'do_shortcode'  );
add_filter( 'skillfully_meta_content', 'prepend_attachment' );