<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Carr McClellan
 */
?>

	</div><!-- #content -->
	
	<footer id="footer" class="site-footer" role="contentinfo">
		
		<div class="row row1 span12 aligncenter">
			<nav id="footer-navigation" class="footer-nav clear" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'main' ) ); ?>
			</nav>
			<a href="<? echo get_bloginfo('siteurl'); ?>" class="monogram sprite"><span class="hide-text">Carr McClellan</span></a>
		</div>
		
		<div class="row row2 span12 aligncenter">
			<div id="mc_embed_signup" class="span5 push-left">
				<form action="//kirkpettinga.us3.list-manage.com/subscribe/post?u=c4d01ae08a48a7dc40dad79d7&amp;id=74448769d8" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
			    <div id="mc_embed_signup_scroll">
						<h3 class="font-text">Sign up for our newsletter</h3>
						<div class="mc-field-group">
							<input type="email" value="" placeholder="Email address" name="EMAIL" class="required email" id="mce-EMAIL">
							<input type="submit" value="Submit" name="subscribe" id="mc-embedded-subscribe" class="button">
						</div>
						<div id="mce-responses" class="clear">
							<div class="response" id="mce-error-response" style="display:none"></div>
							<div class="response" id="mce-success-response" style="display:none"></div>
						</div>
						<div style="position: absolute; left: -5000px;"><input type="text" name="b_c4d01ae08a48a7dc40dad79d7_74448769d8" tabindex="-1" value=""></div>
			    </div>
				</form>
			</div>
			
			<div class="contact span5 push-right">
				<h3 class="font-text">Contact</h3>
				<address class="info span2 push-left">
					216 Park Road<br/>
					Burlingame, CA 94010
				</address>
				<div class="info span3 push-left">
					650-342-9600<br/>
					<a href="mailto:carr-mcclellan@carr-mcclellan.com" target="_blank">carr-mcclellan@carr-mcclellan.com</a>
				</div>
			</div>
		</div>
		
		<div class="row row3 span12 aligncenter">
			<div class="span5 push-left">
				<nav id="social-navigation" class="social-nav">
					<ul class="menu">
						<li><a href="#" class="icon-twitter" target="_blank"><span class="hide-text">Twitter</span></a></li>
						<li><a href="#" class="icon-linkedin" target="_blank"><span class="hide-text">Linkedin</span></a></li>
						<li><a href="#" class="icon-facebook" target="_blank"><span class="hide-text">Facebook</span></a></li>
					</ul>
				</nav>
				<nav id="utility-navigation" class="utility-nav">
					<?php wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?>
				</nav>
			</div>
			
			<div class="copyright caps span5 push-right">&copy; 2014 Carr McClellan P.C.</div>
		</div>
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<div id="grid-overlay">
	<div class="span12 wrapper aligncenter">
		<div class="column span1"></div>
		<div class="column span1"></div>
		<div class="column span1"></div>
		<div class="column span1"></div>
		<div class="column span1"></div>
		<div class="column span1"></div>
		<div class="column span1"></div>
		<div class="column span1"></div>
		<div class="column span1"></div>
		<div class="column span1"></div>
		<div class="column span1"></div>
		<div class="column span1"></div>
	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>