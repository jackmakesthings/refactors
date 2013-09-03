<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
  <title>My Saved List at John Salibello</title>
</head>
<body marginheight="0" topmargin="0" marginwidth="0" leftmargin="0" style="margin: 0px;">
  <!--100% body table-->
  <table cellspacing="0" border="0" cellpadding="0" width="100%">
    <tr valign="top">
      <td>
        <table cellspacing="0" border="0" id="leaf" align="center" style="background:#ffffff" cellpadding="0">
          <tr>
            <td>
              <!--container-->
              <table cellspacing="0" border="0" align="center" cellpadding="0" width="680">
                <tr>
                  <td>
                    <!--header-->
                    <table cellspacing="0" border="0" id="header" cellpadding="0" width="680" style="position: relative; height: 80px;">
                      <tr>
                        <td height="80">
                          <table cellspacing="0" border="0" cellpadding="0" width="680">
                            <tr>
                              <td height="" width="">
                              </td>

                            </tr>
                          </table>
                          <!--/title and date wrapper-->
                        </td>
                      </tr>
                    </table>
                    <!--/header-->

                    <table cellspacing="0" border="0" cellpadding="0" width="680" bgcolor="">
                      <tr>
                        <td id="brown-intro" valign="top" style="">
                          <!--table to pad content for x browser-->
                          <table width="680" border="0" cellspacing="0" cellpadding="20">
                            <tr>
                              <td>
                                <p style="color: #222222; margin-top: 0px; margin-bottom: 0px; font-size: 18px; font-style:italic; font-family: 'Verdana', sans-serif; font-weight:normal;">
                                  <?php echo $from['name']; ?> thought you might be interested in these items at John Salibello.
                                </p>
                              </td>
                            </tr>
                            <tr>
                              <td cellpadding="10">
                                <p style="color: #222222; margin-top: 0px; margin-bottom: 0px; font-size: 14px; font-style:normal; font-family: 'Verdana', sans-serif; font-weight:normal;">
                                  <?php echo $message; ?>
                                </p>
                              </td>
                            </tr>
                            <tr>
                              <td cellpadding="0" style="padding-bottom:0; padding-top:0;" >
                                <p style="border-bottom:1px solid #dddddd; width:100%;font-family:'Verdana', sans-serif; font-weight:normal; font-size:12px; color: #222222; margin-top:0; margin-bottom:3px; padding-bottom:8px;">
                                  <?php echo count($list_products['products']); ?> ITEMS</p>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>

                      <!--/brown intro-->
                      <!--main content-->
                      <table cellspacing="0" border="0" id="content-wrapper"  cellpadding="20" bgcolor="" width="680" style="margin-bottom:10px;">
                       <?php
                       if($list_products) :
                        $tm = new TaxonomyManager('Content');
                      $tm->set_key(2);
                      $term_slugs = $tm->arrange_terms($tm->get_terms('default'), Taxonomy::TYPE_TREE, '/', TRUE);
                      foreach($list_products['products'] as $list_product) :
                        $list_product['path'] = $term_slugs[$list_product['data']['Category']['data'][0] ]['slug'].'/'.$list_product['slug'].'/';
                      $product = Salibello::make_nice_product($list_product);
                      ?>
                      <tr>
                        <td class="content">
                          <!--content area 1-->

                          <table cellspacing="0" border="0" cellpadding="0" width="100%" style="border-bottom: solid 1px #dddddd;">
                            <tr>
                              <td colspan="2" height="20">
                                <h1 style="font-family:'Verdana', sans-serif; font-weight:normal; font-size:15px; color: #222222; letter-spacing:1px; margin:0;">
                                  <a style="border:none;text-decoration:none;" href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/' . deka('', $list_product, 'path'); ?>" title="<?php echo $product['title']; ?>">
                                    <span style="color:#222222; text-decoration:none;">
                                      <?php echo $product['title'];
                                      echo ($product['designer']) ? ' by ' . $product['designer'] : ''; ?>
                                    </span>
                                  </a>
                                </h1>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <p style="color: #222222; margin: 0px 0px 12px; font-size: 11px; font-weight:bold; text-transform:none; font-family:'Verdana', sans-serif;">
                                  <?php if( $product['number']):?>
                                   <span style="font-style: italic; font-weight:normal;">Item Number:</span> <?php echo $product['number'];?>
                                 <?php endif;?>
                               </p>
                             </td>
                           </tr>
                           <tr>
                            <td width="249">
                              <a style="text-decoration:none; border:none;" href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/' . deka('', $list_product, 'path'); ?>" title="<?php echo $product['title']; ?>">
                                <img class="content-img1" src="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/' . deka('', $product, 'images', 0); ?>" align="left" alt="image one" style="margin-bottom: 10px; border:none;" width="232" />
                              </a>
                            </td>

                            <td valign="top">
                              <p style="font-family:'Verdana', sans-serif; font-weight:normal; font-size:13px; color: #222222; margin-top:5px; margin-bottom:15px;">
                                <?php echo $product['desc']; ?>
                              </p>
                              <table cellspacing="5" border="0" cellpadding="5">
                                <?php foreach($product['details'] as $key => &$detail): ?>
                                  <tr>
                                    <?php if ($key === 'moredims'):?>
                                        <?php foreach($detail as &$dim):
                                        $key = deka('', $dim, 'key', 0);
                                        $val = deka('', $dim, 'data', 0);
                                        if (strlen($key) && strlen($val)): ?>
                                          <td valign="top">
                                            <span style="color: #222222; margin: 0px 0px 12px; font-size: 12px; font-family:'Verdana', sans-serif; font-style:italic;"><?php echo $key; ?></span>
                                          </td>
                                          <td valign="top">
                                            <span style="color: #222222; margin: 0px 0px 12px; font-size: 12px; font-family:'Verdana', sans-serif; font-weight:bold;"><?php echo $val; ?>"</span>
                                          </td>
                                        <?php endif; ?>
                                      <?php endforeach; ?>
                                    <?php else:?>
                                      <td valign="top">
                                        <span style="color: #222222; margin: 0px 0px 12px; font-size: 12px; font-family:'Verdana', sans-serif;font-style:italic;"><?php echo $key; ?>:</span>
                                      </td>
                                      <td valign="top">
                                        <span style="color: #222222; margin: 0px 0px 12px; font-size: 12px; font-family:'Verdana', sans-serif; font-weight:bold;"><?php echo $detail; ?></span>
                                      </td>
                                    <?php endif;?>
                                </tr>
                            <?php endforeach; ?>
                          </table>
                        </td>
                      </tr>
                      <tr height="10"></tr>
                    </table>
                  </td>
                </tr>
                <?php unset($list_product); unset($product); endforeach; endif; ?>
              </table>
              <!--/main content-->
              <!--footer-->
              <table cellspacing="0" border="0" id="footer" cellpadding="20" width="680">
                <tr>
                  <td>
                    <p style="color: #222222; margin: 0px 0px 12px; font-size: 16px; font-family:'Verdana', sans-serif; font-weight:normal; font-style:italic;">
                      See the entire John Salibello collection or contact us at <a href="http://johnsalibello.com" style="color:#e21005 !important; text-decoration:none;">johnsalibello.com</a>
                    </p>
                  </td>
                </tr>
              </table>
              <!--/footer-->
            </td>
          </tr>
        </table>
        <!--container-->
      </td>
    </tr>
  </table>
  <!--/leaf background-->
</td>
</tr>
</table>
<!--/100% body table-->
</body>
</html>
