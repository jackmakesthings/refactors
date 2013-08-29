<?php $pagetype = 'about'; include DIR_TMPL.'/header.php'; ?>


<header class="pageHeader">
	<h1>About Us</h1>


<ul class="subNav" id="shopSubNav">

 <?php
if(Module::is_active('Menu')){
    $subnav = Menu::get_menu_by_name('About');
    // $cat = URI_PART_0; if(defined('URI_PART_1')) : $subcat = URI_PART_1 ; else : $subcat = '' ; endif;
    $subcat = 'about';
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

	<?php if($page_image) : ?> <img class="fullWidth" src="<?php echo $page_image_src[0]; ?>" width="958" /> <?php endif; ?>
	<div class="col2">

		<div class="col lCol">
			<?php echo $pieces[0]; ?>
		</div>
		<div class="col rCol">
			<?php echo $pieces[1]; ?>
		</div>
	</div>


	<div class="col2" id="quoteCycle" style="position:relative;">
		<span class="prev prevQuote" data-icon="L" href="javascript:;"></span>
		<div class="clientQuotes">
			<h3>What Our Clients Say</h3>

			<?php foreach($quotes as $k => $quote) :
			if ($k==0) : $class='show'; else : $class='quoteBox'; endif; ?>
			<div class="<?php echo $class; ?>">
			<p class="quote"><?php
				$text = deka(array(), $quote, 'data', 'Quote', 'data', 0); echo $text; ?></p>
			<p class="source"><?php
				$sourcename = deka(array(), $quote, "data", "Source (name)", "data", 0); echo $sourcename; ?>
				<span><?php
				$sourcedetail = deka(array(), $quote, "data", "Source (detail)", "data", 0); echo $sourcedetail; ?></span>
			</p>
			</div>
		<?php endforeach; ?>
		</div>
        <span class='view-all-testimonials'>
            <a href='/testimonials/'>View All</a>
        </span>
		<span class="next nextQuote" data-icon="R" href="javascript:;"></span>
	</div>

</div>
<?php include DIR_TMPL.'/footer.php'; ?>
