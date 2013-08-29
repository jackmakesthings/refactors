<?php
$nav = isset($nav) ? $nav : Menu::get_menu_by_name('Primary');
/* top nav menu templating - a front-end module */
function get_top_menu($nav){
        foreach(deka(array(), $nav,'data') as $menu_item) :
            $linkclass = $menu_item['slug'];
            if( (defined('URI_PART_0')) && ($linkclass === URI_PART_0 ) ) $linkclass .= ' current';
            echo '<li class="' . $linkclass . '">';
                echo get_cat_link($menu_item);

            if(deka(array(), $menu_item, 'children')) :
                echo '<ul class="subMenu">';
                foreach($menu_item['children'] as $k => $sub_menu_item) :
                    $sublinkclass = $k+1;
                    if($k+1 === count($menu_item['children'])) $sublinkclass .= ' last';
                    echo '<li class="' . $sublinkclass . '">';
                        echo get_subcat_link($menu_item, $sub_menu_item);
                    echo '</li>';
                endforeach; // menu_item['children'] as sub_menu_item
                echo '</ul>';
            endif;  // deka(array(), menu_item, 'children'

            echo '</li>';
        endforeach; // deka(array(), nav, 'data') as menu_item
}
?>
<ul id="primary">
<?php if(Module::is_active('Menu')) :?>
    <?php get_top_menu($nav);?>
</ul>
<ul id="secondary">
	<?php get_top_menu(Menu::get_menu_by_name('Secondary'));?>
<?php endif; // module::is_active ?>
</ul>


