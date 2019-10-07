<?php 
/*
Template Name: Success Stories
*/



$storiesArgs = array(
    'post_type' => 'success_stories',
    'posts_per_page' => -1
);
$storiesQuery = new WP_Query( $storiesArgs );

//$getcategory = get_the_terms($post->ID, 'custompostnamehere-categories');



?>

<?php get_header(); ?>
<div class="single-page ">
    <div class="container slider-container">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="post" id="post-<?php the_ID(); ?>">
            <h2 class="noPadd"><?php the_title(); ?></h2>
        </div>
            
        
        <?php 
        $tabs = ''; $content = ''; $tabStart = ''; $tabEnd ='';  $i = 1;
         if ( $storiesQuery->have_posts() ) {         
        while ( $storiesQuery->have_posts() ) {
            $storiesQuery->the_post(); 
            
            $slug = basename(get_permalink());
            $count = $storiesQuery->post_count;
            
            $categories = get_the_terms($post->ID, 'success_stories_categories');
            $categories = $categories['0'];
            $cat = $categories->name;
            
            $activeClass='';
            
            //$content = apply_filters('the_content', get_the_content());
                
            if($i == 1 ){ 
                $tabStart = '<ul class="audiences-tab">'; 
                $contentStart = '<ul class="audiences-tab-content success-stories">'; 
                $activeClass = 'active';
            } 
                
            $tabs .= '<li class="tab-item '.$activeClass.'" data-id="'.$i.'" data-slug="'.$slug.'" >'.$cat.' </li> ';

            $content .= '<li id="'.$i.'" class="'.$activeClass.'">'
                    . '<h4 class="blueBg">'.get_the_title().'</h4>'
                    . '<div class="description">'.apply_filters('the_content', get_the_content()).'</div>';
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