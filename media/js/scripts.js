include("/media/js/jquery.color.js");
include("/media/js/jquery.backgroundpos.js");
include("/media/js/jquery.easing.js");
include("/media/js/jquery.mousewheel.js");
include("/media/js/jquery.fancybox-1.3.4.pack.js");
include("/media/js/googleMap.js");
include("/media/js/superfish.js");
include("/media/js/switcher.js");
include("/media/js/bgStretch.js");
include("/media/js/sImg.js");
include("/media/js/MathUtils.js");

function include(url) {
    document.write('<script src="' + url + '"></script>');
}
var MSIE = false,
    content,
    isSplash = false,
    defColor;

function addAllListeners() {
    var defH = $('.menu').css('height');
    $('#menuBlock')
    .children('div').css({'top':'75px'}).end()
    .find('.menu').css({'marginTop':'-225px','height':'268px'}).end()
    .find('#menu').css({'marginTop':'-100px'}).end()
    .find('#menuName>span').css({'top':'0px'}).end()
    .find('#menu>li>a').css('top','-40px').end()
    .hover(
        function(){
            	$(this).children('div').stop(true).animate({'top':'-66px'},300,'easeOutBack').end()
                .find('.menu').stop(true).animate({'marginTop':'-105px','height':defH},300,'easeOutExpo'
                    ,function(){$(this).find('.menu').css({'overflow':'visible'});}
                ).end()
                .find('#menu').stop(true).animate({'marginTop':'0px'},300,'easeOutExpo').end()
                .find('#menu>li>a').each(function (idx){
                    $(this).stop(true).delay(600-idx*120).animate({'top':'0px'},300,'easeOutBack');
                }).end()
                .find('#menuName>span').stop(true).animate({'top':'-40px'},300,'easeOutExpo'
                    ,function(){$(this).parent().css('display','none');}
                );
        },
        function(){
            if (isSplash)
                $(this).children('div').stop(true).animate({'top':'75px'},800,'easeInOutBack').end()
                .find('.menu').stop(true).animate({'marginTop':'-225px','height':'268px'},900,'easeInOutCubic'
                    ,function(){$(this).find('.menu').css({'overflow':'visible'});}).end()
                .find('#menu').stop(true).animate({'marginTop':'-100px'},900,'easeInOutCubic').end()
                .find('#menu>li>a').each(function (idx){
                    $(this).stop(true).delay(idx*50).animate({'top':'-40px'},300,'easeInBack');
                }).end()
                .find('#menuName').css('display','block').end()
                .find('#menuName>span').stop(true).delay(750).animate({'top':'0px'},500,'easeOutExpo');
        }      
    );
    if (!MSIE){
        $('.list2>li>a,.list1>li>a').find('strong').animate({'top':'200px'});
    }
    $('.list2>li>a,.list1>li>a').hover(
        function(){
            if (!MSIE){
                $(this).children('.sitem_over').css({display:'block',opacity:'0'}).stop().animate({'opacity':1}).end() 
                .find('strong').css({'opacity':0}).stop().animate({'opacity':1,'top':'0'},350,'easeInOutExpo');
            } else { 
                $(this).children('.sitem_over').stop().show().end()
                .find('strong').stop().show().css({'top':'0'});
            }
        },
        function(){
            if (!MSIE){
                $(this).children('.sitem_over').stop().animate({'opacity':0},1000,'easeOutQuad',function(){$(this).children('.sitem_over').css({display:'none'})}).end()  
                .find('strong').stop().animate({'opacity':0,'top':'200px'},1000,'easeOutQuad');  
            } else {
                $(this).children('.sitem_over').stop().hide().end()
                .find('strong').stop().hide();
            }            
        }
    );
    var val1 = $('.readMore').css('color');
    $('.readMore,.list3 a').hover(
        function(){
        	$(this).stop().animate({'color':'#de5729'},400,'easeOutExpo');  
        },
        function(){
            $(this).stop().animate({'color':val1},700,'easeOutCubic');  
        }
    );
    $('.pagin a').hover(
        function(){
            if (!$(this).parent().hasClass('active'))
                $(this).stop().animate({'backgroundPosition':'center bottom'},250,'easeOutCubic');
        },
        function(){
            if (!$(this).parent().hasClass('active'))
                $(this).stop().animate({'backgroundPosition':'center top'},400,'easeOutCubic');
        }
    );
}

