<?php 
$pagetype = 'sitemap'; 
include DIR_TMPL.'/header.php'; 
?>

<header class="pageHeader">
	<h1>Sitemap</h1>
</header> 

<div class="sitemapWrapper sitemap">
<?php
if(Module::is_active('Menu')) :
echo '<ul class="menu">';

$homenav = isset($homenav) ? $homenav : Menu::get_menu_by_name('Sitemap Home');
echo '<li class="topLevel"><a href="/">Home</a>';
echo '<ul class="subMenu">';
foreach(deka(array(), $homenav, 'data') as $hmenu_item) :
	if (function_exists('get_menu_listing_adv')) :
		echo get_menu_listing_adv($hmenu_item);
	endif;
	if(deka(array(), $hmenu_item, 'children')) :
		echo '<ul class="subSubMenu">';
		foreach($hmenu_item['children'] as $tertiary_item) :
			echo '<li class="levelThree">';
			echo get_cat_link($tertiary_item);
			echo '</li>';
		endforeach;
		echo '</ul>';
	endif;	
endforeach;
echo '</ul></li>';

$nav = isset($nav) ? $nav : Menu::get_menu_by_name('Primary'); 
	foreach(deka(array(), $nav,'data') as $menu_item) :
		$linkclass = $menu_item['slug']; 
		echo '<li class="topLevel ' . $linkclass . '">';
		if(function_exists('get_cat_link')) echo get_cat_link($menu_item); 
		if(deka(array(), $menu_item, 'children')) :
			echo '<ul class="subMenu">';
			foreach($menu_item['children'] as $sub_menu_item) :
				echo '<li class="levelTwo">';
				if(function_exists('get_subcat_link')) echo get_subcat_link($menu_item, $sub_menu_item); 
				if(deka(array(), $sub_menu_item, 'children')) :
					echo '<ul class="subSubMenu">';
					foreach($sub_menu_item['children'] as $tertiary_item) :
						echo '<li class="levelThree">';
						echo get_tertiary_link($menu_item, $sub_menu_item, $tertiary_item);
						echo '</li>';
					endforeach;
					echo '</ul>';
				endif;
				echo '</li>'; 
			endforeach; // menu_item['children'] as sub_menu_item
			echo '</ul>'; 
		endif;  // deka(array(), menu_item, 'children'
		echo '</li>'; 
	endforeach; // deka(array(), nav, 'data') as menu_item 
echo '</ul>';
endif;?>

</div>
<?php
include DIR_TMPL.'/footer.php'; 

?>
