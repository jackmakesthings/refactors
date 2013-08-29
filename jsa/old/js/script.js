$(function(){
    'use strict';
    // {{{ init vars
    var contact_form = $('#contact-us'),
        overlaid = $('ul .product a'),
        sendListModal = $("#sendListModal").slideUp(),
        // search box
        search_box = $('.searchBox'),
        search_form = $('#search-form', search_box),
        search_form_404 = $('#search-form-404', search_box),
        search_input = $('.search_input')
            .data('loaded', false),
        // product displays
        prod_wrapper = $('.prodWrapper'),
        modalOpener = $('.modalOpener'),
        div_slider = $('div.slider'),
        // pagination
        footer_nav = $('#shopFooterNav'),
        paginator = $('.bottomPagination', footer_nav),
        footer_show_all = $('.showAll', footer_nav),
        f_ellipsis = $('.f_ellipsis', paginator),
        b_ellipsis = $('.b_ellipsis', paginator),
        next_page_btn = $('.next', paginator),
        prev_page_btn = $('.prev', paginator),
        // product filters
        product_sorting = $('#productSorting'),
        filterArea = $('#productFilters'),
        filter_tag = $('<li class="filter"><a href="javascript:;"><span data-icon="x"></span><label></label></a></li>')
            .on({
                click : function(){ $( 'input#' + $(this).attr('id') ).click(); }
            }),
        tert_label = $('label', $('.filterByType')),
        designer_label = $('label', $('.filterByDesigner')),
        category_label = $('label', $('.filterByCategory')),
        size_label = $('label', $('.filterBySize')),
        sorting_show_all = $('.showAll', product_sorting),
        show_all_btn = $('.showAllButton'),
        clear_all_filters = $('.clear-all-filters'),
        shown_label = $('.productsShown'),
        paginate_btn = $('.paginationControl', paginator),
        lwh_form = $('form#lwh', product_sorting),
        dia_form = $('form#diameter', product_sorting),
        l_slider_div = $('._lengthSlider', product_sorting),
        w_slider_div = $('._widthSlider', product_sorting),
        h_slider_div = $('._heightSlider', product_sorting),
        o_h_slider_div = $('._overallHeightSlider', product_sorting),
        d_slider_div = $('._diameterSlider', product_sorting),
        d_h_slider_div = $('._diameterHeightSlider', product_sorting),
        d_o_h_slider_div = $('._overallDiameterHeightSlider', product_sorting),
        length_slider = $('div#lengthSlider', product_sorting),
        width_slider = $('div#widthSlider', product_sorting),
        height_slider = $('div#heightSlider', product_sorting),
        overall_height_slider = $('div#overallHeightSlider', product_sorting),
        diameter_slider = $('div#diameterSlider', product_sorting),
        diameter_height_slider = $('div#diameterHeightSlider', product_sorting),
        d_overall_height_slider = $('div#overallDiameterHeightSlider', product_sorting),
        dims_reset = $('.reset', product_sorting),
        order_link = $('.ordering', product_sorting),
        loading = $('.loading', prod_wrapper),
        hash_params = window.location.hash.substring(1).split(';'),
        per_page, spread,
        prod_filters, prod_total, max_page,
        show_start, show_end,
        page_to_get, page_num_to_get, page_call, get_bounds,
        tmp = [],
        i, sub_params, pajax;
    // }}}

    //{{{ parse hash_params
    if(hash_params[0] !== ''){
        for (i = hash_params.length -1; i>=0; i--){
            sub_params = hash_params[i].split('=');
            if(sub_params[1] !== ''){
                tmp[sub_params[0]] = sub_params[1].split(',');
           }
        }
    }
    hash_params = tmp;
    // }}}
// {{{ cross-browser placeholders for text inputs
    $('[placeholder]').focus(function() {
      var input = $(this);
      if (input.val() === input.attr('placeholder')) {
        input.val('');
        input.removeClass('placeholder').css('font-weight', 'normal');
        input.css('background', '#ffffff');
      }
    }).blur(function() {
      var input = $(this);
      if (input.val() === '' || input.val() === input.attr('placeholder')) {
        input.addClass('placeholder').css('font-weight', '700');
        input.val(input.attr('placeholder'));
      }
    }).blur();
// }}}
    // {{{ function fix_size_filter_height()
    function fix_size_filter_height(){
        if(lwh_form !== undefined){
            var lwh_fh = lwh_form.outerHeight(),
                dia_fh = dia_form.outerHeight();
            if(lwh_fh > dia_fh){
                dia_form.height(lwh_fh);
            }
            else if(lwh_fh < dia_fh){
                lwh_form.height(dia_fh);
            }
        }
    }
    // }}} 
// {{{ make sure the page is tall enough to keep the logo at the bottom of the window
// get height to position footer at the bottom
    function fitHeight() {
        var page = $("body"),
        myHeight = 0,
            padHeight = 0,
            mainDiv = $("#main"),
            containerDiv = $("#container"),
            containerHeight = 0,
            containerWidth = 0;

        if((page.hasClass("home")) === false) {
        myHeight = $(window).height();
        containerHeight = containerDiv.height();
        // console.log("window height: " + myHeight + " | container div initial height: " + containerHeight);
        padHeight = myHeight - containerHeight;
        // containerDiv.css("min-height", myHeight);
        // mainDiv.css("padding-bottom", padHeight).addClass("padded");
        }


    }

   fitHeight();
   // }}}
// {{{ mobile
    var current = $(".mobile #topNav li.current"),
        current_sub = current.find(".subMenu");
    $(".mobile #topNav .subMenu").not(current_sub).hide();
    current_sub.show();
    current_sub.parent("li").addClass("opened");

    $(".mobile #primary a").on({
        // mouseover: function(e) { e.preventDefault(); },
        click: function(e) {
             var el = $(this),
              el_parent = el.parent("li");

            /*
             if(el_parent.is('.opened')) {
                return;
                }
             else if(el.is('.cat'))
            */
            if(el_parent.not('.opened') && el.is('.cat')) {
                e.preventDefault();
                var el_submenu = el.next(".subMenu");
                    el_submenu.toggle();
                    el_parent.addClass("opened");
                    $(".subMenu").not(el_submenu).hide();
                }
           }
        });
// }}} 
// {{{ thumbnail hover
    $('ul .product a, .relatedThumb').on({
        mouseenter: function() {
            var el = $(this),
            overlay = el.find( ".productOverlay" );
            el.addClass("reveal");
            overlay.stop(true,true).animate({opacity:0.9}, 400);
            },
        mouseleave: function() {
            var el = $(this),
            overlay = el.find( ".productOverlay" );
            el.removeClass("reveal");
            overlay.stop(true,true).animate({opacity:0}, 400);
            }
        });
// }}} 
// {{{ get PDF
    $(".getPdf").on({
        click: function(e) {
            var el = $(this);
            var icon = el.find("span");
            e.preventDefault();
            icon.attr('data-icon', 's').html('<br>Opening...');
            setTimeout(function(){
                window.open(el.attr('href'));
                icon.attr('data-icon', 'A').html('<br>PDF');
                el.attr(':hover', '');
                return false;
            }, 700);
        }
    });

    $(".no-csstransitions .getPdf").find("span").css("opacity", "0");

    $(".no-csstransitions .getPdf").on({
        mouseenter:function(e) {
            var el = $(this),
                elimg = el.find("img"),
                elpdf = el.find("span");
            e.preventDefault();
            // el.attr(':hover', '');
            elimg.stop().fadeTo('400', 0.3);
            elpdf.css('opacity',0).stop().fadeTo('400', 1);
        },
        mouseleave:function(e) {
            var el = $(this),
                elimg = el.find("img"),
                elpdf = el.find("span");
            e.preventDefault();
            elimg.stop().fadeTo('400', 1);
            elpdf.stop().fadeTo('400', 0);
        }
    });
// }}} 
    // {{{ modals
    modalOpener.click(
        function() {
        var opener = $(this),
            openerIcon = opener.find('span'),
            modal = opener.next('.modal');


        $('.modal').not(modal).slideUp(200);
        modalOpener.not(opener).removeClass('opened').find('span').attr('data-icon', 'D');

        if (openerIcon.attr('data-icon') === 'D') {
            openerIcon.attr('data-icon', 'U');
            if(opener.hasClass('filterBySize')){
                modal.slideDown(200);
                fix_size_filter_height();
                fix_size_filter_height();
            }
            else{
                modal.delay(100).slideDown(200);
            }

            opener.addClass('opened');
        }
        else {
            openerIcon.attr('data-icon', 'D');
            opener.removeClass('opened');
            opener.hasClass('filterBySize')
                ? modal.slideUp(200)
                : modal.delay(100).slideUp(200);
        }

        div_slider.rangeSlider('resize');
    });

    $('.hasTertiary').attr("data-state", "closed").css("height", "20px").css("background", "#f4f4f4");
    $(".submodalOpener").toggle(
        function(){
            var parentItem = $(this).parent('.hasTertiary');
            $(this).html("<span class='openedIcon' data-icon='U'></span>")
            .next(".tertiaries").slideDown(200);
            parentItem.css("height", "auto").attr("data-state", "open");
             },
        function(){
            var parentItem = $(this).parent('.hasTertiary');
            $(this).html("<span class='closedIcon' data-icon='D'></span>")
            .next(".tertiaries").slideUp(200);
            if( parentItem.attr("data-state") === 'open' ) {
                parentItem.attr("data-state", "closed");
            }
         }
    );

    // close modals by clicking outside of them
    $("html").mousedown(function(e) {
        var clicked = $(e.target),
            exclude = $(".modal, .filterBy, .emailItem, .emailButton, .saveItem"),
            include = $(".modal .close, .modal .close span, .clear-all-filters, .filter, #size-filter");
        if ((!clicked.is(exclude)  && !clicked.parents().is(exclude)) ||
            clicked.is(include) || clicked.parents().is(include)) {
           // include.hide();
            $('.modal').slideUp(200);
            $('.modalOpener').removeClass('opened');
            $('.modalOpener span').attr('data-icon', 'D');
        }
    });

    $("#navTabber a").on({
        click: function(){
            var nel = $(this),
                n_header = nel.parents('#header'),
                nav = $("#topNav");

            if(n_header.hasClass('open')){
                n_header.removeClass('open').css({zIndex:'10'});
                $("#navTabber").css('background', 'rgba(236, 236, 236, 0.95)');
                nav.stop(true,true).animate({top:"0px"}, 400);
                $("#navTabber a").html("D");
            }
            else {
                n_header.addClass('open').css({zIndex:'500'});
                $("#navTabber").css('background', 'none');
                nav.stop(true,true).animate({top:"275px"}, 400);
                $("#navTabber a").html("U");
            }
        }
    });




    // }}}
    // {{{ searching
    // initialize autocomplete on keydown
    search_input.on({
        keydown : function(){
            if(search_input.data('loaded') === false){
                search_input.data('loaded', true);
                $.post('/rpc/autocomplete/fetch/', { proceed : true },
                    function(data){
                        for(var i in data.tags){
                            data.tags[i] = $('<div/>').html(data.tags[i]).text();
                        }
                        search_input.autocomplete({
                            source : function(request, response){
                                var results = $.ui.autocomplete.filter(data.tags,request.term);
                                response(results.slice(0,10));
                            }
                        });
                    }, 'json');
            }
        }
    });

    // search box functionality
    var perform_search = function(e){
            var el = $(this),
                continue_search = false,
                search_count = $.cookie('search[count]'),
                date = new Date(),
                minutes = 10,
                el_search_input = $('.search_input', el),
                el_name = el.attr('id'),
                block = $.cookie('block_search');
            e.preventDefault();
            if(false){
            //if(block){
                alert('You have searched too many times within 1 minute!\n\nYou are now blocked from searching. Please try again in a few minutes.');
                return false;
            }
            if(false){
            //if(search_count > 5){
                alert('You have searched too many times within 1 minute!\n\nYou are now blocked from searching for 10 minutes.');
                $.removeCookie('search[count]');
                date.setTime(date.getTime() + (minutes * 60 * 1000));
                $.cookie('block_search', true, { expires: date});
                return false;
            }
            if(el_search_input.val().length >2){
                $.post( '/rpc/autocomplete/user-query/',
                    { proceed : true, query : el_search_input.val() },
                    function(data){
                        if(data.success){
                            document.forms[el_name].submit();
                        }
                    }, 'json');
            }
            else{
                alert('Minimum characters to search is 3.');
                return false;
            }
        };
    search_form.on({ submit: perform_search });
    search_form_404.on({ submit: perform_search });
    // }}}
// {{{ pagination and filters
    // {{{ function parse_round(dim, round_up)
    function parse_round(dim, round_up){
        var result = 0,
            round_up = typeof round_up !== 'undefined' ? round_up : false;
        if(dim !== null && dim !== undefined){
            result = round_up
                ? Math.ceil(parseFloat(dim))
                : Math.floor(parseFloat(dim));
        }
        return result;
    }
    // }}}
    // {{{ function add_filter_tag(filter_id)
    function add_filter_tag(filter_id){
        var el_tag, filter_label;
        if(filter_id === 'size-filter'){
            filter_label = 'size filter';
            el_tag = $('<li class="filter"><a href="javascript:;"><span>x</span><label></label></a></li>')
                .on({
                    click : function(){ dims_reset.click(); }
                });
        }
        else{
            filter_label = $('input[id="'+filter_id+'"]', product_sorting).attr('checked', true).siblings('label').text();
            el_tag = filter_tag.clone(true);
        }
        el_tag.attr('id', filter_id);
        el_tag.find('label').html(filter_label);
        filterArea.append(el_tag);
        clear_all_filters.css('display', 'block');
    }
    // }}}
    // {{{ function get_hash_url()
    function get_hash_url(){
        var tmp =[];
        for (var k in hash_params){
            if(typeof hash_params[k] === 'array'){
                hash_params[k] = hash_params[k].join(',');
            }
            tmp.push(k + '=' + hash_params[k]);
        }
        return '#'+tmp.join(';');
    }
    // }}}
    // {{{ function refilter(prod_filters)
    function refilter(prod_filters){
        clearTimeout(page_call);
        var url = document.URL.split("#");
        delete hash_params.page;
        prod_wrapper.data('filters', prod_filters);
        tmp = get_hash_url();
        if(tmp === '#'){ clear_all_filters.hide(); }
        url = url[0] + tmp;
        window.location.href=url;
        page_call = setTimeout(function(){
            $('.products', prod_wrapper).fadeOut(300, function(){
                $(this).remove();
                get_page(1);
                // keep filters from getting hidden behind products
                filterArea.parents(".sticky-wrapper").css("height", "auto");
            });
            fitHeight();
        }, 700);

    }
    // }}}
    // {{{ function paginate(cur_page)
    function paginate(cur_page, empty){
        empty = typeof empty !== 'undefined' ? empty : false;
        prod_total = empty ? 0 : prod_wrapper.data('total');
        max_page = Math.ceil(prod_total/per_page);
        if(cur_page === 'all'){
            $('.paging', paginator).hide();
            next_page_btn.hide();
            prev_page_btn.hide();
            footer_show_all.html('<span>Showing page 1 of 1</span>');
            sorting_show_all.hide();
            show_start = 1;
            show_end = prod_total;
        }
        else{
            $('.paging', paginator).not('[data-page="1"],[data-page="'+max_page+'"]').hide();
            cur_page = parseInt(cur_page,10);
            var page_start = cur_page - spread,
                page_end = cur_page + spread,
                i;
            if(page_start < 1){
                page_end += 1-page_start;
                page_start = 1;
            }
            if(page_end > max_page){
                page_start -= page_end-max_page;
                page_end = max_page;
            }

            // fix ellipsis
            (cur_page - spread > 2) && (page_start !== 1)
                ?  f_ellipsis.show() : f_ellipsis.hide();
            (cur_page + spread < (max_page-1)) && (page_end !== max_page)
                ?  b_ellipsis.show() : b_ellipsis.hide();

            // fix next and prev btn
            (cur_page === max_page || prod_total === 0)
                ?  next_page_btn.hide() : next_page_btn.show();
            (cur_page === 1)
                ?  prev_page_btn.hide() : prev_page_btn.show();

            // fix show all btn
            if(prod_total < per_page){
                footer_show_all.empty().append('<span>Showing page 1 of 1</span>');
                sorting_show_all.hide();
            }
            else{
                footer_show_all.empty().append(show_all_btn.clone(true).text('Show All '+prod_total+' Pieces'));
                sorting_show_all.show();
            }

            // show paging #
            if(max_page > 1){
                for( i = page_start; i<= page_end; i++){
                    paginator.find('.paging[data-page="'+i+'"]').show();
                }
            }
            show_start = prod_total === 0 ? 0 : per_page * (cur_page - 1) +1;
            show_end = per_page * cur_page > prod_total ? prod_total : per_page * cur_page;
        }
        // fix showing label
        shown_label.html( 'Showing: '+show_start+'-'+show_end+' of '+ prod_total );
    }
    // }}}
    // {{{ function get_page(el_page)
    function get_page(el_page, auto){
        get_bounds = paginator.data('bounds') === undefined;
        auto = typeof auto !== 'undefined' ? auto : true;
        loading.show();
        page_to_get = prod_wrapper.find( $('.products[data-page="'+el_page+'"]') );
        if( page_to_get.length){
            // if page already exists
            page_to_get.fadeIn(300);
            paginator.data('cur_page', el_page);
            if(auto){
                paginate(el_page);
            }
            loading.hide();
        }
        else{
            //else ajax call
            if(pajax!== undefined){ pajax.abort(); }
            pajax = $.post('/rpc/paginator/'+el_page+'/',
                {
                    proceed : true,
                    per_page : per_page,
                    get_bounds : get_bounds,
                    category : prod_wrapper.data('category'),
                    filters : prod_wrapper.data('filters')
                },
                function(data){
                    if(data.success){
                        var load_box = true, load_circle = true;
                        prod_wrapper.data('total', data.total);
                        prod_wrapper.append(data.page_data);
                        paginator.data('cur_page', el_page);
                        paginator.data('size_range', data.size_range);
                        if(auto){ paginate(el_page); }
                        if(hash_params.dimensions !== undefined){
                            tmp = JSON.parse(hash_params.dimensions);
                            if(tmp.box !== undefined){
                                load_box = false;
                            }
                            if(tmp.circle !== undefined){
                                load_circle = false;
                            }
                        }
                        if(load_box){
                            length_slider.rangeSlider("values", parse_round(data.size_range.min_depth), parse_round(data.size_range.max_depth, true));
                            width_slider.rangeSlider("values", parse_round(data.size_range.min_width), parse_round(data.size_range.max_width, true));
                            height_slider.rangeSlider("values", parse_round(data.size_range.min_height), parse_round(data.size_range.max_height, true));
                            overall_height_slider.rangeSlider("values", parse_round(data.size_range.min_overall_height), parse_round(data.size_range.max_overall_height, true));
                        }
                        if(load_circle){
                            diameter_slider.rangeSlider("values", parse_round(data.size_range.min_diameter), parse_round(data.size_range.max_diameter, true));
                            diameter_height_slider.rangeSlider("values", parse_round(data.size_range.min_diameter_height), parse_round(data.size_range.max_diameter_height, true));
                            d_overall_height_slider.rangeSlider("values", parse_round(data.size_range.min_diameter_overall_height), parse_round(data.size_range.max_diameter_overall_height,true));
                        }
                        if(get_bounds){
                            var dia_fields = 0,
                                lwh_fields = 0,
                                el_min_depth = parse_round(data.bounds.min_depth),
                                el_max_depth = parse_round(data.bounds.max_depth, true),
                                el_min_overall_height = parse_round(data.bounds.min_overall_height),
                                el_max_overall_height = parse_round(data.bounds.max_overall_height, true),
                                el_min_width = parse_round(data.bounds.min_width), 
                                el_max_width = parse_round(data.bounds.max_width, true),
                                el_min_height = parse_round(data.bounds.min_height), 
                                el_max_height = parse_round(data.bounds.max_height, true),
                                el_min_diameter = parse_round(data.bounds.min_diameter), 
                                el_max_diameter = parse_round(data.bounds.max_diameter, true),
                                el_min_diameter_height = parse_round(data.bounds.min_diameter_height), 
                                el_max_diameter_height = parse_round(data.bounds.max_diameter_height, true),
                                el_min_diameter_overall_height = parse_round(data.bounds.min_diameter_overall_height),
                                el_max_diameter_overall_height = parse_round(data.bounds.max_diameter_overall_height,true),
                                blocker = $('<div/>').addClass('blocker').css({
                                    position: 'relative',
                                    zIndex: 100,
                                    height: '85px',
                                    width: '285px',
                                    marginTop: '-95px',
                                    backgroundColor: 'white',
                                    opacity: '0.6',
                                    filter: 'alpha(opacity=60)'
                                });

                            // {{{ init lwh sliders
                            if(el_min_depth === el_max_depth){
                                l_slider_div.append(blocker.clone(true));
                            }
                            else{
                                $('.blocker', l_slider_div).remove();
                                length_slider.rangeSlider("option", "bounds", { min: el_min_depth, max: el_max_depth});
                                lwh_fields++;
                            }
                            if(el_min_width === el_max_width){
                                w_slider_div.append(blocker.clone(true));
                            }
                            else{
                                $('.blocker', w_slider_div).remove();
                                width_slider.rangeSlider("option", "bounds", { min: el_min_width, max: el_max_width});
                                lwh_fields++;
                            }
                            if(el_min_height === el_max_height){
                                h_slider_div.append(blocker.clone(true));
                            }
                            else{
                                $('.blocker', h_slider_div).remove();
                                height_slider.rangeSlider("option", "bounds", { min: el_min_height, max: el_max_height});
                                lwh_fields++;
                            }
                            if(el_min_overall_height === el_max_overall_height){
                                o_h_slider_div.append(blocker.clone(true));
                            }
                            else{
                                $('.blocker', o_h_slider_div).remove();
                                overall_height_slider.rangeSlider("option", "bounds", { min: el_min_overall_height, max: el_max_overall_height});
                                lwh_fields++;
                            }
                            // }}} 
                            // {{{ init dia sliders
                            if(el_min_diameter === el_max_diameter){
                                d_slider_div.append(blocker.clone(true));
                            }
                            else{
                                $('.blocker', d_slider_div).remove();
                                diameter_slider.rangeSlider("option", "bounds", { min: el_min_diameter, max: el_max_diameter});
                                dia_fields++;
                            }

                            if(el_min_diameter_height === el_max_diameter_height){
                                d_h_slider_div.append(blocker.clone(true));
                                diameter_height_slider.rangeSlider("options", "disabled", true);
                            }
                            else{
                                $('.blocker', d_h_slider_div).remove();
                                diameter_height_slider.rangeSlider("option", "bounds", { min: el_min_diameter_height, max: el_max_diameter_height});
                                dia_fields++;
                            }

                            if( el_min_diameter_overall_height === el_max_diameter_overall_height){
                                d_o_h_slider_div.append(blocker.clone(true));
                            }
                            else{
                                $('.blocker', d_o_h_slider_div).remove();
                                d_overall_height_slider.rangeSlider("option", "bounds", { min: el_min_diameter_overall_height, max: el_max_diameter_overall_height});
                                dia_fields++;
                            }
                            // }}} 
                            dia_fields > 0 ? $('.reset', dia_form).show() : $('.reset', dia_form).hide();
                            lwh_fields > 0 ? $('.reset', lwh_form).show() : $('.reset', lwh_form).hide();

                            paginator.data('bounds', data.bounds);
                        }

                        div_slider.rangeSlider('resize');
                        setTimeout(function(){ prod_wrapper.find( $('.products[data-page="'+el_page+'"]') ).fadeIn(300);}, 300);
                    }
                    else{
                        paginate(1, true);
                    }
                    loading.hide();
                }, 'json');
        }
    }
    // }}}
    // {{{ function filter_sizes()
    function filter_sizes(){
        var width = width_slider.rangeSlider('values'),
            height = height_slider.rangeSlider('values'),
            overall_height = overall_height_slider.rangeSlider('values'),
            depth = length_slider.rangeSlider('values'),
            diameter = diameter_slider.rangeSlider('values'),
            diameter_height = diameter_height_slider.rangeSlider('values'),
            diameter_overall_height = d_overall_height_slider.rangeSlider('values');
            prod_filters = prod_wrapper.data('filters');
        if(prod_filters.dimensions === undefined){ prod_filters.dimensions={}; }
        if($(this).parent().parent('form').attr('id') === 'diameter'){
            if(prod_filters.dimensions.circle === undefined){ prod_filters.dimensions.circle={}; }
            prod_filters.dimensions.circle.diameter = { 0 : diameter.min, 1 : diameter.max };
            prod_filters.dimensions.circle.diameter_height = { 0 : diameter_height.min, 1 : diameter_height.max };
            prod_filters.dimensions.circle.diameter_overall_height = { 0 : diameter_overall_height.min, 1 : diameter_overall_height.max };
        }
        else{
            if(prod_filters.dimensions.box === undefined){ prod_filters.dimensions.box={}; }
            prod_filters.dimensions.box.depth = { 0 : depth.min, 1 : depth.max };
            prod_filters.dimensions.box.width = { 0 : width.min, 1 : width.max };
            prod_filters.dimensions.box.height = { 0 : height.min, 1 : height.max };
            prod_filters.dimensions.box.overall_height = { 0 : overall_height.min, 1 : overall_height.max };
        }
        if(!$('li#size-filter').length){
            add_filter_tag('size-filter');
            size_label.html('Size (1)');
        }
        hash_params.dimensions = JSON.stringify(prod_filters.dimensions);

        refilter(prod_filters);
    }
    // }}}
    if(paginator.length){
        per_page = paginator.data('limit');
        spread = paginator.data('spread');
        // {{{ order_link
        order_link.on({
            click : function(){
                var el = $(this);
                prod_filters = prod_wrapper.data('filters');
                if( el.html() === 'NEWEST'){
                    prod_filters.order_by = 'sp.modified_date ASC';
                    el.html('OLDEST');
                }
                else{
                    prod_filters.order_by = 'sp.modified_date DESC';
                    el.html('NEWEST');
                }
                refilter(prod_filters);
            }
        });
        // }}}
        // {{{ clear all filters
        clear_all_filters
            .on({
                click: function(){
                    var prod_filters = prod_wrapper.data('filters');
                    filterArea.find('li').each(function(){
                        var ele = $(this);
                        $('input[id="'+ ele.attr('id') +'"]', product_sorting).removeAttr('checked');
                        ele.remove();
                    });
                    prod_filters.designers = [],
                    prod_filters.categories = [],
                    prod_filters.tertiarys = [],
                    prod_filters.dimensions = {},
                    hash_params=[],
                    designer_label.html('Designer&nbsp;&nbsp;&nbsp;&nbsp;'),
                    category_label.html('Category&nbsp;&nbsp;&nbsp;&nbsp;'),
                    tert_label.html('Type&nbsp;&nbsp;&nbsp;&nbsp;'),
                    size_label.html('Size&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
                    refilter(prod_filters);
                    $(this).hide();
                }
            });
        // }}}
        // {{{ show All
        show_all_btn.on({
            click : function(){
                var el = $(this),
                    url = document.URL.split("#");
                prod_filters = prod_wrapper.data('filters');
                prod_total = prod_wrapper.data('total');
                max_page = Math.ceil(prod_total/per_page);
                hash_params.page = 'all';
                url = url[0] + get_hash_url();
                window.location.href=url;
                loading.hide();
                tmp = $('.products', prod_wrapper);
                if(tmp.length){
                    tmp.fadeOut(300, function(){
                        $(this).remove();
                        get_all_pages(1, max_page);
                        paginator.data('cur_page', 1);
                        paginate('all');
                    });
                }
                else{
                    get_all_pages(1, max_page);
                    paginator.data('cur_page', 1);
                    paginate('all');
                }
                function get_all_pages(el_page, max){
                    $.post('/rpc/paginator/'+el_page+'/',
                        {
                            proceed : true,
                            per_page : per_page,
                            filters : prod_wrapper.data('filters')
                        },
                        function(data){
                            var load_box = true, load_circle = true;
                            if(data.success){
                                prod_wrapper.data('total', data.total);
                                prod_wrapper.append(data.page_data);
                                if(data.size_range !== undefined){
                                    paginator.data('size_range', data.size_range);
                                    if(hash_params.dimensions !== undefined){
                                        tmp = JSON.parse(hash_params.dimensions);
                                        if(tmp.box !== undefined){
                                            load_box = false;
                                        }
                                        if(tmp.circle !== undefined){
                                            load_circle = false;
                                        }
                                    }
                                    if(load_box){
                                        length_slider.rangeSlider("values", data.size_range.min_depth, data.size_range.max_depth);
                                        width_slider.rangeSlider("values", data.size_range.min_width, data.size_range.max_width);
                                        height_slider.rangeSlider("values", data.size_range.min_height, data.size_range.max_height);
                                        overall_height_slider.rangeSlider("values", data.size_range.min_overall_height, data.size_range.max_overall_height);
                                    }
                                    if(load_circle){
                                        diameter_slider.rangeSlider("values", data.size_range.min_diameter, data.size_range.max_diameter);
                                        diameter_height_slider.rangeSlider("values", data.size_range.min_diameter_height, data.size_range.max_diameter_height);
                                        d_overall_height_slider.rangeSlider("values", data.size_range.min_diameter_overall_height, data.size_range.max_diameter_overall_height);
                                    }
                                }
                                prod_wrapper.find( $('.products[data-page="'+el_page+'"]') ).fadeIn(500);
                                el_page++;
                                if(el_page<= max_page){
                                    setTimeout(function(){get_all_pages(el_page, max_page);}, 1500);
                                }
                            }
                        }, 'json');
                }
            }
        });
        // }}}
        // {{{ paginate_btn listener
        paginate_btn.on({
            click : function(){
                var el = $(this),
                    el_page = el.data('page'),
                    cur_page_num = paginator.data('cur_page'),
                    url = document.URL.split("#");
                    prod_filters = prod_wrapper.data('filters');
                    prod_total = prod_wrapper.data('total');
                    max_page = Math.ceil(prod_total/per_page);
                $('.products', prod_wrapper).hide();
                switch(el_page){
                    case 'next':
                        page_num_to_get = cur_page_num + 1;
                    break;
                    case 'prev':
                        page_num_to_get = cur_page_num - 1;
                    break;
                    default:
                        page_num_to_get = el_page;
                    break;
                }
                hash_params.page = page_num_to_get;
                url = url[0] + get_hash_url();
                window.location.href=url;
                get_page(page_num_to_get);
            }
        });
        // }}}
        // {{{ filter by size
        length_slider.bind('userValuesChanged', filter_sizes);
        width_slider.bind('userValuesChanged', filter_sizes);
        height_slider.bind('userValuesChanged', filter_sizes);
        overall_height_slider.bind('userValuesChanged', filter_sizes);
        diameter_slider.bind('userValuesChanged', filter_sizes);
        diameter_height_slider.bind('userValuesChanged', filter_sizes);
        d_overall_height_slider.bind('userValuesChanged', filter_sizes);

        // reset sizes
        dims_reset.on({
            click : function(){
                var update = false;
                prod_filters = prod_wrapper.data('filters');
                if(prod_filters.dimensions !== undefined){
                    if($(this).parent('form').attr('id') === 'diameter' && prod_filters.dimensions.circle !== undefined){
                        delete prod_filters.dimensions.circle;
                        update = true;
                    }
                    else if($(this).parent('form').attr('id') === 'lwh' && prod_filters.dimensions.box !== undefined){
                        delete prod_filters.dimensions.box;
                        update = true;
                    }
                    if(update){
                        if(prod_filters.dimensions.box === undefined && prod_filters.dimensions.circle === undefined){
                            delete prod_filters.dimensions;
                            delete hash_params.dimensions;
                            $('li#size-filter').remove();
                            size_label.html('Size&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
                        }
                        else{
                            hash_params.dimensions = JSON.stringify(prod_filters.dimensions);
                        }
                        // $(this).parent('form').parent().parent().siblings('.filterBySize').click();
                        refilter(prod_filters);
                    }
                }
            }
        });
        // }}}
        // {{{ filter by tertiary
        $('input[name^="filter[tertiary]"]', product_sorting).on({
            click : function(){
                var el = $(this),
                    tert_slug = el.val(),
                    prod_filters = prod_wrapper.data('filters'),
                    filter_id = el.attr('id'),
                    el_tag = filterArea.find('li#'+filter_id);
                if(prod_filters.tertiarys === undefined){
                    prod_filters.tertiarys=[];
                }
                if(el_tag.length){
                    el_tag.remove();
                    prod_filters.tertiarys.splice( $.inArray(tert_slug, prod_filters.tertiarys), 1 );
                }
                else{
                    add_filter_tag(filter_id);
                    prod_filters.tertiarys.push(tert_slug);
                }

                if(prod_filters.tertiarys.length){
                    hash_params.tertiarys = prod_filters.tertiarys;
                    tert_label.html('Type ('+hash_params.tertiarys.length+')');
                }
                else{
                    delete hash_params.tertiarys;
                    tert_label.html('Type&nbsp;&nbsp;&nbsp;&nbsp;');
                }

                refilter(prod_filters);
            }
        });
        // }}}
        // {{{ filter by designer
        $('input[name^="filter[designers]"]', product_sorting).on({
            click : function(){
                var el = $(this),
                    designer_id = el.val(),
                    prod_filters = prod_wrapper.data('filters'),
                    filter_id = el.attr('id'),
                    el_tag = filterArea.find('li#'+filter_id);
                if(prod_filters.designers === undefined){
                    prod_filters.designers=[];
                }
                // change designer filter
                if(el_tag.length){
                    el_tag.remove();
                    prod_filters.designers.splice( $.inArray(designer_id, prod_filters.designers), 1 );
                }
                else{
                    add_filter_tag(filter_id);
                    prod_filters.designers.push(designer_id);
                }

                if(prod_filters.designers.length){
                    hash_params.designers = prod_filters.designers;
                    designer_label.html('Designer ('+hash_params.designers.length+')');
                }
                else{
                    delete hash_params.designers;
                    designer_label.html('Designer&nbsp;&nbsp;&nbsp;&nbsp;');
                }

                refilter(prod_filters);
            }
        });
        // }}}
        // {{{ filter search by category
        $('input[name^="filter[categories]"]', product_sorting).on({
            click : function(){
                var el = $(this),
                    category_slug = el.val(),
                    prod_filters = prod_wrapper.data('filters'),
                    filter_id = el.attr('id'),
                    el_tag = filterArea.find('li#'+filter_id);
                if(prod_filters.categories === undefined){
                    prod_filters.categories=[];
                }
                // change designer filter
                if(el_tag.length){
                    el_tag.remove();
                    prod_filters.categories.splice( $.inArray(category_slug, prod_filters.categories), 1 );
                }
                else{
                    add_filter_tag(filter_id);
                    prod_filters.categories.push(category_slug);
                }

                if(prod_filters.categories.length){
                    hash_params.categories = prod_filters.categories;
                    category_label.html('Category ('+hash_params.categories.length+')');
                }
                else{
                    delete hash_params.categories;
                    category_label.html('Category&nbsp;&nbsp;&nbsp;&nbsp;');
                }
                paginator.removeData('bounds');

                refilter(prod_filters);
            }
        });
        $('.select-all', product_sorting).on({
            click: function(){
                var el = $(this),
                    el_cat = el.parent();
                if(el.hasClass('selected')){
                    el.removeClass('selected').html('select all');
                    el_cat.find('input:checkbox:checked')
                        .each(function(){
                            $(this).click();
                        });
                }
                else{
                    el.addClass('selected').html('clear all');
                    el_cat.find('input:checkbox:not(:checked)')
                        .each(function(){
                            $(this).click()
                                .siblings('label').click();
                        });
                }
            }
        });
        // }}}
        // {{{  initiate and load hash params
        prod_filters = prod_wrapper.data('filters');
        // designers
        if(hash_params.hasOwnProperty("designers")){
            for(i = hash_params.designers.length-1; i>=0; i--){
                add_filter_tag(hash_params.designers[i]);
            }
            designer_label.html('Designer ('+hash_params.designers.length+')');
            prod_filters.designers = hash_params.designers;
        }
        //tertiarys
        if(hash_params.hasOwnProperty("tertiarys")){
            for(i = hash_params.tertiarys.length-1; i>=0; i--){
                add_filter_tag(hash_params.tertiarys[i]);
            }
            tert_label.html('Type ('+hash_params.tertiarys.length+')');
            prod_filters.tertiarys = hash_params.tertiarys;
        }
        //categories
        if(hash_params.hasOwnProperty("categories")){
            for(i = hash_params.categories.length-1; i>=0; i--){
                add_filter_tag(hash_params.categories[i]);
            }
            category_label.html('Category ('+hash_params.categories.length+')');
            prod_filters.categories = hash_params.categories;
        }
        // load size defaults
        if(hash_params.hasOwnProperty("dimensions")){
            tmp = JSON.parse(hash_params.dimensions);
            if(tmp.box !== undefined){
                length_slider.rangeSlider("values", tmp.box.depth[0], tmp.box.depth[1]);
                width_slider.rangeSlider("values", tmp.box.width[0], tmp.box.width[1]);
                height_slider.rangeSlider("values", tmp.box.height[0], tmp.box.height[1]);
                overall_height_slider.rangeSlider("values", tmp.box.overall_height[0], tmp.box.overall_height[1]);
            }
            if(tmp.circle !== undefined){
                diameter_slider.rangeSlider("values", tmp.circle.diameter[0], tmp.circle.diameter[1]);
                diameter_height_slider.rangeSlider("values", tmp.circle.diameter_height[0], tmp.circle.diameter_height[1]);
                d_overall_height_slider.rangeSlider("values", tmp.circle.diameter_overall_height[0], tmp.circle.diameter_overall_height[1]);
            }
            add_filter_tag('size-filter');
            size_label.html('Size (1)');
            prod_filters.dimensions = tmp;
        }
        prod_wrapper.data('filters',prod_filters);
        // page
        if(hash_params.hasOwnProperty("page")){
            $.inArray('all', hash_params.page) !== -1
                ?  show_all_btn.click()
                : get_page(hash_params.page);
        }
        else{
            get_page(paginator.data('cur_page'));
        }
    // }}}
    }
// }}}
    // {{{  saved list
    $('.saveItem').click(function() {
        var el = $(this);
        if(el.data('added') === undefined){
            el.html("Adding... <span data-icon='~'></span>")
                .addClass("adding");
            $.post('/rpc/my_list/save/',
                { proceed : true, data : el.data('id') },
                function(data){
                    if(data.success){
                        el.html("Added to List <span data-icon='v'></span>")
                            .removeClass('adding')
                            .addClass("added");
                        $('div.itemSaved').fadeIn();
                        el.data('added', true);
                    }
                }, 'json');
        }
    });
    $('.removeButton').on({
        click : function(){
            $.post('/rpc/my_list/remove_all/',
                { proceed : true },
                function(data){
                    if(data.success){
                        window.location = '/my-saved-list/';
                    }
                }, 'json');
        }
    });

    $('.contButton').click(function() {
        $(this).parent().fadeOut(400);
    });

    $('.unlistButton').on({
        click : function() {
            var el = $(this);
            $.post('/rpc/my_list/remove_entry/',
                { proceed : true, id : el.data('id') },
                function(data){
                    if(data.success){
                        if(data.count === 0){
                            window.location = '/my-saved-list/';
                        }
                        else{
                            el.parents('.savedItemBox').slideUp(400);
                            $('.itemsCount').html(data.count + ' items');
                            // $('.s_pids').val(el.data('id'));
                        }
                    }
                    console.log(data);
                }, 'json');

        }
    });
    // }}}
    // {{{ send list via email my list
    $('#sendListForm').submit(function(e){
        e.preventDefault();
        var form = $(this),
            submit = true,
            el_submit = $('.emailListButton').val('Sending'),
            el_input = $('input, textarea', form);
        el_input.each(function(){
            var el = $(this);
            el.css({ border: '1px solid #DDD' });
            if ( !el.hasClass('not-required')
                && (el.val()==='' || el.val() === el.attr('placeholder'))
                && el.attr('type') !== 'hidden' ){
                submit=false;
                el.css({
                    border: '1px solid red'
                });
            }
            else if(el.hasClass('not-required') && el.val()=== el.attr('placeholder')){
                el.val('');
            }
        });

        if(!submit){
            alert('Please fill out all the required fields in red');
            el_submit.val('Send');
        }
        else{
                var post_url = '/rpc/email_list/',
                data = {
                  key: 'jephieFieG4guheichai9ieGh',
                  from: {
                    email: $('#sendFrom', form).val(),
                    name: $('#sendFromName', form).val()
                  },
                  tos: [
                    {
                      email: $('#sendTo', form).val(),
                      name: $('#sendTo', form).val()
                    }
                  ],
                  message: $('#message', form).val()
                };

                $.post(post_url, data, function(response) {
                    if(response && response.success) {
                        el_submit.val('Sent');

                        // reveal a success message if the email sent normally
                         $("#listSuccess")
                        .removeClass("listSending")
                        .addClass("listSent")
                        .stop(true,true).animate({opacity:0.95}, 200);

                        // the sendAgain and closeSent buttons weren't in the design comps
                        // but I thought they could be a good addition;
                        // if they give you trouble they can be pretty safely removed or commented out.

                        $("#sendAgain").on({
                            click: function() {
                                $("#listSuccess").css({opacity:0})
                                .addClass("listSending")
                                .removeClass("listSent");
                                $('#sendTo').val('');
                                el_submit.val('Send');
                            }
                        });

                        $("#closeSent").on({
                            click: function() {
                                form.parent(".modal").slideUp();
                            }
                        });

                    }
                    else if(!response || !response.success) {
                        var errormsg = 'Not sent; please check the following:';
                        if(response.errors) { errormsg = errormsg + '\n \n' + (response.errors).join('\n \n'); }
                        el_submit.val('Send');
                        alert(errormsg);
                    }
                }, 'json');
        }
    });


    $(".emailButton").on({
        click: function() {
            sendListModal.slideToggle(200);
            $(this).toggleClass("opened");
        }
    });
    // }}}
    // {{{ send item via email from product page

   $('#sendItemForm').submit(function(e){
        e.preventDefault();
        var form = $(this),
            submit = true,
            el_submit = $('#emailProduct').val('Sending'),
            error_notice = $('.error-notice').text(''),
            el_input = $('input, textarea', form);
            el_input.each(function(){
                var el = $(this);
                el.css({ border: '1px solid #DDD' });
                if ( !el.hasClass('not-required')
                    && (el.val()==='' || el.val() === el.attr('placeholder'))
                    && el.attr('type') !== 'hidden' ){
                    submit=false;
                    el.css({
                        border: '1px solid red'
                    });
                }
                else if(el.hasClass('not-required') && el.val()=== el.attr('placeholder')){
                    el.val('');
                }
            });
            if(!submit){
                error_notice.text('Please fill out all required fields in red');
               // alert('Please fill out all the required fields in red');
                el_submit.val('Send');
            }
            else{
                var post_url = '/rpc/email_product/',
                data = {
                  key: 'jephieFieG4guheichai9ieGh',
                  from: {
                    email: $('#sendFrom', form).val(),
                    name: $('#sendFromName', form).val()
                  },
                  tos: [
                    {
                      email: $('#sendTo', form).val(),
                      name: $('#sendTo', form).val()
                    }
                  ],
                  message: $('#message', form).val(),
                  pid: $('.pid', form).val(),
                  ptitle: $('.ptitle', form).val(),
                  ppath: $('.ppath', form).val()
                };

                $.post(post_url, data, function(response) {

                    if(response && response.success) {
                        $("#success")
                        .removeClass("productSending")
                        .addClass("productSent")
                        .stop(true,true).animate({opacity:0.95}, 200);

                        $("#sendAgain").on({
                            click: function() {
                                $("#success").css({opacity:0})
                                .addClass("productSending")
                                .removeClass("productSent");
                                $('#sendTo').val('');
                                el_submit.val('Send');
                            }
                        });

                        $("#closeSent").on({
                            click: function() {
                                form.parent(".modal").slideUp();
                            }
                        });

                    }
                    else if(!response || !response.success) {
                        var errormsg = 'Not sent; please check the following:';
                        if(response.errors) { errormsg = errormsg + '\n \n' + (response.errors).join('\n \n'); }
                        el_submit.val('Send');
                        alert(errormsg);
                    }

                }, 'json');
            }
        });


    $('.emailItem').on({
        click: function() {
        $('div.sendItem').slideToggle();
        }
    });

    // }}}
    // {{{ contact form, styled select box
    $('#subject', contact_form).customSelect({customClass:'customSubject'});
    contact_form.on({
        submit : function(){
            var ele = $(this),
                submit = true,
                error_notice = $('.error-notice', ele).text(''),
                el_input = $('input, textarea', ele);
            el_input.each(function(){
                var el = $(this);
                el.css({ border: '1px solid #DDD' });
                if ( !el.hasClass('not-required')
                    && (el.val()==='' || el.val() === el.attr('placeholder'))
                    && el.attr('type') !== 'hidden' ){
                    submit=false;
                    el.css({
                        border: '1px solid red'
                    });
                }
                else if(el.hasClass('not-required') && el.val()=== el.attr('placeholder')){
                    el.val('');
                }
            });
            if(!submit){
                error_notice.text('Please fill out all required fields in red');
            }
            return submit;
        }
    });
    // }}}

});

// (function(doc) {

//     var addEvent = 'addEventListener',
//         type = 'gesturestart',
//         qsa = 'querySelectorAll',
//         scales = [1, 1],
//         meta = qsa in doc ? doc[qsa]('meta[name=viewport]') : [];

//     function fix() {
//         meta.content = 'width=device-width, minimum-scale=' + scales[0] + ',maximum-scale=' + scales[1];
//         doc.removeEventListener(type, fix, true);
//     }

//     if ((meta = meta[meta.length - 1]) && addEvent in doc) {
//         fix();
//         scales = [.25, 1.6];
//         doc[addEvent](type, fix, true);
//     }

// }(document));
