<?php include DIR_TMPL.'/header.php'; ?>

<?php // echo $content; ?>


<div class="gridWrapper">
	<ul id="products">
		<li class="product">
			<a href="">
				&nbsp;
		 		<div class="productOverlay">
				<span>The name of the product shows up here on hover</span>
				</div>
			</a>	
		</li>		

				<li class="product">
			<a href="">
				&nbsp;
		 		<div class="productOverlay">
				<span>The name of the product shows up here on hover</span>
				</div>
			</a>	
		</li>

				<li class="product">
			<a href="">
				&nbsp;
		 		<div class="productOverlay">
				<span>The name of the product shows up here on hover</span>
				</div>
			</a>	
		</li>

				<li class="product">
			<a href="">
				&nbsp;
		 		<div class="productOverlay">
				<span>The name of the product shows up here on hover</span>
				</div>
			</a>	
		</li>
	</ul>
</div>

<footer class="gridFooter">
	<ul class="subNav" id="shopFooterNav">
		<li class="showAll">
			<a href="#" class="showAllButton button">Show All 24 Pieces</a>
		</li>
		<ul class="pagination bottomPagination">
			<li class="paginationControl prev">
				<a class="button">&lt; Prev</a>
			</li>
			<?php
			for ( $j=1; $j>=5; $j++ ) { ?>
			<li class="paging pageCounter">
				<a href="#"><?php echo $j; ?></a>
			</li>
			<?php } ?>
			<li class="paginationControl next">
				<a class="button">Next &gt;</a>
			</li>
		</ul> <!-- .pagination -->
	</ul> <!-- #shopFooterNav -->
</footer> <!-- .gridFooter -->


<?php include DIR_TMPL.'/footer.php'; ?>