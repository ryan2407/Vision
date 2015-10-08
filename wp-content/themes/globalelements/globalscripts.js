jQuery(document).ready(function($){
    mainNav();

    $(window).resize(function() {
        mainNav();
    });

    function mainNav() {
        var containerWidth = $('div.container').width() - 1;
        var liwidth = containerWidth / $('div.nav > ul > li').length;
        console.log($('div.nav > ul > li').length);
        $('div.nav ul li').each(function () {
            $(this).css('width', liwidth + 'px');
            $(this).parent('ul.sub-menu').css('width', liwidth + 'px');
        });
    }

    $('div.slideshow').cycle({
        slides: 'div.slide',
        pager: 'div.pager',
        pagerTemplate: '<div class="page"></div>'
    });

    $('div.mobileNavIcon').on('click', function(){

        $('div.navWrapper').animate({
            left: "5%"
        }, 500, function(){
            $('div.mobileNavIcon').addClass('active');
        });
    });
    $('div.global').on('click', 'div.active', function(){
        $('div.navWrapper').animate({
            left: "-100%"
        }, 500, function(){
            $('div.mobileNavIcon').removeClass('active');
        });
    });
    
	//FOOTER NAV STUFF
    $('div.footerSection h3').on('click', function(){
        $(this).next('ul').slideToggle();
    });
    
    var lis = $("div.footer ul.menu > li");
	for(var i = 0; i < lis.length; i+=4) {
		lis.slice(i, i+4).wrapAll("<div class='wrapper'></div>");
	}

	//MOBILE JAVASCRIPT NAV
    if($(window).width() <= 790) {
        $('div.subnav li > ul, ul.180 li > ul').each(function(){
            $(this).css('display', 'none').css('width', '100%');
        });

        $('div.subnav li').has('ul').children('a').prepend("<div class='plus'>+</div>");
        
        $('ul.180 li').has('ul').children('a').prepend("<div class='plus'>+</div>");

        $('div.subnav li, ul.180 li').on('click', function(){
            $(this).children('ul:first').slideToggle();
            if ($(this).children('ul:first').is(':visible')) {
                $(this).children('ul:first').css('display', 'block');
            }
            if($(this).children('ul:first').length > 0) {
                return false;
            } else {
                window.location.href = $(this).find('a').attr('href');
                return false
            }
        });
    }
    
    
    //MEDIA PLAYER STUFF
    $('a.listen').on('click', function(){
		$('div.selector').slideToggle(); 
    });
    
    $('a.stream, li.stream a').on('click', function(e){
	    e.preventDefault();
	    window.open($(this).attr('href'), 'Radio Player', 'directories=0,titlebar=0,toolbar=0,location=0,status=0,menubar=0,scrollbars=no,resizable=no,width=400,height=340');
    });
    
    
    var audio = $('div.quality a.active').attr('href');
    $('div.quality a').on('click', function(e){
	    e.preventDefault();
	    $(this).siblings('a').removeClass('active');
	    $(this).addClass('active');
	    audio = $(this).attr('href');
	    return audio;
    })
    
    $('a.play').on('click', function(){
	    if(! $('audio.audio').hasClass('paused')) {
	    	$('audio.audio').attr('src', audio);
	    }
		$('audio.audio').trigger('play'); 
		return false;
    });
    
    $('a.pause').on('click', function(){
	    $('audio.audio').addClass('paused');
	    $('audio.audio').trigger('pause');
	    return false;
    });
    
    $('a.stop').on('click', function(){
	    $('audio.audio').removeClass('paused');
	    $('audio.audio').attr('src', '');
		$('audio.audio').trigger('stop'); 
		return false;
    });
    
});
