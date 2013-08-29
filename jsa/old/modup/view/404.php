<?php $pagetype = 'error404';
$head['title'] = '404 Page Not Found';
include DIR_TMPL.'/header.php';
?>

<header class="pageHeader">
	<h1>Page not Found</h1>
</header>

<div class="gridWrapper aboutWrapper error404Wrapper">
	<div class="error404 col3">
		<div class="col col1-3">
			<p class="sidebar404"><b>Please contact us with any questions.</b><br><br>(212) 838-5767</p>
		</div>
		<div class="col col2-3">
			<h2>Sorry, we couldn't find the page you were looking for!</h2>
			<p>We've recently redesigned our website, and some things have moved or been renamed in the process.</p>
			<p>Please try the following:</p>
			<ul>
				<li>If you typed the page address in the address bar, make sure that it is spelled correctly.</li>
				<li>Use the navigation bar above to find the link you are looking for.</li>
				<li>Enter a term in the search form below to look for the information.

			            <div class="searchBar" id="search404">
			                <div class="searchBox ui-widget" id="searchBox404">
			                    <form action='/search_results/' id='search-form-404' method='get'>
			                        <input id="text404" type="text" name='q' class="search_input text" placeholder="Search">
			                        <input type="submit" name='search_submit' class="submit button" id="search_submit" value="R">
			                    </form>
			                </div>
			            </div>
				</li>
				<li>Take a look at our <a href="/featured/">Featured Items</a></li>
			</ul>
		</div>
	</div>
</div>
<?php include DIR_TMPL.'/footer.php'; ?>
