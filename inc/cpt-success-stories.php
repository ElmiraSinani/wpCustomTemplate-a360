<?php

// function: post_type BEGIN
function success_stories_post_type(){
    
    $labels = array(
                    'name' => __( 'Success Stories'), 
                    'singular_name' => __('Success Story'),
                    'rewrite' => array(
                        'slug' => __( 'success_stories' ) 
                    ),
                    'add_new' => _x('Add Item', 'success_stories'), 
                    'edit_item' => __('Edit Featured Post Item'),
                    'new_item' => __('New Featured Post Item'), 
                    'view_item' => __('View Featured Post'),
                    'search_items' => __('Search Success Stories'), 
                    'not_found' =>  __('No Success Stories Items Found'),
                    'not_found_in_trash' => __('No Success Stories Items Found In Trash'),
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
                    'menu_position' => 22,
                    'supports' => array(
                            'title',
                            'editor'
                    )
             );
    
    register_post_type(__( 'success_stories' ), $args);        
} 

// function: success_storiesmessages BEGIN
function success_stories_messages($messages)
{
    $messages[__( 'success_stories' )] = 
            array(
                    0 => '', 
                    1 => sprintf(('Featured Post Updated. <a href="%s">View Featured Post</a>'), esc_url(get_permalink($post_ID))),
                    2 => __('Custom Field Updated.'),
                    3 => __('Custom Field Deleted.'),
                    4 => __('Featured Post Updated.'),
                    5 => isset($_GET['revision']) ? sprintf( __('Success Stories Restored To Revision From %s'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
                    6 => sprintf(__('Featured Post Published. <a href="%s">View Success Stories</a>'), esc_url(get_permalink($post_ID))),
                    7 => __('Success Stories Saved.'),
                    8 => sprintf(__('Featured Post Submitted. <a target="_blank" href="%s">Preview Featured Post</a>'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),
                    9 => sprintf(__('Featured Post Scheduled For: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Featured Post</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
                    10 => sprintf(__('Featured Post Draft Updated. <a target="_blank" href="%s">Preview Featured Post</a>'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),
            );
    return $messages;

} // function: success_stories_messages END

// function: fetured_posts_filter BEGIN
function success_stories_categories()
{
    register_taxonomy(
            __( "success_stories_categories" ),
            array(__( "success_stories" )),
            array(
                    "hierarchical" => true,
                    "label" => __( "Categories" ),
                    "singular_label" => __( "Category" ),
                    "show_ui" => true,
                    "show_in_menu" => true,
                    "show_in_quick_edit" => true,
                    "public" => true,
                    "show_admin_column" => true,
                
                    "rewrite" => array(
                            'slug' => 'success_stories_category',
                            'hierarchical' => true
                    )
            )
    );
} 


add_action( 'init', 'success_stories_post_type' );
add_filter( 'post_updated_messages', 'success_stories_messages' );
add_action( 'init', 'success_stories_categories', 0 );