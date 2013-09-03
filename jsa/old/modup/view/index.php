<?php include DIR_TMPL.'/header.php'; ?>



<div id="veil" style="position:absolute; width:100%; height:100%;"></div>
<div id="slideshow" style="position:absolute; width:100%; height:100%;"></div>

<ul class="slideImages">

<?php
$name = 'Home Page Slide';
$slideData = Content::get_entries_details_by_type_name($name);
$slice_index = rand(0, count($slideData));
$part1 = array_slice($slideData, $slice_index);
$slideData = array_merge($part1, array_slice($slideData, 0, $slice_index));
$type_id = Content::get_entry_type_by_name($name);
$tm = new TaxonomyManager('Content');
$tm->set_key($type_id['id']);
foreach ($slideData as $k => &$slide)
{
    $is_published = $tm->has_entry_terms($slide['entry']['id'], array('Publish'), 'status');
    if($is_published){
        $slide_title = $slide['entry']['title'];
        $slide_srcs = json_decode($slide['data']['Image']['data'][0]);
        $slide_src = $slide_srcs[0];
        $slide_text = $slide['data']['Description']['data'][0];
        $slide_uri = $slide_linktext = deka('', $slide,'data','Link','data',0);
        $slide_uri = $slide_uri ? $slide_uri : 'javascript:;';

        echo '<li data-title="' . $slide_title . '" data-linktext="' . $slide_linktext . '" data-uri="' . $slide_uri . '" data-src="' . $slide_src . '" data-id="'. $k . '" data-desc="' . $slide_text . '"></li>';
    }
    else{
        unset($slideData[$k]);
    }
}
unset($tm);
unset($type_id);
$first_slide = reset($slideData);
?>

</ul>

<div id="enter"> <!-- needs to only appear on home page -->
    <div id="enterControl">
        <span data-icon="U" href="#" title="Details"></span>
    </div>
    <div id="enterContents">
        <div id="enterNav">
            <a id="prev" title="Previous"><span data-icon="L"></span></a>
            <a id="next" title="Next"><span data-icon="R"></span></a>
        </div>
            <div id="slideMeta">
                <?php
                echo '<a href="' . deka('javascript:;', $first_slide,'data','Link','data',0) . '">';
                echo '<h1>' . $first_slide['entry']['title'] . '</h1>';
                echo '<span>' . $first_slide['data']['Description']['data'][0] . '</span>';
                echo '</a>';
                ?>
            </div>
        </div>
    </div>

</div>
    <div id="cover-wrap">
        <div id="top" class="cover"><img src="/img/top.png"></div>
        <div id="bottom" class="cover"><img src="/img/bottom.png"></div>
    </div>
<?php include DIR_TMPL.'/footer.php'; ?>
