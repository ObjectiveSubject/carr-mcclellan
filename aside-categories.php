<aside class="aside aside-right aside-categories">

	<div class="border-block top categories">
		<h3 class="block-label">Categories</h3>
		<ul>
			<? $cats = get_the_category(); ?>
			<? foreach ($cats as $cat) { ?>
			 <li><a href="<? echo get_category_link( $cat->term_id ); ?>" class="link-gray3"><? echo $cat->name; ?></a></li>
			<? } ?>
		</ul>
	</div>

</aside>