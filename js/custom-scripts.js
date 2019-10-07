$(document).ready(function(){ 
    
    //front page slider 
    $('.front-slider').bxSlider({
        controls: false,
        adaptiveHeight: true,
        pagerCustom: '#front-slider-pager'
    });
    $('#front-slider-pager').bxSlider({
        slideWidth: 168,
        slideMargin: 30,
        minSlides: 6,
        maxSlides: 6,
        pager:false,
        controls: true,
        moveSlides: 1,
    });
    $('.featured-posts').bxSlider({
        slideWidth: 330,
        slideMargin: 65,
        minSlides: 3,
        maxSlides: 3,
        pager:false,
        controls: true,
        moveSlides: 1
    });
    
    //$('#front-slider-pager .pager-img').on('click', function(e){
    $('#front-slider-pager').delegate( ".pager-img", "click", function(e) {
        e.preventDefault();
        $('#front-slider-pager .pager-img').addClass('pasive');
        $(this).addClass('active').removeClass('pasive');
        $('.sl-pager-div').addClass('pagerActivated');
    });
    
    
    //region modal open on click to changer
    $('.regChanger').on('click', function(e){
        e.preventDefault();
        $('.region-switcher-modal').show();
    });
    
    //region modal close button
    $('.closeModal').on('click', function(e){
        e.preventDefault();
        $('.region-switcher-modal').hide();
    });
    
    var currRegion = $('.regions .active .region-name').text();
    $('.active-region-name').text(currRegion);
    
    //select-region
    $('.select-region').on('click', function(e){
        e.preventDefault();
        var thisRegion = $(this).attr('id');
        var thisRegionName = $(this).parent().find('.region-name').text();
        $('#current-region input.region-slug').val(thisRegion);
        $('#current-region input.region-name').val(thisRegion);
        $('#current-region').submit();
    });
    
    //open-mobile-menu
    $('#open-mobile-menu').on('click', function(e){
        e.preventDefault();
        $('#mobile-menu').show();
    });
    
    $('#close-mobile-menu').on('click', function(e){
        e.preventDefault();
        $('#mobile-menu').hide();
    });
    
    $('.audiences-tab li').on('click', function(){
        var tabId = $(this).attr('data-id');
        $('.audiences-tab li, .audiences-tab-content li').removeClass('active');
        $(this).addClass('active');
        $('.audiences-tab-content #'+tabId).addClass('active');
        
       
    });
    

});