<?php $pagetype = 'policies'; $pageclass = 'policies';
include DIR_TMPL.'/header.php';
?>

<header class="pageHeader">
	<h1>Policies/FAQ</h1>
</header>

<div class="gridWrapper aboutWrapper policiesWrapper">
	<div class="policies col3">
		<div class="col col1-3">
			<div class="sidebarAbout" id="policiesAbout"><h4>Please contact us with any additional questions.</h4><p>(212) 838-5767</p></div>
		</div>
		<div class="col col2-3">
			<?php echo $content; ?>
		</div>
	</div>
</div>
<?php include DIR_TMPL.'/footer.php'; ?>
