<?php $head = !isset($head) ? array() : $head;

if(isset($meta_title) && $meta_title){
    $head['meta'][] = array(
       'name' => 'title',
       'content' => $meta_title
    );
}
if(isset($meta_description) && $meta_description){
    $head['meta'][] = array(
       'name' => 'description',
       'content' => $meta_description
    );
}
if(isset($meta_keywords) && $meta_keywords){
    $head['meta'][] = array(
        'name' => 'keywords',
        'content' => $meta_keywords
    );
}

if(defined('URI_PART_0')) $pageclass = URI_PART_0;
/*
elseif(defined('URI_PART_1')) $pageclass = URI_PART_1;
elseif(defined('URI_PART_2')) $pageclass = URI_PART_2;
*/
else $pageclass = 'home';

$logourl = $pageclass === 'home' ? '/img/jsb-logo-front-retina.png' : '/img/jsb-logo-retina.png' ;
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <link rel="dns-prefetch" href="//ajax.googleapis.com">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <?php if ($pageclass==='home'):?>
    <title><?php echo ake('title', $head) ? $head['title'] : ''; ?></title>
    <?php else:?>
    <title><?php echo ake('title', $head) ? $head['title'] . ' | ' : ''; ?>John Salibello</title>
    <?php endif;?>

    <?php
    if (ake('meta', $head)) :
        foreach ($head['meta'] as &$_meta) :
            $_m = '<meta ';
            foreach ($_meta as $attr => &$_val) :
                $_m .= $attr . '="' . $_val . '" ';
            endforeach;         // ($_meta)
            echo $_m . '>';
        endforeach;         // ($head['meta'])
    endif; //       ake('meta, $head')
    ?>

    <?php if($pageclass==='press' || $pageclass==='testimonials'): ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php endif; ?>

    <meta name="Author" content="Site design and development by Krate, www.kratedesign.com" />
    <meta http-equiv="imagetoolbar" content="false" />
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="canonical" href="<?php echo ake('HTTPS', $_SERVER) ? 'https://' : 'http://'; ?><?php echo  $_SERVER['HTTP_HOST'] . URI_PATH; ?>" />
    <?php
    $head['req_css']['all'][] = "css/screen.css";
    $head['req_css']['all'][] = "css/jquery-ui-1.10.0.custom.min.css";
    foreach($head['req_css'] as $_media => $_css){
        $head['req_css'][$_media] = array_merge($head['req_css'][$_media], deka(array(), $head, 'css', $_media));
    }
    //$head['css'] = array_merge($head['req_css'], deka(array(), $head, 'css'));
    $head['css'] = $head['req_css'] + deka(array(), $head, 'css');
    ?>

    <?php
        if (ake('rss', $head)):
            foreach ($head['rss'] as &$_rss): ?>
                <link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo $_rss; ?>" /><?php
            endforeach;     // $head['rss']
        endif;      // ake('rss', $head')


        if (ake('atom', $head)):
            foreach ($head['atom'] as &$_atom): ?>
                <link rel="alternate" type="application/atom+xml" title="Atom" href="<?php echo $_atom; ?>" /><?php
            endforeach;     // $head['atom']
        endif;      // ake('atom', $head)


        if (ake('css', $head)):
            foreach ($head['css'] as $_media => $_css):
                array_walk($_css, 'walk_ltrim', '/');?>
                <link rel="stylesheet" media="<?php echo $_media;?>" href="/min/?f=<?php echo implode(',',$_css);?>">
            <?php endforeach;  // $head['css']
        endif;      // ake('css', $head)
        ?>

<!--
Krate typekit:
<script type="text/javascript" src="//use.typekit.net/zsw1mmp.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
Salibello typekit:
-->

<script type="text/javascript" src="//use.typekit.net/ebd3npr.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

    <?php
    $head['req_js'][] = "/js/libs/modernizr-2.5.3.min.js";
    $head['js'] = array_merge($head['req_js'], deka(array(), $head,'js'));
    array_walk($head['js'], 'walk_ltrim', '/');
    /*
    if (ake('js', $head)):
        foreach ($head['js'] as &$_js): ?>
            <script src="<?php echo $_js; ?>"></script><?php
        endforeach;         // $head['js']
    endif;      // ake('js', $head)
    */
    ?>
    <script src="/min/?f=<?php echo implode(',', $head['js']); ?>"></script>

<!-- <script type="text/javascript" src="/js/orientationfix.js"></script> -->
<?php if(!isset($pagetype)) : $pagetype='product'; endif; ?>
<?php if(isset($tplclass)) $pageclass .= ' ' . $tplclass; ?>

<!--[if lt IE 9]>
    <link rel="stylesheet" media="screen" href="/css/ie.css">
<![endif]-->

</head>

<body class="<?php echo $pageclass; ?>">
    <?php if($pageclass === 'home') : ?>
        <a id="topLogo" href="<?php echo ake('HTTPS', $_SERVER) ? 'https://' : 'http://'; ?><?php echo  $_SERVER['HTTP_HOST']; ?>">
            <img src="<?php echo $logourl; ?>" />
        </a>
    <?php endif; ?>
    <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
    <div id="container">
        <header id="header">
            <?php if($pageclass !== 'home') : ?>
            <a id="topLogo" href="<?php echo ake('HTTPS', $_SERVER) ? 'https://' : 'http://'; ?><?php echo  $_SERVER['HTTP_HOST']; ?>">
                <img src="<?php echo $logourl; ?>" />
            </a>
            <?php endif; ?>
            <nav id="topNav">
                <?php include DIR_TMPL.'/menu-top.php'; ?>
            </nav>
        </header>
        <div id="main" role="main">

            <div class="searchBar" id="searchTop">
                <div class="searchBox ui-widget">
                    <form action='/search_results/' id='search-form' method='get'>
                        <input type="text" name='q' class="search_input text" placeholder="Search">
                        <input type="submit" class="submit button" id="search_submit" value="R">
                    </form>
                </div>
            </div>    <!-- / #searchTop.searchBar -->
            <div class="savedListBar" id ="savedListTop">
                <div class="savedListBox">
                <?php if($pageclass != 'my-saved-list'): ?>
                    <a href="/my-saved-list/" class="button">My Saved List <span data-icon="=" aria-hidden="true"></span></a>
                <?php else:  $goback = ake('HTTP_REFERER', $_SERVER) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : 'http://'.$_SERVER['HTTP_HOST']; ?>
                    <a href="<?php echo $goback; ?>" class="button">Return to Browsing <span style="font-size:13px;" data-icon="B" aria-hidden="true"></span></a>
                <?php unset($goback); endif; ?>
                </div>
            </div>  <!-- / #savedListTop.savedListBar -->
