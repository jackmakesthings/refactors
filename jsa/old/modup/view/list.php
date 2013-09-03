<?php
$pagetype = 'list';
include DIR_TMPL.'/header.php'; ?>
<header class="pageHeader">
    <h1><?php
        echo 'My Saved List'; ?>
    </h1>
</header>
<span class="itemsCount"><?php echo $total_prods; ?> items</span>
<?php if($total_prods > 0){

    $tm = new TaxonomyManager('Content');
    $tm->set_key(2);
    $term_slugs = $tm->arrange_terms($tm->get_terms('default'), Taxonomy::TYPE_TREE, '/', TRUE);
    foreach ($products['products'] as $the_product):
        $slug ='/'.$term_slugs[ $the_product['data']['Category']['data'][0] ]['slug'].'/'.$the_product['slug'].'/';
        $product_path = $slug;
        $product = Salibello::make_nice_product($the_product);
        if(deka(FALSE, $product, 'id') && deka(FALSE, $product, 'number')):
            ?>

            <div class="savedItemBox">
                <h2>
                    <a class="savedItemTitle" href="<?php echo $product_path; ?>" title="<?php echo $product['title']; ?>">
                        <?php echo $product['title'];?> <span><?php echo $product['by_designer'];?></span>
                    </a>
                </h2>
                <p class="productDetails itemNumber"><span>Item Number:</span> <?php echo $product['number'];?></p>

                <div class="infoColumn col1">  
                    <p class="imgBox">
                        <a href="<?php echo $product_path; ?>" title="<?php echo $product['title']; ?>">
                            <img class="productImage listImage" src="<?php echo deka('', $product,'images',0); ?>">
                        </a>
                    </p><?php
                    if(strlen($product['desc'])):?>
                        <span class="productDescription"><?php echo $product['desc']; ?></span><?php
                    endif;
                    if(strlen($product['designer'])):?>
                        <p class="productDesigner">
                            <span>Designer</span><br>
                            <?php echo $product['designer'];?>
                        </p><?php
                    endif;?>

                </div>

                <div class="infoColumn col2">
                    <div class="productDetails">
                    <div class="prodInfo">
                    <?php 
                    foreach($product['details'] as $key => &$detail):
                        if ($key === 'moredims'):
                        foreach($detail as &$dim):
                            if( ($key = deka('', $dim, 'key', 0))
                                && ($val = deka('', $dim, 'data', 0))): ?>
                                <div class="detailBlock">
                                <!-- <span><php echo ucfirst($key); ?>:</span> <php echo $val; ?> -->
                                <?php echo $val . '" ' . strtolower($key); ?>
                                </div>
                                <?php
                            endif;
                        endforeach;
                        else: ?>
                            <p><span><?php echo $key; ?>:</span> <?php echo $detail; ?></p><?php 
                        endif;
                    endforeach;?>
                    <?php 
                    // if (strlen($product['location']['email'])) {
                    //     echo '<span class="listEmail">' . $product['location']['email'] . '</span><br>';
                    // }
                    // if (strlen($product['location']['title'])) {
                    //     echo '<span class="locLabel">Location:</span>' . $product['location']['title'] . '<br>';
                    // }
                    // if (strlen($product['location']['phone'])) {
                    //     echo '<span class="listPhone">' . $product['location']['phone'] . '</span><br>';
                    // } ?>
                    </div>
                      <div class="locInfo">
                        <?php 
                        if (strlen($product['location']['title'])):
                            if (strlen($product['location']['email'])) { echo '<span class="emailLocation">' . $product['location']['email'] . '</span>'; } ?>
                            <p><span class="locLabel">Location: </span><?php echo $product['location']['title']; ?></p><?php 
                            if (strlen($product['location']['phone'])) { echo '<p class="locPhone">' . $product['location']['phone'] . '</p>'; } ?>
                            <?php 
                        endif; ?>
                    </div>
                    </div>
                </div>

                <div class="infoColumn col3">
                    <a class="button contactButton" href="mailto:info@johnsalibello.com?Subject=Re:%20Item%20number%20<?php echo $product['number']; ?>">
                    Contact us about this item<span data-icon="i" aria-hidden="true"></span></a><br>
                    <a class="button unlistButton" data-id='<?php echo $product['id'];?>' href="javascript:;">Remove this item from list <span data-icon="X" aria-hidden="true"></span></a>
                </div>
            </div>

        <?php
        endif;
    endforeach; ?>
    <div class="listActions">
        <a class="button emailButton" href="javascript:;">Email my list <span data-icon="M" aria-hidden="true"></span></a><br>
            <div class="modal sendItem" id="sendListModal">
                <form class="sendItemForm" id="sendListForm" method="post" action="/rpc/email_list.php">
                    <span><input type="text" placeholder="Your name" name="sendFromName" id="sendFromName"></span>
                   <span><input type="text" placeholder="Your email address" name="sendFrom" id="sendFrom"></span>
                    <span><input type="text" placeholder="Your recipient's email" name="sendTo" id="sendTo"></span>
                    <span><textarea placeholder="Message" name="message" id="message"></textarea></span>
                    <span><input type="submit" value="Send" name="emailProduct" id="emailProduct" class="submit button emailProdButton emailListButton"></span>
                        <!-- <input type="hidden" class="hidden not-required s_pids" name="s_pids" value="<?php // echo implode(',', $s_pids); ?>"> -->
                </form>
                <div id="listSuccess" class="listSending">
                    <p><span data-icon="v" id="check"> Your list has been sent.</p>
                    <div><a class="button sendAgain" id="sendAgain">Send another</a> <a class="button closeSent" id="closeSent">Done Sending</a></div>
                </div>
            </div>

        <a class="button printButton" href="javascript:window.print();">Print my list <span data-icon="P" aria-hidden="true"></span></a><br>
        <a class="button removeButton" href="javascript:;">Remove all items from list <span data-icon="X" aria-hidden="true"></span></a><br>
    </div>
<?php
unset($the_product);
}
else { ?>

<div class="savedItemBox" style="min-height:300px; border-bottom:none;">
<em style="font-style:italic;">You haven’t added anything to your Saved List yet.</em><br><br>
<p>The Saved List gives you a way to collect and send or print information about the items you are interested in.<br><br>
To add something, just click “Save This Item” on the product’s detail page.</p>
</div>

<?php }

?>
 <?php include DIR_TMPL.'/footer.php'; ?>
