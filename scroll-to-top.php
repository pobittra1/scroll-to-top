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
