<?php
/*
Plugin Name:    Context Post Prefix
Description:    Add a post permalink prefix without impacting other object URLs.
Text-Domain:    cwp-post-prefix
Version:        1.1
Author:         Robert Andrews
Author URI:     http://www.robertandrews.co.uk
License:        GPL v2 or later
License URI:    https://www.gnu.org/licenses/gpl-2.0.html
*/

function add_rewrite_rules( $wp_rewrite )
{
    $new_rules = array(
        'post/(.+?)/?$' => 'index.php?post_type=post&name='. $wp_rewrite->preg_index(1),
    );

    $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}
add_action('generate_rewrite_rules', 'add_rewrite_rules'); 

function change_blog_links($post_link, $id=0){

    $post = get_post($id);

    if( is_object($post) && $post->post_type == 'post'){
        return home_url('/post/'. $post->post_name.'/');
    }

    return $post_link;
}
add_filter('post_link', 'change_blog_links', 1, 3);

?>