    </div>

        <footer id="footer">
            <div id="mainFooter" class="fourCol gridWrapper">
                <div id="col1" class="quarterCol">
                 <?php
                    if(Module::is_active('Menu')) :
                    $f1nav = Menu::get_menu_by_name('Footer One');
                        foreach(deka(array(), $f1nav,'data') as $menu_item) :
                            $linkclass = $menu_item['slug'];
                            echo '<li class="' . $linkclass . '">';
                            if(function_exists('get_cat_link')) echo get_cat_link($menu_item);
                            echo '</li>';
                        endforeach; // deka(array(), nav, 'data') as menu_item
                    endif;
                    ?>
                </div>
                <div id="col2" class="quarterCol">
                 <?php
                    if(Module::is_active('Menu')) :
                    $f2nav = Menu::get_menu_by_name('Footer Two');
                        foreach(deka(array(), $f2nav,'data') as $menu_item) :
                            $linkclass = $menu_item['slug'];
                            echo '<li class="' . $linkclass . '">';
                            if(function_exists('get_cat_link')) echo get_cat_link($menu_item);
                            echo '</li>';
                        endforeach; // deka(array(), nav, 'data') as menu_item
                    endif;
                    ?>
                </div>
                <div id="col3" class="quarterCol">
                <?php
                    if(Module::is_active('Menu')) :
                    $f3nav = Menu::get_menu_by_name('Footer Three');
                        foreach(deka(array(), $f3nav,'data') as $menu_item) :
                            if(function_exists('get_menu_listing_adv'))
                                echo get_menu_listing_adv($menu_item);
                        endforeach; // deka(array(), nav, 'data') as menu_item
                    endif;
                    ?>
                </div>
                <div id="col4" class="quarterCol talignRight">
                    <span class="copyright">&copy; John Salibello 2013</span>
                    <span class="credits"><a href="http://kratedesign.com">Site by Krate</a></span>
                </div>
            </div>
        </footer>
      <!--   <ul id="secondary-mobile">
            <li id="logo-mobile">
                <a href="/"><img src="<?php // echo $logourl; ?>"></a>
            </li>
            <?php // get_top_menu(Menu::get_menu_by_name('Secondary'));?>
        </ul> -->
    </div>
    <?php 
    $foot['req_js'][] = "js/libs/jquery-1.7.1.min.js";
    //$foot['req_js'][] = "js/libs/jquery-1.9.1.min.js";
    $foot['req_js'][] = "js/libs/jquery-ui-1.8.16.custom.min.js";
    $foot['req_js'][] = "js/plugins.js";
    $foot['req_js'][] = "js/script.js";
    $foot['js'] = array_merge($foot['req_js'], deka(array(), $foot, 'js'));
    array_walk($foot['js'], 'walk_ltrim', '/');
    ?>
    <script src="/min/?f=<?php echo implode(',',$foot['js']);?>"></script>

    <script>
        var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
        (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
        g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
        s.parentNode.insertBefore(g,s)}(document,'script'));
    </script>

    </body>
</html>
