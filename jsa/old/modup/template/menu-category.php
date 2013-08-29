<?php /* category nav menu templating - a front-end module */ ?>
<ul class="subNav" id="shopSubNav">
 <?php 
if(Module::is_active('Menu')){
    $nav = isset($nav) ? $nav : Menu::get_menu_by_name('Primary');
    foreach(deka(array(), $nav,'data') as $menu_item) :
        if (strtolower($menu_item['slug']) === URI_PART_0) : 
            if(deka(array(), $menu_item, 'children')) :
                echo '<ul class="subMenu">';
                foreach($menu_item['children'] as $sub_menu_item) :
                    $subcatclass = $sub_menu_item['slug'];
                    if (defined('URI_PART_1') && $subcatclass === URI_PART_1) $subcatclass .= ' current';	
                    echo '<li class="' . $subcatclass . '">';
                        echo get_subcat_link($menu_item, $sub_menu_item);
                    echo '</li>';
                endforeach; // ($menu_item['children'] as $sub_menu_item)
                echo '</ul>';
            endif; // deka(array(), $menu_item, 'children'))
        endif; // (strtolower($menu_item['slug']) == $cat) 
    endforeach; // deka(array(), $subnav,'data') as $menu_item)
}
?>
</ul>   
