	
    <!-- Footer Section START-->
    <div class="section-footer">
        <div class="container">
            <div class="footer-inner">
                <div class="footer-logo">
                    <img src="<?php bloginfo('template_directory') ?>/images/footer-logo.png" />
                </div>
                <div class="footer-social">
                    <?php if ( is_active_sidebar( 'footer-social' ) ) : ?>                           
                        <?php dynamic_sidebar( 'footer-social' ); ?>
                    <?php endif; ?>
                </div>
                <div class="footer-menu">
                    <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer-menu',
                            'menu_class' => '',
                            'container' => 'ul'
                        ));
                    ?>
                </div>
            </div>
        </div>
        <div class="footer-copy">
            <?php if ( is_active_sidebar( 'footer-copy' ) ) : ?>                           
                <?php dynamic_sidebar( 'footer-copy' ); ?>
            <?php endif; ?>
        </div>
    </div>
    <?php $regions = getRegions(); ?>
    
    <div class="region-switcher-modal">
        <div class="region-switcher-content">
            <div class="header">Choose your region</div>
            <div class="regions">
                <?php 
                foreach ($regions as $region){ 
                    $regionIcon = get_metadata('term',  $region->term_id, 'region_icon', true); 
                    $currengtRegion = get_option( 'default-region' );  
                    $activeRegion = $_SESSION['session-region'];  

                    $thisRegion =  $activeRegion ? $activeRegion :  $currengtRegion; 
                ?>
                <div class="item <?php if($thisRegion == $region->slug){ echo 'active'; }?>">
                    <img id="<?php echo $region->slug; ?>" class="select-region" src="<?php echo $regionIcon; ?>" />
                    <span class="region-name" ><?php echo $region->name; ?></span>
                </div>
                <?php } ?>
                
                <form id="current-region" action="" method="POST">
                    <input class="region-slug" type="hidden" name="current-region" value="" />
                    <input class="region-name" type="hidden" name="current-region-name" value="" />
                </form>
                
            </div>
            <div class="closeModal"></div>
        </div>
    </div>
    
    <!-- /Footer Section END-->

    <?php wp_footer(); ?>
	
    <!-- Don't forget analytics -->
        
</body>

</html>
