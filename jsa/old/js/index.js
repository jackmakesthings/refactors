$(function() {
	"use strict";
	var container = $('#container'),
		slideshow = $('#slideshow'),
		veil = $('#veil'),
		slides,
		jFill = {
			images: []
		},
		image_count = 0,
		slide_interval;

	$('body').css({
		width:"100%",
		height:"100%",
		overflow:"hidden"
	});
	// $('#enter').addClass('up');

	$('.slideImages li').each(function() {
		var data = [{
			src: $(this).data("src"),
			id: $(this).data("id"),
			linktext: $(this).data("linktext"),
			linkuri: $(this).data("uri"),
			desc: $(this).data("desc"),
			title: $(this).data("title")
		}];
		jFill.images.push(data);
	});
	jFill.event_binds = ['jfill_resize'];
	jFill.lazy_load = true;
	jFill.image_load_callback = function(image) {
		var slide = image.closest('.jFill-slide').hide();
		if ($('.showing', slideshow).length === 0) {
			slide.addClass('showing')
				.fadeIn(0, function() {
				veil.fadeOut();
			});
		}
	};
	veil.css({
		backgroundColor: '#EDEDED',
		zIndex: 100
	})
		.appendTo(container);

	slideshow.appendTo(container)
		.jFill(jFill)
		.on({
		prev_slide: function() {
			if (typeof(slides) === 'undefined') {
				slides = $('.jFill-slide', slideshow);
			}
			if (slides.length < jFill.images.length) {
				slides = $('.jFill-slide', slideshow);
			}
			slides.each(function(i) {
				var el = $(this),
					prev = el.prev('.jFill-slide');
				if (el.hasClass('showing')) {
					if (prev.length === 0) {
						prev = slides.last();
					}
					var prev_img = prev.find("img"),
						prev_src = prev_img.attr("src"),
						prev_li = $("body").find("li[data-src='" + prev_src + "']"),
						prev_title = prev_li.data("title"),
						prev_link = prev_li.data("uri"),
						prev_desc = prev_li.data("desc");
					el.removeClass('showing').fadeOut('slow');
					$("#enter #slideMeta").html("<a href='" + prev_link + "'><h1>" + prev_title + "</h1><span>" + prev_desc + "</span></a>");
					prev.addClass('showing')
						.fadeIn('slow');
					return false;
				}

			});
		},
		next_slide: function() {
			if (typeof(slides) === 'undefined') {
				slides = $('.jFill-slide', slideshow);
			}
			if (slides.length < jFill.images.length) {
				slides = $('.jFill-slide', slideshow);
			}
			slides.each(function(i) {
				var el = $(this),
					next = el.next('.jFill-slide');

				if (el.hasClass('showing')) {
					if (next.length === 0) {
						next = slides.first();
					}
					// var next_i = i++,
					var next_img = next.find("img"),
						next_src = next_img.attr("src"),
						next_li = $("body").find("li[data-src='" + next_src + "']"),
						next_title = next_li.data("title"),
						next_link = next_li.data("uri"),
						next_desc = next_li.data("desc");
					$("#enter #slideMeta").html("<a href='" + next_link + "'><h1>" + next_title + "</h1><span>" + next_desc + "</span></a>");
					el.removeClass('showing').fadeOut('slow');
					next.addClass('showing')
						.fadeIn('slow');
					return false;
				}
			});
		}
	});

	$('.jFill-image', slideshow)
		.each(function(i) {
		var el = $(this),
			src = el.attr('src'),
			id = i,
			li = $("body").find("li[data-id='" + id + "']"),
			desc = li.data("desc"),
			title = li.data("title"),
			link = li.data("uri");
		el.attr('src', src);
		el.attr('id', i);
	});

	$("#next").on({
		click: function() {
			slideshow.trigger('prev_slide');
		}
	});

	$("#prev").on({
		click: function() {
			slideshow.trigger('next_slide');
		}
	});

	$('#enterControl').on({

		click: function(event){
			var $icon = $('#enterControl').find('span'), $animating;
			$animating = false;

			if( $animating ) { event.preventDefault(); console.log("nope, not while animating"); return false; }
			if ( $("#enter").hasClass('up') === true ) 
			{
				$animating = true;
				$icon.attr("data-icon", "D");
				$("#enter").removeClass('up').stop(true, true).animate({bottom:'-120px'}, 500);
				$animating = false;
			}
			else 
			{
				$animating = true;
				$icon.attr("data-icon", "U");
				$("#enter").addClass('up').stop(true, true).animate({bottom:'0px'}, 500);
				$animating = false;
			}
		}
	});

	
	$(".cover img").css("opacity", "0");

	function isOdd(value) {
		if (value % 2 == 0) return false;
		else return true;
	}

	function update_height() {
		var currentHeight = $(window).height(),
			currentWidth = $(window).width(),
			wrap = $("#cover-wrap"),
			topImg = $("#top > img"),
			bottomImg = $("#bottom > img"),
			imgWidth = topImg.width(),
			imgHeight = topImg.height();
		$(".cover > img").css({
			"max-width": "100%"
		});

		if (isOdd(currentHeight)) currentHeight = (currentHeight + 1);
		wrap.height(currentHeight + 'px');
		var shiftY = (currentHeight / 2) + 'px',
			shiftM = '-' + imgHeight + 'px';
		topImg.css({
			top: shiftY,
			"margin-top": shiftM
		});
		bottomImg.css({
			bottom: shiftY,
			"margin-bottom": shiftM
		});
		slideshow.trigger('jfill_resize');
	}

	update_height();

	$("#cover-wrap").addClass('visibleWrap');
	$(".cover img").animate({
		opacity: 1
	}, 100, function() {
		setTimeout(function() {
			$("#top, #bottom")
				.animate(
				{height: 0},
				1200,
				'easeInCubic',
				function() {
					$("#cover-wrap").css({
						'z-index': '-1'
					});
					$("#topLogo").css({
						zIndex: 300
					});
					$("#topLogo, #topNav, #enter").fadeIn();
					$('#header')
						.css({
						position: "absolute",
						left: 0,
						zIndex: 300,
						top: "-45px"
					});
					$('#enter').css({
						bottom: '-145px'
					});
					$('#header').animate({
						top: 0
					}, 800, 'easeOutCubic');
					$('#enter').animate({
						bottom: '-120px'
					}, 800, 'easeOutCubic');
				});
		}, 1500);
	});

	$(window)
		.on({
		resize: function() {
			slideshow.trigger('jfill_resize');
			update_height();
		}
	});
});