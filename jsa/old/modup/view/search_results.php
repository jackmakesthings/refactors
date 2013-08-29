<?php include DIR_TMPL.'/header.php';?>

<header class="pageHeader" id="searchHeader">
    <h1>
        Search Results
    </h1>

    <?php if($total_products > 0):?>
    <ul class="subNav" id="searchResult">
        <?php echo $total_products;?> results found for <?php echo $query;?>
    </ul>
    <?php include DIR_TMPL.'/menu-cat-sorting.php'; ?>
    <?php endif;?>
</header>
    <?php if($total_products > 0):?>
    <div class="prodWrapper gridWrapper" data-category='<?php echo $cat_name;?>' data-total="<?php echo $total_products;?>" data-filters='<?php echo json_encode($filters);?>'>
        <div class='loading'></div>
        <!-- Products loaded in via Javascript -->
    </div>

    <footer class="gridFooter">
        <ul class="subNav" id="shopFooterNav">
            <li class="showAll">
                <!-- Done via Javascript -->
            </li>
            <ul class="pagination bottomPagination"  data-limit='<?php echo $per_page;?>' data-spread='<?php echo $spread;?>' data-cur_page='<?php echo $page_num;?>'>
                <li class="paginationControl prev" data-page='prev'>
                    <a href="javascript:;" class="button"><span data-icon="L" aria-hidden="true"></span> Prev</a>
                </li>
                <?php for($j=1; $j<=$max_page; $j++):?>
                    <?php if($j == $max_page):?>
                        <li class='paging b_ellipsis'>
                            <span>&hellip;</span>
                        </li>
                    <?php endif;?>
                    <li class="paginationControl paging pageCounter" data-page='<?php echo $j;?>'>
                        <a href="javascript:;"><?php echo $j; ?></a>
                    </li>
                    <?php if($j === 1):?>
                        <li class='paging f_ellipsis'>
                            <span>&hellip;</span>
                        </li>
                    <?php endif;?>
                <?php endfor;?>
                <li class="paginationControl next" data-page='next'>
                    <a href='javascript:;' class="button">Next <span data-icon="R" aria-hidden="true"></span></a>
                </li>
            </ul> <!-- .pagination -->
        </ul> <!-- #shopFooterNav -->
    </footer> <!-- .gridFooter -->

<?php else: ?>
    <div class="savedItemBox" style="min-height:300px; border-top:1px solid #ccc; padding-top:1em;margin-left:0;">
   <p>Sorry, we didn't find anything for "<?php echo $query; ?>."</p><br><br>
   <!--  <p style="font-size: 12px;display: inline-block;vertical-align: text-bottom;padding-right: 1em;line-height: 10px;">Try another search?
                        <div class="searchBar" id="searchRedo" style="display:inline-block;width:auto;">
                            <div class="searchBox ui-widget" id="searchBoxRedo">
                                <form action='/search_results/' id='search-form' method='post'>
                                    <input id="text404" type="text" name='search_query' class="search_input text" placeholder="">
                                    <input type="submit" name='search_submit' class="submit button" id="search_submit" value="R">
                                </form>
                            </div>
                        </div>
    </p> -->
    </div>
<?php endif;?>

<?php include DIR_TMPL.'/footer.php';?>
