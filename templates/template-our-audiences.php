<?php 
/*
Template Name: Our Audiences
*/

 if($_POST['current-region']){
             
    $_SESSION['session-region'] = $_POST['current-region'];
    $_SESSION['session-region-name'] = $_POST['current-region-name'];

}

$currengtRegion = get_option( 'default-region' );  
$activeRegion = $_SESSION['session-region'];  


$thisRegion =  $activeRegion ? $activeRegion :  $currengtRegion; 

$audiencesArgs = array(
    'post_type' => 'geo-slider',
    'geo_category' => $thisRegion,
    'posts_per_page' => -1
);
$audiencesQuery = new WP_Query( $audiencesArgs );



?>

<?php get_header(); ?>
<div class="single-page">
    <div class="container slider-container">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="post" id="post-<?php the_ID(); ?>">
            <h2 class="noPaddL"><?php the_title(); ?></h2>
            <div class="">
                <?php the_content(); ?>
            </div>
        </div>
            
        
        <?php 
        $tabs = ''; $content = ''; $tabStart = ''; $tabEnd ='';  $i = 1;
        if ( $audiencesQuery->have_posts() ) {         
        while ( $audiencesQuery->have_posts() ) {
            $audiencesQuery->the_post(); 
            $slug = basename(get_permalink());
            $count = $audiencesQuery->post_count;

            $logoUrl = get_post_meta(get_the_ID(), 'audience_logo', true);
            $contentLogoUrl = get_post_meta(get_the_ID(), 'audience_content_logo', true);
            $gridContentColor = get_post_meta(get_the_ID(), 'audience_grid_color', true);
            $grid_titles = get_post_meta($id, 'audience_grid_titles', true);
            $grid_titles = $grid_titles ? unserialize($grid_titles) : array();
            $grid_urls = get_post_meta($id, 'audience_grid_urls', true);
            $grid_urls =  $grid_urls ? unserialize($grid_urls) : array();
            $grid_counts = get_post_meta($id, 'audience_grid_counts', true);
            $grid_counts = $grid_counts ? unserialize($grid_counts) : array();

            $activeClass='';
            $lenght = count($grid_titles);
                
            if($i == 1 ){ 
                $tabStart = '<ul class="audiences-tab">'; 
                $contentStart = '<ul class="audiences-tab-content">'; 
                $activeClass = 'active';
            } 
                
            $tabs .= '<li class="tab-item '.$activeClass.'" data-id="'.$i.'" data-slug="'.$slug.'" >'.get_the_title().' </li> ';

            $content .= '<li id="'.$i.'" class="'.$activeClass.'">'
                    . '<h3>'.get_the_title().'</h3>'                    
                    . '<div class="audienc-header">'
                    . '<p class="logo"><img src="'.$contentLogoUrl.'" /></p>'
                    . '<div class="description">'.get_the_content().'</div>'
                    . '</div>';

            $content .= '<ul class="audienc-grid">';
            for ( $j=0; $j<$lenght; $j++){       
                
                $content.= '<li style="color:'.$gridContentColor.'"  >'
                        . '<img src="'.$grid_urls[$j].'" />'
                        . '<span class="count">'.$grid_counts[$j].'</span> '
                        . '<span class="title">'.$grid_titles[$j].'</span>'
                        . '</li>';
            }
            $content .= '</ul>';

            $content .='</li>';                
               
                
            if($i == $count ){                    
                $tabEnd = '</ul>';
                $contentEnd = '</ul>';                   
            }
                
        
            $i++;
            } 
        }
        wp_reset_postdata(); 
        ?>                
        
        <div class="">
        <?php 
            echo $tabStart;
            echo $tabs;
            echo $tabEnd;
        ?>
        
        <?php
            echo $contentStart;
            echo $content;
            echo $contentEnd;
        ?>
        </div>
        
       
        
        
    <?php endwhile; endif; ?>
    </div>
</div>




<?php get_footer(); ?>