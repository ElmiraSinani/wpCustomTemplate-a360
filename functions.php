<?php
    //register Featured Posts Custom Post Type
    require_once("inc/cpt-featured-posts.php");
    require_once("inc/cpt-success-stories.php");

    // Add RSS links to <head> section
    automatic_feed_links();
	

    // Clean up the <head>
    function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
   
    // thumbnails
    if (function_exists('add_theme_support')) {
        add_theme_support('post-thumbnails'); 
    }
    
   /**
    * Proper way to enqueue scripts and styles.
    */
   function a360_frontend_scripts() {
       
       //load scripts
        if (!is_admin()) {
            wp_deregister_script('jquery');
            wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery-2.1.1.js', array(), '', false);
        }
//        wp_enqueue_style( 'bx-sl-css', get_template_directory_uri() . '/libs/bx-slider/jquery.bxslider.css', array(), '3.2' );
        wp_enqueue_script( 'bx-sl-scripts', get_template_directory_uri() . '/libs/bx-slider/jquery.bxslider.min.js', array(), '', true );
        
        wp_enqueue_script( 'custom-scripts', get_template_directory_uri() . '/js/custom-scripts.js', array(), '', true );
        
   }
   add_action( 'wp_enqueue_scripts', 'a360_frontend_scripts' );   
   
   //Register a360 Menues
   function register_companycom_menus() {
        register_nav_menus(
            array(
                'header-menu' => __('Header Menu','a360'),
                'footer-menu' => __('Footer Menu','a360'),
            )
        );
    }
    add_action('init', 'register_companycom_menus');
    
    // Declare sidebar widget zone
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => 'Footer Social Block',
    		'id'   => 'footer-social',
    		'description'   => 'These are widgets for the footer social Block.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2>',
    		'after_title'   => '</h2>'
    	));
    	register_sidebar(array(
    		'name' => 'Footer Copyrights Block',
    		'id'   => 'footer-copy',
    		'description'   => 'These are widgets for the footer © Copyrights Block.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2>',
    		'after_title'   => '</h2>'
    	));
    }
    
    //hide Widget titles
    add_filter('widget_title','my_widget_title'); 
    function my_widget_title($t) {
        return null;
    }
    
    function getRegions(){
        
        global $wpdb;
        $taxonomy = 'geo_category';
        $term_query = new WP_Term_Query();
        $args = array(
            'taxonomy' => $taxonomy,
            'hide_empty' => false,
            'orderby' => 'ID'
        );
        $terms = $term_query->query( $args );  
        
        return $terms;
    }
    
    
?>