<?php include DIR_TMPL.'/header.php'; ?>

<header class="pageHeader">
    <h1><a href="/<?php echo URI_PART_0; ?>/"><?php echo URI_PART_0; ?></a></h1>
    <?php include DIR_TMPL . '/menu-category.php'; ?>
</header>

<div class="singleProduct">
    <h1 class="productTitle">
        <?php echo $product['title'];?> <span class='byDesigner'><?php echo $product['by_designer'];?></span>
    </h1>
    <div class="productNav">
        <a href="<?php echo $prev_slug;?>" class="button paginationControl prev" title="Previous"><span data-icon="L" aria-hidden="true"></span> Prev</a>
        <a href="<?php echo $next_slug;?>" class="button paginationControl next" title="Next">Next <span data-icon="R" aria-hidden="true"></span></a>
    </div>

    <div class="productWrapper">
        <div class="productImages">
            <?php
            $single = count($product['images']) > 1 ? '' : 'single';
            // $single = ''; ?>
            <div id="controls"></div>
            <?php

            // $sizes = FileManager::get_image_sizes();
            // var_dump($sizes);

            $large = array();
            $small = array();

            $i = 1;
            foreach($product['images'] as &$path) :
                $src = $path;
                $srcthumb = FileManager::get_resized_image($path, 'thumb');
                $srcmed = FileManager::get_resized_image($path, 'medium');
                $srclg = FileManager::get_resized_image($path, 'large');

                list($width, $height) = getimagesize("http://".$_SERVER['HTTP_HOST'] . $srclg);
                

                // $large[] = '<a rel="showTitle: false, position: \'inside\', useZoom: \'pattern-image-zoom\', smallImage: \''.$srclg.'\'" class="cloud-zoom-gallery" href="'.$src.'"><img class="product_img" src="'.$srclg.'" alt=""></a>';
                // $small[] = '<img data-id="' . $i . '" class="" src="'.$srcthumb.'">';

                if( ($width < 595) && ($height < 595) ) { 
                    // if there is no need to zoom

                    $large[] = '<a rel="showTitle: false,  position: \'inside\', useZoom: \'zoom1\', smallImage: \''.$srclg.'\'" class="cloud-zoom-gallery no-zoom" href="'.$src.'"><img class="product_img no-zoom" src="'.$src.'" alt=""></a>';
                    $small[] = '<img data-id="' . $i . '" class="" src="'.$srcthumb.'">';

                }

                else {

                    $large[] = '<a rel="showTitle: false, position: \'inside\', useZoom: \'zoom1\', smallImage: \''.$srclg.'\'" class="cloud-zoom-gallery" href="'.$src.'"><img class="product_img " src="'.$srclg.'" alt=""></a>';
                    $small[] = '<img data-id="' . $i . '" class="" src="'.$srcthumb.'">';

                }

                // $large[] = '<a rel="showTitle: false, position: \'inside\', useZoom: \'pattern-image-zoom\', smallImage: \''.$path.'\'" class="cloud-zoom-gallery" href="'.$path.'"><img src="'.$path.'" alt=""></a>';
                // $small[] = '<img data-id="' . $i . '" class="" src="'.$path.'">';
            $i++; unset($width); unset($height);

            endforeach;
            ?>
            <div id="productImgs" class="<?php echo $single; ?>">
                 <!-- <div id="imgNav"> -->
                    <a class="nav prev" id="prev" title="Previous" href="javascript:;"><span>L</span></a>
                    <a class="nav next" id="next" title="Next" href="javascript:;"><span>R</span></a>
                <!-- </div> -->

                <div id="box"><div id="cover"></div></div>

                <div id="bigImg">
                    <?php echo implode('', $large); ?>
                </div>
                <div id="smallImgs">
                    <ul>
                        <li>
                        <?php echo implode('</li><li>', $small); ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="productInfo">
            <aside class="productDescription"><?php echo $product['desc']; ?></aside>
            <?php if (!is_null($product['designer'])): ?>
                <hr /><aside class="productDesigner"><span>Designer</span><br><?php echo $product['designer']; ?></aside>
            <?php endif; ?>
            <hr />
            <aside class="productDetails">
                <?php foreach($product['details'] as $key => &$detail): ?>
                    <?php if($key === 'moredims'):?>
                        <?php foreach($detail as &$dim):
                            if( ($key = deka('', $dim, 'key', 0))
                                && ($val = deka('', $dim, 'data', 0))): ?>
                                <div class="detailBlock">
                                <!-- <span><php echo ucfirst($key); ?>:</span> <php echo $val; ?> -->
                                <?php echo $val . '" ' . strtolower($key); ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                    <div><span><?php echo $key; ?>:</span> <?php echo $detail; ?></div>
                    <?php endif;?>
                <?php endforeach;?>
                <?php if (strlen($product['number'])): ?>
                    <hr /><div><span>Item Number: </span><?php echo $product['number']; ?></div>
                <?php endif; ?>
            </aside>
        </div>
        <div class="purchasingInfo">
            <div class="pinterestButton">
                <a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode("http://".$_SERVER['HTTP_HOST'].URI_PATH);?>&media=<?php echo urlencode("http://".$_SERVER['HTTP_HOST'].$path);?>"  count-layout="horizontal"
                    ><img src="/img/btn-pinterest-flat.png" title="Pin It" class="pinterestBtn" /
                ></a>
            </div>
           <p class="locInfo">
                <?php 
                if (strlen($product['location']['title'])):
                    if (strlen($product['location']['email'])) { echo '<span class="emailLocation">' . $product['location']['email'] . '</span>'; } ?>
                    <span class="locLabel">Location: </span><?php echo $product['location']['title']; ?><br /><?php 
                    if (strlen($product['location']['phone'])) { echo $product['location']['phone'] . '<br />'; } ?>
                    <hr /><?php 
                endif; ?>
            </p> 
            <a class="button purchaseButton printButton" href="javascript:window.print();">Print this Item <span data-icon="P" aria-hidden="true"></span></a><br>
            <?php if(in_array($product['id'], deka(array(), $_SESSION,'saved_list'))):?>
            <a class="saveItem purchaseButton button" data-id='<?php echo $product['id'];?>' data-added='true' href="javascript:;">
                Added to List <span data-icon='v'></span>
            <?php else:?>
            <a class="saveItem purchaseButton button" data-id='<?php echo $product['id'];?>' href="javascript:;">
                Save this Item <span data-icon="&amp;" aria-hidden="true"></span>
            <?php endif;?>
            </a><br />
            <div class="modal itemSaved">
                <p>We've added the item to your saved list.</p>
                <a class="button seeListButton" href="/my-saved-list/">See Saved List</a>
                <a class="button contButton" href="javascript:;">Continue Browsing</a>
            </div>
            <a class="contactItem purchaseButton button" href="mailto:<?php echo $product['location']['email'];?>?Subject=Re:%20Item%20number%20<?php echo $product['number']; ?>"
                >Contact us about this item <span data-icon="i" aria-hidden="true"></span
            ></a><br>
            <a class="emailItem purchaseButton button">
                Email this item <span data-icon="M" aria-hidden="true"></span>
            </a>
            <div class="modal sendItem">
                <form class="sendItemForm" id="sendItemForm" method="post" action="/rpc/email_product/" >
                    <span><input type="text" placeholder="Your name" name="sendFromName" id="sendFromName"></span>
                    <span><input type="text" placeholder="Your email address" name="sendFrom" id="sendFrom"></span>
                    <span><input type="text" placeholder="Your recipient's email" name="sendTo" id="sendTo"></span>
                    <span><textarea placeholder="Message" name="message" id="message"></textarea></span>
                    <span><input type="submit" value="Send" name="emailProduct" id="emailProduct" class="submit button emailProdButton"></span>
                    <input type="hidden" class="pid" name="pid" value="<?php echo $product['id']; ?>" />
                    <input type="hidden" class="ptitle" name="ptitle" value="<?php echo htmlspecialchars($product['title']);?>" />
                    <input type="hidden" class="ppath" name="ppath" value="<?php echo htmlspecialchars(URI_PATH); ?>" />
                    <div id="success" class="productSending">
                        <p><span data-icon="v" id="check"></span> Your item has been sent.</p>
                        <div>
                            <a class="button sendAgain" id="sendAgain">Send another</a>
                            <a class="button closeSent" id="closeSent">Done Sending</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div><?php
    // $related_products = array();
    if(count($related_products)) : ?>
        <div class="relatedProducts">
            <h3><span>Related Items</span></h3>
            <ul class="relatedThumbnails">
            <?php foreach ($related_products as $related_product) :
                $r_cat_id = $related_product['data']['Category']['data'][0];
                $r_slug ='/'.$hierarchy[$r_cat_id]['slug'].'/'.deka('', $related_product, 'slug').'/';
                $imgpathR = deka('', $related_product, 'data', 'Additional Images', 'data', 0);
                $imgpathsR = json_decode($imgpathR, true);
                $rimg = $imgpathsR[0];
                $thumbimg = FileManager::get_resized_image($rimg, 'medium');
                $rtitle = deka('', $related_product,'title');
                    if (strlen($rtitle) > 70 ):
                        $rtitle = substr($rtitle, 0, 70);
                        $break = strripos($rtitle, ' ');
                        $rtitle = substr($rtitle, 0, $break);
                        $rtitle .= " &hellip;";
                    endif;?>
                <a class="relatedThumb" href="<?php echo $r_slug; ?>">
                    <img src="<?php echo $thumbimg; ?>" alt="<?php echo $related_product['title']; ?>">
                    <div class="productOverlay">
                        <p><?php echo $rtitle;?></p>
                        <span data-icon="R" aria-hidden="true"></span>
                    </div>
                </a>
                <?php endforeach; ?>
            </ul>
        </div><?php
    else: ?>
        <div class="break"></div><?php
    endif; ?>
</div>
<div id="printMono"><img src="/img/footer-logo-1.jpg" alt=""></div>

<?php include DIR_TMPL.'/footer.php';
