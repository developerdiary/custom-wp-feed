/*
Add below code in functions.php file
*/


function the_new_popular_post_feed() {
    add_feed('popularpost', 'a_new_feed');
}
add_action('init', 'the_new_popular_post_feed');
function a_new_feed() {
    add_filter('pre_option_rss_use_excerpt', '__return_zero');
    load_template( TEMPLATEPATH . '/feeds/popular-feed-template.php' );
}
