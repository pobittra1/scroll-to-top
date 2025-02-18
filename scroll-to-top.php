<?php
/*
plugin Name: Scroll to Top
Description: This plugin will add a scroll to top button on the bottom right corner of the page.
Author: Pobittra pobi
Version: 1.0.0
requires at least: 5.2
requires PHP: 7.2
plugin URI: https://www.wordpress.org/plugins/scroll-to-top
Author URI: https://www.pobittrapobi.com
License: GPL v2 or later
license URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: pstt



*/

// include css and js file
// css
function pstt_add_css_file()
{
    wp_enqueue_style('pstt-style', plugins_url('css/pstt-style.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'pstt_add_css_file');

//js
function pstt_add_js_file()
{

    wp_enqueue_script('jquery');
    wp_enqueue_script('pstt-js', plugins_url('js/pstt.pligin.js', __FILE__), array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'pstt_add_js_file');

//plugin setting activation
function pstt_activation()
{
?>
    <script>
        jQuery(document).ready(function() {
            $.scrollUp();
        })
        jQuery(document).ready(function($) {
            if ($.fn.scrollUp) {
                $.scrollUp({
                    scrollText: '',
                    scrollSpeed: 500
                });
            } else {
                console.error("ScrollUp plugin not loaded.");
            }
        });
    </script>

<?php
}
add_action('wp_footer', 'pstt_activation');




function pstt_customize_register($wp_customize)
{
    // Add a Section for Scroll-to-Top Settings
    $wp_customize->add_section('pstt_customizer_section', array(
        'title'    => __('Scroll-to-Top Settings', 'pstt'),
        'priority' => 30,
    ));

    // Add a Setting for Background Color
    $wp_customize->add_setting('pstt_icon_bg_color', array(
        'default'   => '#000000', // Default color: Black
        'sanitize_callback' => 'sanitize_hex_color', // Ensure valid HEX color
    ));

    // Add the Color Picker Control
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'pstt_icon_bg_color_control', array(
        'label'    => __('Icon Background Color', 'pstt'),
        'section'  => 'pstt_customizer_section',
        'settings' => 'pstt_icon_bg_color',
    )));
    // Add a Setting for Background Color
    $wp_customize->add_setting('pstt_icon_border', array(
        'default'   => '2px', // Default color: Black

    ));

    // Add the Color Picker Control
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'pstt_icon_border_control', array(
        'label'    => __('Icon border', 'pstt'),
        'section'  => 'pstt_customizer_section',
        'settings' => 'pstt_icon_border',
        'type' => 'text'
    )));
}
add_action('customize_register', 'pstt_customize_register');

//theme css customization
function pstt_custom_css()
{
?>
    <style type="text/css">
        a#scrollUp {
            background-color: <?php echo get_theme_mod('pstt_icon_bg_color'); ?>;
            border-radius: <?php echo get_theme_mod('pstt_icon_border'); ?>;
        }
    </style>
<?php
}
add_action('wp_footer', 'pstt_custom_css');
