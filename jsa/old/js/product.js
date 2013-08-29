// product.js

$(function() {
    var thumbs = $('#smallImgs li'),
        larges = $('#bigImg a.cloud-zoom-gallery'),
        large_display, large_current, large_old, large_new,
        current,
        animating = false;

        current = larges.length - 1;
        large_display = $('#box');
        larges
            .detach();
        large_current = larges.filter('.current').length === 0
            ? larges.eq(current).clone(true)
            : large_current = larges.filter('.current').eq(0);
        large_current.hide().appendTo(large_display).CloudZoom().show();
        // $("#wrap").css('display', 'table-cell');
        $("#wrap").css('display', 'block');
        thumbs
            .each(function (i) {
                $(this)
                    .click(function (e) {
                        if (!animating) {
                            animating = true;
                            // $("#cover").fadeIn();
                            thumbs
                                .removeClass('active');
                            $(this)
                                .addClass('active');
                            current = i;
                            large_old = large_current;
                            large_new = larges.eq(current).clone(true);
                            large_current = large_new;

                            large_old
                                .fadeOut(function () {
                                    $(this).parent().remove();
                                    $(this).remove();
                                    animating = false;
                                    //console.log('removing', $(this));
                                });
                            large_new
                                .hide()
                                .css('opacity', '0')
                                .appendTo(large_display)
                                .fadeIn(function () {

                                    $(this).CloudZoom()
                                    .animate({opacity:'1'}, 400);
                                    $("#wrap")
                                        .css({
                                            'display':'table',
                                            'margin-left':'auto',
                                            'margin-right':'auto',
                                            'height':'auto',
                                            'opacity':1
                                        })
                                });
                                //console.log('adding', $(this));
                        }

                    });
            })
            .first()
            .click();

        thumbs.last().addClass('last');

        if(larges.length > 1) {
            //console.log('multiple');
            var switching,
                multiple = true,
                // navDiv = $("#imgNav"),
                navPrev = $("a#prev"),
                navNext = $("a#next");
                // navDiv.hide();
                switching = false;

                $(navNext).click(function(){
                    if(!switching) {
                        switching = true;
                        var $nextThumb = $("li.active").next("li");
                        if($nextThumb.length === 0) {
                            //console.log('No more thumbs!');
                            $nextThumb = $("#smallImgs").find("li:first");
                        }
                        $nextThumb.click();
                        //console.log("advanced");
                    }
                    switching = false;
                });

                switching = false;

                $(navPrev).click(function(){
                    if(!switching) {
                        switching = true;
                        $prevThumb = $("li.active").prev("li");
                        if($prevThumb.length === 0 || $(".active").hasClass("first") == true) {
                            //console.log('No more thumbs!');
                            $prevThumb = $("#smallImgs").find(".last");
                        }
                        $prevThumb.click();
                        //console.log("went back");
                    }
                    switching = false;
                });
            }
    });


