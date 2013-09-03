<?php
/* category view sorting menu - a front-end module */
$d_lists = $s_cat = array();
if(isset($search_results)){
    $nav = isset($nav) ? $nav : Menu::get_menu_by_name('Primary');
    if(!isset($terms)){
        $tm = new TaxonomyManager('Content');
        $tm->set_key(2);
        $terms = $tm->get_terms('default');
    }
    $hierarchy = $tm->arrange_terms($terms, Taxonomy::TYPE_TREE, '/', TRUE);
    $d_prods = deka(array(), $search_results, 'products');
    foreach($d_prods as $d_prod){
        $d_filters['ids'][] = $d_prod['id'];
        $el_s_cat = deka('', $d_prod, 'data', 'Category', 'data', 0);
        $el_s_terms = explode('/', $hierarchy[$el_s_cat]['slug']);
        foreach($el_s_terms as $el_s_term){
            $count = deka(0, $s_cat, $el_s_term, 'count');
            $s_cat[$el_s_term]['count'] = $count+1;
        }
    }
}
$d_filters = isset($d_filters) ? deka(array(), $d_filters, 'ids') : deka(array(), $filters, 'ids');
if($d_filters){
    $designers = Salibello::get_product_designers($d_filters);
    /*
    $designers_chunk = sizeof($designers)/4;
    $d_lists[] = array_slice($designers, 0, ceil(sizeof($designers)/4), TRUE);
    if($designers_chunk < 1){
        $d_lists[] = array_slice($designers, ceil(sizeof($designers)/4), ceil($designers_chunk), TRUE);
        $d_lists[] = array_slice($designers, 2*ceil(sizeof($designers)/4), ceil($designers_chunk), TRUE);
    }
    else{
        $d_lists[] = array_slice($designers, ceil(sizeof($designers)/4), $designers_chunk, TRUE);
        $d_lists[] = array_slice($designers, 2*ceil(sizeof($designers)/4), $designers_chunk, TRUE);
        $d_lists[] = array_slice($designers, -$designers_chunk, NULL, TRUE);
    }
    */
    $designers_chunk = sizeof($designers)/3;
    $d_lists[] = array_slice($designers, 0, ceil(sizeof($designers)/3), TRUE);
    if($designers_chunk < 1){
        $d_lists[] = array_slice($designers, ceil(sizeof($designers)/3), ceil($designers_chunk), TRUE);
    }
    else{
        $d_lists[] = array_slice($designers, ceil(sizeof($designers)/3), $designers_chunk, TRUE);
        $d_lists[] = array_slice($designers, -$designers_chunk, NULL, TRUE);
    }
}
?>
<ul class="subNav group" id="productSorting">
    <li class="quarterCol group" id="sortOne">
        <span class="productsShown">
            <!-- Done via script.js-->
        </span>
        <span class="showAll">
            <a href="javascript:;" class="showAllButton button">Show All</a>
        </span>
    </li>
    <?php
    $liclass = 'quarterCol'; $cols = 4;
    if( isset($tertiary) || ($pagetype == 'search-results') ) : $liclass = 'midCol'; $cols = 3; endif; ?>

    <li class="group <?php echo $liclass; ?>" id="sortTwo">
        <?php if(isset($tertiary) && count($tertiary)):?>
        <span class="filterBy">
            <a href="javascript:;" class="filterByType modalOpener" >
                <label>Type&nbsp;&nbsp;&nbsp;&nbsp;</label> <span data-icon="D"></span>
            </a>
            <div class="filterModal modal" id="typeModal">
             <a class="close" href="javascript:;" name="close">Close <span>X</span></a>
            <?php foreach($tertiary_filters as $t_slug => $t_name):?>
                <span><input type="checkbox" id="<?php echo $t_slug;?>" value="<?php echo $t_slug;?>" name="filter[tertiary][]">
                    <label for="<?php echo $t_slug;?>" onclick=""><?php echo $t_name;?></label></span>
            <?php endforeach; ?>
            </div>
        </span>
        <?php endif;?>

        <?php if($d_lists):?>
        <span class="filterBy">
            <a href="javascript:;" class="filterByDesigner modalOpener" >
                <label>Designer&nbsp;&nbsp;&nbsp;&nbsp;</label> <span data-icon="D"></span>
            </a>
            <div class="filterModal modal" id="designerModal">
                 <a class="close" href="javascript:;" name="close">Close <span>X</span></a>
                <div class="cols">
                <?php
                // foreach($d_lists as $d_list):
                //     <div class="col">
                //         <?php foreach($d_list as $d_id => $d_name):
                            foreach($designers as $d_id => $d_name):?>
                            <p class="modalOption designerOption">
                                <input type="checkbox" id="<?php echo $d_id;?>" value="<?php echo $d_id;?>" name="filter[designers][]">
                                <label for="<?php echo $d_id;?>" onclick=""><?php echo $d_name;?></label>
                            </p>
                        <?php endforeach; ?>
                    </div>
                <?php
                // endforeach; ?>
                <!-- </div> -->
            </div>
        </span>
        <?php endif;?>

        <span class="filterBy">
            <a href="javascript:;" class="filterBySize modalOpener">
                <label>Size&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> <span data-icon="D"></span>
            </a>
            <div id="sizeModal" class="modal">
                <a class="close" href="javascript:;" name="close">Close <span>X</span></a>
                <header>
                    <div class="sizeOptions">
                        <div class="sizeOption sizeBox" name="lwh">
                            <span class="sizeIcon lwhIcon"></span>by W x D x H
                        </div>
                        <div class="sizeOption sizeRound" name="diameter">
                            <span class="sizeIcon diameterIcon"></span>by DIA x H
                        </div>
                    </div>
                </header>
                <div class="sizeTabs">
                    <form id="lwh" name="lwh">
                        <span class="_widthSlider">
                            <h4>WIDTH</h4>
                            <div id="widthSlider" class="slider"></div>
                        </span>
                        <span class="_lengthSlider">
                            <h4>DEPTH</h4>
                            <div id="lengthSlider" class="slider"></div>
                        </span>
                        <span class="_heightSlider">
                            <h4>HEIGHT</h4>
                            <div id="heightSlider" class="slider"></div>
                        </span>
                        <span class="_overallHeightSlider">
                            <h4>OVERALL HEIGHT</h4>
                            <div id="overallHeightSlider" class="slider"></div>
                        </span>

                        <a href='javascript:;' class="reset" name="reset">Reset</a>
                    </form>

                    <form id="diameter" name="diameter">
                        <span class="_diameterSlider">
                            <h4>DIAMETER</h4>
                            <div id="diameterSlider" class="slider"></div>
                        </span>
                        <span class="_diameterHeightSlider">
                            <h4>HEIGHT</h4>
                            <div id="diameterHeightSlider" class="slider"></div>
                        </span>
                        <span class="_overallDiameterHeightSlider">
                            <h4>OVERALL HEIGHT</h4>
                            <div id="overallDiameterHeightSlider" class="slider"></div>
                        </span>

                        <a href='javascript:;' class="reset" name="reset">Reset</a>
                    </form>
                </div>
            </div>
        </span>

        <?php if(isset($search_results)):?>
        <span class="filterBy">
            <a href="javascript:;" class="filterByCategory modalOpener">
                <label>Category&nbsp;&nbsp;&nbsp;&nbsp;</label> <span data-icon="D"></span>
            </a>
            <div class="filterModal modal catModal " style="height:auto;" id="catModal">
                 <a class="close" href="javascript:;" name="close">Close <span>X</span></a>
                <div class="cols" style="width:110%;">
                <?php foreach($nav['data'] as $k => $primary): $has_secondary = FALSE;?>
                    <?php if (deka(FALSE, $s_cat, $primary['slug'], 'count')):
                            if(($k == 3) || ($k == 6) || ($k == 9)) { echo '<hr class="row" />'; } ?>
                    <div class="col col<?php echo $k+1; ?>" style="display:block; float:left; width:33%;">
                        <span><?php echo $primary['name'];?></span>
                        <?php foreach(deka(array(), $primary,'children') as $secondary):
                            $has_tertiary = FALSE;
                            if ($count = deka(FALSE, $s_cat, $secondary['slug'], 'count')):
                            $has_secondary = TRUE;
                            $tertiaries = deka(array(), $secondary, 'children');
                            $subcat_class = '';
                            if (count($tertiaries) > 0) $subcat_class = 'hasTertiary'; ?>
                            <div class="selectFilter <?php echo $subcat_class; ?>" data-state="closed">
                                <input type="checkbox" id="<?php echo $secondary['slug'];?>" value="<?php echo $secondary['slug'];?>" name="filter[categories][]">
                                <label for="<?php echo $secondary['slug'];?>" onclick="">
                                    <?php echo $secondary['name'];?>
                                </label>
                                <span class="count">
                                    <?php echo $count;?>
                                </span>
                            <?php foreach($tertiaries as $tertiary):?>
                            <?php if($count = deka(FALSE, $s_cat, $tertiary['slug'], 'count')): ?>
                                <?php if($has_tertiary === FALSE): $has_tertiary = TRUE;?>
                                <a href='javascript:;' class='submodalOpener'><span data-icon='D'></span></a>
                                <div class='tertiaries submodal'>
                                <?php endif;?>
                                    <span class="selectFilter tertiaryFilter">
                                        <input type="checkbox" id="<?php echo $tertiary['slug'];?>" value="<?php echo $tertiary['slug'];?>" name="filter[tertiary][]">
                                        <label for="<?php echo $tertiary['slug'];?>" onclick="">
                                            <?php echo $tertiary['name'];?>
                                        </label>
                                        <span class="count">
                                            <?php echo $count;?>
                                        </span>
                                    </span>
                                    <?php endif;?>
                                <?php endforeach; ?>
                                <?php if($has_tertiary):?>
                                </div>
                                <?php endif;?>
                        </div>
                        <?php endif;?>
                        <?php endforeach; ?>
                        <a class='select-all'
                        <?php if(!$has_secondary):?> style="visibility:hidden"<?php endif;?>
                          href='javascript:;'>select all</a>
                    </div>
                    <?php else:?>
                    <div class="col colEmpty col<?php echo $k+1; ?>" style="display:block; float:left; width:33%;">
                        <span style="color:#aaa; font-weight:400;"><?php echo $primary['name'];?></span>
                        <a class='select-all' style="visibility:hidden" href='javascript:;'>select all</a>
                    </div>
                    <?php endif;?>
                <?php endforeach; ?>
                </div>
            </div>
        </span>
        <?php endif;?>
   <?php if($cols === 4) { ?>
    </li>
    <li class='group quarterCol' id="sortThree">
   <?php
    } ?>
     <span class='clear-all-filters'><a href='javascript:;'><i>Clear Filters</i></a></span>
      </li>
        <li class='group quarterCol'  id="sortFour">
            <span class="listOrder">order: <a class='ordering' href='javascript:;'>NEWEST</a></span>
        </li>

</ul>
<ul class="subNav" id="productFilters">
</ul>
