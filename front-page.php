<?php get_header(); ?>
<?php 
    global $wp;
    
   
    
    
    if($_POST['current-region']){
             
        $_SESSION['session-region'] = $_POST['current-region'];
        $_SESSION['session-region-name'] = $_POST['current-region-name'];

    }
    
    $currengtRegion = get_option( 'default-region' );  
    $activeRegion = $_SESSION['session-region'];  
     
   
    $thisRegion =  $activeRegion ? $activeRegion :  $currengtRegion;  
    
    $defaultSliderArgs = array(
        'post_type' => 'geo-default-slider',
        'geo_default_category' => $thisRegion,
        'posts_per_page' => 1
    );
    $defaultSliderQuery = new WP_Query( $defaultSliderArgs );
    
    $audiencesArgs = array(
        'post_type' => 'geo-slider',
        'geo_category' => $thisRegion,
        'posts_per_page' => -1
    );
    $audiencesQuery = new WP_Query( $audiencesArgs );
    
    $pagerTitle = '';
    $pagerSubTitle = '';
?>

<!--Front Page slider section START-->
<ul class="mobile-slider-default">
    <?php 
        if ( $defaultSliderQuery->have_posts() ) { 
        while ( $defaultSliderQuery->have_posts() ) {
            $defaultSliderQuery->the_post(); 
            $imgUrl = get_post_meta(get_the_ID(), 'audience_logo', true);
            $pagerTitle = get_post_meta(get_the_ID(), 'audience_pager_title', true);;
            $pagerSubTitle = get_post_meta(get_the_ID(), 'audience_pager_subtitle', true);;
    ?>
    <li class="sl-content" style="background: url(<?php echo $imgUrl; ?>) 0 0 no-repeat">
        <div class="slider-container">
            <h1 class="title-default"><?php the_title(); ?></h1>
            <div class="description-default"><?php the_content(); ?></div>
        </div>            
    </li>
    <?php 
            } 
        }
        wp_reset_postdata(); 
    ?>
</ul>
<div class="front-sl-section">
    
    <div class="sl-pager-div ">
        <div class="container text-center">
            <h2><?php echo $pagerTitle; ?></h2>
            <p><?php echo $pagerSubTitle; ?></p>
            
            <div id="front-slider-pager">
                <?php 
                    if ( $audiencesQuery->have_posts() ) { 
                    $i = 1;
                    while ( $audiencesQuery->have_posts() ) {
                        $audiencesQuery->the_post(); 
                        $logoUrl = get_post_meta(get_the_ID(), 'audience_logo', true);
                ?>
                <a class="pager-img" data-slide-index="<?php echo $i; ?>" href="">
                    <img src="<?php echo $logoUrl; ?>" />
                    <span><?php the_title(); ?></span>
                </a>
                <?php 
                    $i++;
                        } 
                    }
                    wp_reset_postdata(); 
                ?>

            </div>
        </div>
    </div>
    
    <ul class="front-slider">
        <?php 
            if ( $defaultSliderQuery->have_posts() ) { 
            while ( $defaultSliderQuery->have_posts() ) {
                $defaultSliderQuery->the_post(); 
                $imgUrl = get_post_meta(get_the_ID(), 'audience_logo', true);
                $pagerTitle = get_post_meta(get_the_ID(), 'audience_pager_title', true);;
                $pagerSubTitle = get_post_meta(get_the_ID(), 'audience_pager_subtitle', true);;
        ?>
        <li class="default-slider" style="background: url(<?php echo $imgUrl; ?>) 0 0 no-repeat">
            <div class="slider-container">
                <h1 class="title-default"><?php the_title(); ?></h1>
                <div class="description-default"><?php the_content(); ?></div>
            </div>            
        </li>
        <?php 
                } 
            }
            wp_reset_postdata(); 
        ?>
        
        <?php 
            if ( $audiencesQuery->have_posts() ) { 
            while ( $audiencesQuery->have_posts() ) {
                $audiencesQuery->the_post(); 
                
                $logoUrl = get_post_meta(get_the_ID(), 'audience_logo', true);
                $contentLogoUrl = get_post_meta(get_the_ID(), 'audience_content_logo', true);
                
                $gridContentColor = get_post_meta(get_the_ID(), 'audience_grid_color', true);
                
                $grid_titles = get_post_meta($id, 'audience_grid_titles', true);
                $grid_titles = $grid_titles ? unserialize($grid_titles) : array();

                $grid_urls = get_post_meta($id, 'audience_grid_urls', true);
                $grid_urls =  $grid_urls ? unserialize($grid_urls) : array();

                $grid_counts = get_post_meta($id, 'audience_grid_counts', true);
                $grid_counts = $grid_counts ? unserialize($grid_counts) : array();
        ?>
        <li>
            <div class="slider-container">
                <div class="audience-sl-content">
                    <div class="audienc-header">
                        <p class="logo">
                           <img src="<?php echo $contentLogoUrl; ?>" /> 
                        </p>                        
                        <div class="description">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    
                    <ul class="audienc-grid">
                        <?php 
                            $lenght = count($grid_titles);

                            for ( $i=0; $i<$lenght; $i++){
                        ?>
                        <li style="color:<?php echo $gridContentColor; ?>">
                            <img src="<?php echo $grid_urls[$i]; ?>" />
                            <span class="count"><?php echo $grid_counts[$i]; ?></span>
                            <span class="title"><?php echo $grid_titles[$i]; ?></span>
                        </li>
                        <?php  } ?>
                    </ul>
                </div>
            </div>
        </li>
        
        <?php 
                } 
            }
            wp_reset_postdata(); 
        ?>
        
    
    </ul>
    
</div> <!-- /Front Page slider section END-->

<div class="section-featured-posts"><!--Featured Posts Section START-->    
    <div class="container">        
        <div class="featured-posts">
            <?php
                $query_args = array ( 'post_type' => 'featured_posts', 'posts_per_page' => 3 );

                $defaultSliderQuery = new WP_Query( $query_args );
                if ( $defaultSliderQuery->have_posts() ) : while ( $defaultSliderQuery->have_posts() ) : $defaultSliderQuery->the_post();   
            ?>            
             <div class="featured-item">
                <?php 
                    if ( has_post_thumbnail()) : 
                        the_post_thumbnail();
                    endif; 
                 ?>
                <h2><?php the_title(); ?></h2>
                <p>
                    <?php the_excerpt(); ?>
                </p>
            </div>
            
            <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else: ?>
                <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
            <?php endif; ?>   
<!--            <div class="controls">
                <a class="next">Next</a>
                <a class="prev">Prev</a>
            </div>-->
        </div>
    </div>    
</div><!-- /Featured Posts Section END-->

<div class="section-contacts"><!-- Get In Tuch Section START-->
    <div class="container">
        <?php echo do_shortcode('[contact-form-7 id="7" title="Front Page contact Form"]'); ?>
    </div>
</div><!-- /Get In Tuch Section END-->





<?php get_footer(); ?>