<?php $pagetype = 'category'; ?>
<?php include DIR_TMPL.'/header.php'; ?>
<header class="pageHeader">
    <h1>
        <a href="/<?php echo URI_PART_0; ?>/"><?php if (defined('URI_PART_0')) { echo str_replace('-', ' ', URI_PART_0); } ?></a>
    </h1>
    <?php include DIR_TMPL.'/menu-category.php';?> 
    <?php include DIR_TMPL.'/menu-cat-sorting.php'; ?>
</header>    

<div class="prodWrapper gridWrapper" data-category="<?php echo $cat_name;?>" data-total="<?php echo $total_products;?>" data-filters='<?php echo json_encode($filters);?>'>
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

<?php include DIR_TMPL.'/footer.php';?>