function showSplash(){
    isSplash = true;
    $('#menuBlock').trigger('mouseleave').stop(true).delay(300).animate({'left':'199px'},350,'easeOutBack');   
}
function hideSplash(){
    isSplash = false;
    $('#menuBlock').trigger('mouseenter').stop(true).animate({'left':'-141px'},350,'easeOutBack');    
}

function hideSplashQ(){
    isSplash = true;
    $('#menuBlock').trigger('mouseleave');
}

$(document).ready(ON_READY);

function ON_READY() {
    /*SUPERFISH MENU*/   
    $('.menu #menu').superfish({
	   delay: 400,
	   animation: {
	       height: 'show'
	   },
       speed: 'slow',
       autoArrows: false,
       dropShadows: false
    });
}

function ON_LOAD(){
    MSIE = ($.browser.msie) && ($.browser.version <= 8);
    $('.spinner').fadeOut();
    
    $('.list2>li>a,.list1>li>a').attr('rel','appendix')
    .prepend('<span class="sitem_over"><strong></strong></span>')
    .fancybox({
        'transitionIn': 'elastic',
		'transitionOut': 'elastic',
		'speedIn': 500,
		'speedOut': 300,
        'centerOnScroll': true
    });
    
    addAllListeners();
    hideSplashQ();
    
    //content switch
    content = $('#content');
    content.tabs({
        show:0,
        preFu:function(_){
            _.li.css({'display':'none'});		
            _.li.eq(0).css({'width':'0','height':'0'});		
        },
        actFu:function(_){          
            if(_.curr){
                if (_.n == 0){
                    showSplash();
                } else {
                    hideSplash();
                }
                _.curr
                    .css({'top':'-1000px'}).stop(true).show().animate({'top':'0'},{duration:1000,easing:'easeInOutExpo'});
            }   
    		if(_.prev){
  		        _.prev
                    .show().stop(true).animate({'top':'1000px'},{duration:600,easing:'easeInOutExpo',complete:function(){
                            if (_.prev){
                                _.prev.css({'display':'none'});
                            }
                        }
		              });
            }            
  		}
    });
    defColor = $('#menu>li>a').eq(0).css('color'); 
    var nav = $('.menu');
    nav.find('#menu>li>a').each(function (index){
        $(this).append('<strong>'+$(this).text()+'</strong');
    });
    nav.navs({
		useHash:true,
        defHash: '#!/page_splash',
        hoverIn:function(li){
            $('>a>strong', li).stop().animate({'height': '100%'},400,'easeOutExpo');
        },
        hoverOut:function(li){
            if ((!li.hasClass('with_ul')) || (!li.hasClass('sfHover'))) {
                $('>a>strong', li).stop().animate({'height': '0'},700,'easeOutCubic');
            }
        }
    })
    .navs(function(n){	
   	    $('#content').tabs(n);
   	});
    
    setTimeout(function(){
        $('#bgStretch').bgStretch({
    	   align:'leftTop',
           autoplay: false,
           navs:$('.pagin').navs({})
        })
        .sImg({
            sleep: 1000,
            spinner:$('<div class="spinner spinner_bg"></div>').css({opacity:1}).stop().hide(3000)
        });
    },0);
        
    setTimeout(function(){  $('body').css({'overflow':'visible'}); },300);    
    
    $(window).trigger('resize');
}

$(window).resize(function (){
    if (content) content.stop().animate({'top':(windowH()-content.height())*.5+40},500,'easeOutCubic');
});

function listen(evnt, elem, func) {
    if (elem.addEventListener)  // W3C DOM
        elem.addEventListener(evnt,func,false);
    else if (elem.attachEvent) { // IE DOM
        var r = elem.attachEvent("on"+evnt, func);
    return r;
    }
}
listen("load", window, ON_LOAD);