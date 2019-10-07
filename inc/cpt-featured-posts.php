<?php

// function: post_type BEGIN
function featured_postspost_type(){
    
    $labels = array(
                    'name' => __( 'Featured Posts'), 
                    'singular_name' => __('Featured Posts'),
                    'rewrite' => array(
                            'slug' => __( 'featured_posts' ) 
                    ),
                    'add_new' => _x('Add Item', 'featured_posts'), 
                    'edit_item' => __('Edit Featured Post Item'),
                    'new_item' => __('New Featured Post Item'), 
                    'view_item' => __('View Featured Post'),
                    'search_items' => __('Search Featured Posts'), 
                    'not_found' =>  __('No Featured Posts Items Found'),
                    'not_found_in_trash' => __('No Featured Posts Items Found In Trash'),
                    'parent_item_colon' => ''
                );
    $args = array(
                    'labels' => $labels,
                    'public' => true,
                    'publicly_queryable' => true,
                    'show_ui' => true,
                    'query_var' => true,
                    'rewrite' => true,
                    'capability_type' => 'post',
                    'hierarchical' => false,
                    'menu_position' => 21,
                    'supports' => array(
                            'title',
                            'editor',
                            'thumbnail',
                            'excerpt',
                    )
             );
    
    register_post_type(__( 'featured_posts' ), $args);        
} 

// function: featured_postsmessages BEGIN
function featured_posts_messages($messages)
{
    $messages[__( 'featured_posts' )] = 
            array(
                    0 => '', 
                    1 => sprintf(('Featured Post Updated. <a href="%s">View Featured Post</a>'), esc_url(get_permalink($post_ID))),
                    2 => __('Custom Field Updated.'),
                    3 => __('Custom Field Deleted.'),
                    4 => __('Featured Post Updated.'),
                    5 => isset($_GET['revision']) ? sprintf( __('Featured Posts Restored To Revision From %s'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
                    6 => sprintf(__('Featured Post Published. <a href="%s">View Featured Posts</a>'), esc_url(get_permalink($post_ID))),
                    7 => __('Featured Posts Saved.'),
                    8 => sprintf(__('Featured Post Submitted. <a target="_blank" href="%s">Preview Featured Post</a>'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),
                    9 => sprintf(__('Featured Post Scheduled For: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Featured Post</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
                    10 => sprintf(__('Featured Post Draft Updated. <a target="_blank" href="%s">Preview Featured Post</a>'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),
            );
    return $messages;

} // function: featured_postsmessages END

add_action( 'init', 'featured_postspost_type' );
add_filter( 'post_updated_messages', 'featured_posts_messages' );
