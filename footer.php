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
			<?php wp_nav_menu( array( 'theme_location' => 'footer_main' ) ); ?>
			</nav>
			<a href="<?php echo get_bloginfo( 'url' ); ?>" class="monogram sprite"><span class="hide-text">Carr McClellan</span></a>
		</div>

		<div class="row row2 span12 aligncenter">

			<div id="cm_embed_signup" class="clear">
				<form id="cm-embedded-subscribe-form" action="http://carrmcclellan.createsend.com/t/j/s/ptyliu/" method="post">
					<h3 class="font-text">Sign up for our newsletter</h3>
					<div class="cm-field-group">
		        <input id="fieldEmail" name="cm-ptyliu-ptyliu" type="email" placeholder="Email address" class="email" required />
		        <input type="submit" value="Submit" name="subscribe" id="cm-embedded-subscribe" class="button">
					</div>
				</form>
			</div>

			<div class="contact span6 push-left">
				<h3 class="font-text"><a href="<?php echo get_bloginfo( 'url' ); ?>/our-firm/contact-us/">Burlingame</a></h3>
				<address class="info span2 push-left">
					216 Park Road<br/>
					Burlingame, CA 94010
				</address>
				<div class="info span3 push-left">
					650-342-9600<br/>
					<a href="mailto:info@carr-mcclellan.com" target="_blank">info@carr-mcclellan.com</a>
				</div>
			</div>

			<div class="contact span6 push-left">
				<h3 class="font-text"><a href="<?php echo get_bloginfo( 'url' ); ?>/our-firm/contact-us/">San Francisco</a></h3>
				<address class="info span2 push-left">
					425 Market Street, Suite 2230<br/>
					San Francisco, CA 94105
				</address>
				<div class="info span3 push-left">
					650-342-9600<br/>
					<a href="mailto:info@carr-mcclellan.com" target="_blank">info@carr-mcclellan.com</a>
				</div>
			</div>
		</div>

		<div class="row row3 span12 aligncenter">
			<div class="span6 push-left">
				<nav id="social-navigation" class="social-nav">
					<ul class="menu">
						<!-- <li><a href="#" class="icon-twitter" target="_blank"><span class="hide-text">Twitter</span></a></li> -->
						<li><a href="https://www.linkedin.com/company/carr-mcclellan/" class="icon-linkedin" target="_blank"><span class="hide-text">Linkedin</span></a></li>
						<!-- <li><a href="#" class="icon-facebook" target="_blank"><span class="hide-text">Facebook</span></a></li> -->
					</ul>
				</nav>
				<nav id="utility-navigation" class="utility-nav">
					<?php wp_nav_menu( array( 'theme_location' => 'footer_secondary' ) ); ?>
				</nav>
			</div>

			<div class="copyright caps span5 push-left">&copy; <?php echo date("Y"); ?> Carr McClellan P.C.</div>
		</div>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
