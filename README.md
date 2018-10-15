# Custom-wp-feed

Create custom wordpress Popular post feed using query

# Set view post code

```php
function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);


function wpb_track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;    
    }
    wpb_set_post_views($post_id);
}
add_action( 'wp_head', 'wpb_track_post_views');
```
# Creating a function for new custom feed

```php
function the_new_popular_post_feed() {
    add_feed('popularpost', 'a_new_feed');
}
add_action('init', 'the_new_popular_post_feed');
function a_new_feed() {
    add_filter('pre_option_rss_use_excerpt', '__return_zero');
    load_template( TEMPLATEPATH . '/feeds/popular-feed-template.php' );
}
```
