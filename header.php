<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<?php if (is_search()) { ?>
	   <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>

	<title>
		   <?php
		      if (function_exists('is_tag') && is_tag()) {
		         single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
		      elseif (is_archive()) {
		         wp_title(''); echo ' Archive - '; }
		      elseif (is_search()) {
		         echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
		      elseif (!(is_404()) && (is_single()) || (is_page())) {
		         wp_title(''); echo ' - '; }
		      elseif (is_404()) {
		         echo 'Not Found - '; }
		      if (is_home()) {
		         bloginfo('name'); echo ' - '; bloginfo('description'); }
		      else {
		          bloginfo('name'); }
		      if ($paged>1) {
		         echo ' - page '. $paged; }
		   ?>
	</title>
           
        <link rel="shortcut icon" href="<?php bloginfo('template_directory');?>/images/shortcut_50x50.png">	
	
	<link rel="shortcut icon" href="/favicon.ico">
	
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php if ( is_singular() ) wp_enqueue_script('comment-reply'); ?>
       
	<?php wp_head(); ?>
        
        <?php $activeRegionName = $_SESSION['session-region-name']; ?>
</head>

<body <?php body_class(); ?>>
	
    
    <div class="section-region">
        <?php 
            $hideRegion = get_option( 'hide-region-functionality' );
            if ( $hideRegion == 'show' ) {
        ?>
        <div class="container">
            <ul class="region-list">
                <li class="leftBg"></li>
                <li class="regIn">You’re in <span class="active-region-name"><?php if($activeRegionName) echo $activeRegionName;?></span></li>
                <li class="midBg"></li>
                <li class="regChanger">Change <span>REGION</span></li>
                <li class="rightBg"></li>
            </ul>
        </div>
        <?php } ?>
    </div>
    
    
    <div class="menu-section">
        <div class="container">
            <div class="logo-block">
                <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
                    <img src="<?php bloginfo('template_directory') ?>/images/logo.png" />
                </a>                
            </div>
            <div id="open-mobile-menu"></div>
            <div id="mobile-menu">
                <div class="mobile-logo">
                    <img src="<?php bloginfo('template_directory') ?>/images/mobile-logo.png" />
                    <div id="close-mobile-menu">X</div>
                </div>
                <div class="mobile-menu-inner">                   
                    
<!--                    <ul class="region-list">
                        <li class="regIn">You’re in <span class="active-region-name"><?php if($activeRegionName) echo $activeRegionName;?></span></li>
                        <li class="regChanger">Change <span>REGION</span></li>
                    </ul>-->
                    <?php
                        wp_nav_menu(array(
                            'theme_location' => 'header-menu',
                            'menu_class' => 'mobile-main-menu',
                            'container' => 'div'
                        ));
                     ?>
                </div>
                
            </div>
            <div class="main-menu">
            <?php
                wp_nav_menu(array(
                    'theme_location' => 'header-menu',
                    'menu_class' => 'main-menu',
                    'container' => 'ul'
                ));
             ?>
            </div>
        </div>
    </div>