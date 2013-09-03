<?php 
$subcat = $pagetype = $pageclass = URI_PART_0;
include DIR_TMPL.'/header.php';
?>

<header class="pageHeader">
	<h1><?php echo $page_header;?></h1>
    <ul class="subNav" id="shopSubNav">
     <?php
    if(Module::is_active('Menu')){
        $subnav = Menu::get_menu_by_name('About');
        // $cat = URI_PART_0; if(defined('URI_PART_1')) : $subcat = URI_PART_1 ; else : $subcat = '' ; endif;
        $subcat = 'testimonials';
        echo '<ul class="subMenu">';
        foreach(deka(array(), $subnav,'data') as $menu_item) {
            $subcatclass = $menu_item['slug'];
            if ($subcatclass == $subcat) $subcatclass = $subcatclass . ' ' . 'current';
            echo '<li class="' . $subcatclass . '">';
                echo get_cat_link($menu_item);
            echo '</li>';
        }
    }
    ?>
    </ul>
</header>

<div class="gridWrapper aboutWrapper">
	<div class="policies col3">
        <p><?php echo $content; ?></p>
		<div class="col col2-3 col1">
            <?php foreach(deka(array(), $testimonials,0) as $testimonial):?>
            <div class='clientQuotes'>
                <p class='quote'>
                    <?php echo $testimonial['data']['Quote']['data'][0];?>
                </p>
                <p class='source'>
                    <?php echo $testimonial['data']['Source (name)']['data'][0];?>
                    <span><?php echo $testimonial['data']['Source (detail)']['data'][0];?></span>
                </p>
            </div>
            </br>
            <?php endforeach;?>
		</div>
		<div class="col col2-3 col2">
            <?php foreach(deka(array(), $testimonials,1) as $testimonial):?>
            <div class='clientQuotes'>
                <p class='quote'>
                    <?php echo $testimonial['data']['Quote']['data'][0];?>
                </p>
                <p class='source'>
                    <?php echo $testimonial['data']['Source (name)']['data'][0];?>
                    <span><?php echo $testimonial['data']['Source (detail)']['data'][0];?></span>
                </p>
            </div>
            </br>
            <?php endforeach;?>
		</div>
	</div>
</div>
<?php include DIR_TMPL.'/footer.php'; ?>
