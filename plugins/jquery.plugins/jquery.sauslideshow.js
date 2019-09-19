jQuery.fn.SAUSlideShow = function(slides_data) {
	return this.each(function(){
		var settings = jQuery.extend({
     		width: 640, // default width of the slideshow
     		height: 480, // default height of the slideshow
			speed: 1500, // default animation transition speed
			interval: 7000, // default interval between image change
			PlayPauseElement: 'fssPlayPause', // default css id for the play / pause element
			PlayText: 'Play', // default play text
			PauseText: 'Pause', // default pause text
			NextElement: 'fssNext', // default id for next button
			NextElementText: 'Next >', // default text for next button
			PrevElement: 'fssPrev', // default id for prev button
			PrevElementText: '< Prev', // default text for prev button
			ListElement: 'fssList', // default id for image / content controll list
			ListLi: 'fssLi', // default class for li's in the image / content controll 
			ListLiActive: 'fssActive', // default class for active state in the controll list
			addListToId: false, // add the controll list to special id in your code - default false
			allowKeyboardCtrl: true, // allow keyboard controlls left / right / space
			autoplay: true // autoplay the slideshow
	 	}, slides_data.options);
		
		var slideContainer = this;
		var slideCount = slides_data.slides.length;
		var currSlide = 1;
		var slidesData = slides_data;
		
		var slides = jQuery('> *', this);
		
		var timer_instance = false;
		var autoplay = function(){
			timer_instance = setInterval(function(){
				$("#slide-"+currSlide).animate({opacity:0},Math.round(settings.speed/2),
					function(){
						$("#slide-"+currSlide).css('display','none');
						$("#slide-"+currSlide).css('z-index','1');
						$("#slide-"+currSlide+" a").attr('onclick','javascript:void(0);');
						currSlide = currSlide + 1;						
						if (currSlide > slideCount)	currSlide = 1;
						$("#slide-"+currSlide).css('display','block');
						$("#slide-"+currSlide).css('z-index','2');
						$("#slide-"+currSlide).animate({opacity:1},Math.round(settings.speed/2));						
						$("#slide-"+currSlide+" a").attr('onclick','javascript:'+slidesData.slides[currSlide-1].link);
					}
				);
			}, settings.interval);
		};
		
		// Generate the slide-show structure
		$.each(slides_data.slides,function(i,obj){
			var str = '<div id="slide-'+(i+1)+'" class="slide" style="background-image:url(\''+obj.image+'\');">';
			str = str + '<div id="slide-text">';
			str = str + '<h2><a href="javascript:void(0);">' + obj.title + '</a></h2>';
			str = str + '<main>' + obj.desc + '</main>';
			str = str + '<div class="article-link"><table border="0" cellspan="0" cellpadding="0"><tr><td><a href="javascript:void(0);"><span style="font-size:100px;color:#f00;font-weight:normal;">+</span><a></td><td style="padding-top:10px;padding-left:10px;text-align:left;"><a href="javascript:void(0);">LEARN MORE</a></td></tr></table></div>';
			str = str + '</div>';
			str = str + '<div id="bottom-right-text"><a href="javascript:void(0);">'+obj.subtitle+'</a></div>';
			str = str + '</div>';
			$(slideContainer).append(str);
		});
		$("#slide-"+currSlide).css('z-index','2');
		$("#slide-"+currSlide+" a").attr('onclick','javascript:'+slidesData.slides[currSlide-1].link);
		$("#slide-"+currSlide).animate({opacity:1},Math.round(settings.speed/2));
		autoplay();
	})
};