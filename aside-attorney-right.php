<aside class="aside aside-right">

	<div class="border-block top practice-areas">
		<h3 class="block-label">Practice Areas</h3>
		<ul>
			<? foreach($areas_practice as $practice) : ?>
			<li><a href="<? echo get_the_permalink($practice); ?>"><? echo get_the_title($practice); ?></a></li>
			<? endforeach; ?>
		</ul>
	</div>

	<div class="border-block top academic-creds">
		<h3 class="block-label">Academic Credentials</h3>
		<ul>
			<li><? echo $academic_creds; ?></li>
		</ul>
	</div>

	<a class="button">View <? echo $custom["first_name"][0] . '\'s' ?> Blog Posts <span class="icon-arrow-right"></span></a>

</aside>