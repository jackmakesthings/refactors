<?php $pagetype = 'about'; include DIR_TMPL.'/header.php'; ?>
<header class="pageHeader">
	<h1><?php echo $page_header;?></h1>

<ul class="subNav" id="shopSubNav">

 <?php
if(Module::is_active('Menu')){
    $subnav = Menu::get_menu_by_name('About');
    // $cat = URI_PART_0; if(defined('URI_PART_1')) : $subcat = URI_PART_1 ; else : $subcat = '' ; endif;
    $subcat = 'press';
    echo '<ul class="subMenu">';
    foreach(deka(array(), $subnav,'data') as $menu_item) :
        $subcatclass = $menu_item['slug'];
        if ($subcatclass == $subcat) $subcatclass = $subcatclass . ' ' . 'current';
        echo '<li class="' . $subcatclass . '">';
            if(function_exists('get_cat_link')) echo get_cat_link($menu_item);
        echo '</li>';
    endforeach; // ($menu_item['children'] as $sub_menu_item)
    echo '</ul>';
}
?>

</ul>
</header>
<div class="gridWrapper aboutWrapper">
	<div class="col2">

		<!-- <div class="col lCol"> -->
		<?php
        $type_id = Content::get_entry_type_by_name('Press');
        $tm = new TaxonomyManager('Content');
        $tm->set_key($type_id['id']);
		foreach($clips as $clip) :
            $is_published = $tm->has_entry_terms($clip['entry']['id'], array('Publish'), 'status');
            if($is_published){
                $title = deka('', $clip, 'entry', 'title');
                $date = deka(array(), $clip, 'data', 'Publication Date', 'data', 0);
                $image = deka(array(), $clip, 'data', 'Image', 'data', 0);
                $image_src = array_pop(json_decode($image, true));
                $desc = deka('', $clip, 'data', 'Description', 'data', 0);
                $linktext = deka(array(), $clip, 'data', 'Link', 'data', 0);
                $link_uri = deka(array(), $clip, 'data', 'Link', 'uri', 0);
                $pdf = deka(array(), $clip, 'data', 'PDF File', 'data', 0);

                echo '<div class="col lCol pressCol"><li class="pressclip">';
                echo $pdf
                    ? '<a class="pdf getPdf" rel="external" target="_blank" href="/file/upload/' . $pdf . '"> <span data-icon="A" class="hasPdf"><br /> PDF</span><img src="'. $image_src . '"></a>'
                    : '<img src="'. $image_src . '">';
                echo '<h3 class="title">' . $title . '</h3>';
                echo ($date)
                    ? '<p class="pubDate">' . $date . '</p>' : '<p class="nopubDate"> </p>';
                echo $desc;
                echo (!empty($linktext))
                    ? '<a class="link" rel="external" href="' . $link_uri . '">' . $linktext . '</a>' : '';
                echo '</li></div>';
            }
		endforeach;
		?>
		<!-- </div> -->

<!-- 		<div class="col rCol">
		</div> -->
	</div>
</div>
<?php include DIR_TMPL.'/footer.php'; ?>
