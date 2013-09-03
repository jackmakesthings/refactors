<?php 
$primary = array('Lighting', 'Seating', 'Tables', 'Mirrors', 'Screens', 'Case Pieces', 'Accesories');
$secondary = array('About', 'Contact');
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Untitled</title>
        <link rel="stylesheet" href="stylesheets/screen.css">
        <link rel="author" href="humans.txt">
    </head>
    <body>

        <div class="page">
        <header class="site-header row">
          <a href="" class="logo" rel="" role="banner">John Salibello</a>
          <nav class="site-nav" role="navigation">
            <ul class="primary menu" role="">
            <?php foreach($primary as $link): ?>
              <li><a href="<?php echo $link; ?>" rel=""><?php echo $link; ?></a>
                <ul class="sub-menu">
                  <li><a href="">Sub-link</a></li>
                  <li><a href="">Sub-link</a></li>
                  <li><a href="">Sub-link</a></li>
                </ul>
              </li>
            <?php endforeach; ?>
            </ul>
            <ul class="secondary menu" role="">
            <?php foreach($secondary as $link): ?>
              <li><a href="<?php echo $link; ?>"><?php echo $link; ?></a></li>
            <?php endforeach; ?>
            </ul>
          </nav>
        </header>
        <header class="page-header">
            <div class="actions">
              <form id="site-search" class="quarter omega">
                  <input type="text" role="search" tabindex="1" id="search" name="search" placeholder="search">
                  <button type="submit" role="submit" id="search-submit">&gt;</button>
              </form>
              <a href="list" class="button saved-list">My Saved List</a>
              </div>
        <h1 class="page-title">
            Page Title
        </h1>
        </header>
        <ul class="products row">
        	<li class="product item quarter">
        		<a href="" class="block">
        			<img src="http://fakeimg.pl/232x232/fff/eee/?text=product" alt="">
        			<div class="overlay">
        				Product Title
        			</div>
        		</a>
        	</li>
        	<li class="product item quarter">
        		<a href="" class="block">
        			<img src="http://fakeimg.pl/232x232/fff/eee/?text=product" alt="">
        			<div class="overlay">
        				Product Title
        			</div>
        		</a>
        	</li>
        	<li class="product item quarter">
        		<a href="" class="block">
        			<img src="http://fakeimg.pl/232x232/fff/eee/?text=product" alt="">
        			<div class="overlay">
        				Product Title
        			</div>
        		</a>
        	</li>
            <li class="product item quarter">
                <a href="" class="block">
                    <img src="http://fakeimg.pl/232x232/fff/eee/?text=product" alt="">
                    <div class="overlay">
                        Product Title
                    </div>
                </a>
            </li>
            <li class="product item quarter">
                <a href="" class="block">
                    <img src="http://fakeimg.pl/232x232/fff/eee/?text=product" alt="">
                    <div class="overlay">
                        Product Title
                    </div>
                </a>
            </li>
            <li class="product item quarter">
                <a href="" class="block">
                    <img src="http://fakeimg.pl/232x232/fff/eee/?text=product" alt="">
                    <div class="overlay">
                        Product Title
                    </div>
                </a>
            </li>
            <li class="product item quarter">
                <a href="" class="block">
                    <img src="http://fakeimg.pl/232x232/fff/eee/?text=product" alt="">
                    <div class="overlay">
                        Product Title
                    </div>
                </a>
            </li>
        	<li class="product item quarter">
        		<a href="" class="block">
        			<img src="http://fakeimg.pl/232x232/fff/eee/?text=product" alt="">
        			<div class="overlay">
        				Product Title
        			</div>
        		</a>
        	</li>
        </ul>
        <div class="debug row">
            <div class="seven product-images">

            <div class="demo"> </div>
            <ul class="seven-row product-gallery">
                <li class="product-thumb"><a href="" class="demo"></a></li>
                <li class="product-thumb"><a href="" class="demo"></a></li>
                <li class="product-thumb"><a href="" class="demo"></a></li>
                <li class="product-thumb"><a href="" class="demo"></a></li>
                <li class="product-thumb"><a href="" class="demo"></a></li>
            </ul>
            </div>
            <div class="demo five omega"></div>
        </div>
        </div><!-- page -->
        <!--script src="js/main.js"></script-->
    </body>
</html>