<aside class="aside aside-left aside-author-share">

	<div class="border-block top author">
		<h3 class="block-label">Author</h3>
		<ul>
		<? $related_attorneys = get_post_meta($post->ID, 'post_attorneys', 'single'); ?>
		<? foreach ($related_attorneys as $related_attorney) { ?>
			<li><a href="<? echo get_permalink($related_attorney); ?>" class="link-gray3"><? echo get_the_title($related_attorney); ?></a></li>
		<? } ?>
		</ul>
	</div>

	<div class="border-block top social-share">
		<h3 class="block-label">Share</h3>
		<ul>
			<li><a href="#" class="social-icon icon-twitter"><span class="hide-text">Twitter</span></a></li>
			<li><a href="#" class="social-icon icon-linkedin"><span class="hide-text">Linkedin</span></a></li>
			<li><a href="#" class="social-icon icon-facebook"><span class="hide-text">Facebook</span></a></li>
			<li><a href="#" class="social-icon icon-tumblr"><span class="hide-text">Tumblr</span></a></li>
			<li><a href="#" class="social-icon icon-googleplus"><span class="hide-text">Google Plus</span></a></li>
		</ul>
	</div>
</aside>