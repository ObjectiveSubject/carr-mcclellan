<?php
get_header();

$name = get_post_meta( $post->ID, "first_name", true ) . ' ';
$name .= ( get_post_meta( $post->ID, "middle_initial", true ) ) ? get_post_meta( $post->ID, "middle_initial", true ) . ' ' : '';
$name .= get_post_meta( $post->ID, "last_name", true );
$title     = get_post_meta( $post->ID, "title", true );
$sec_title = get_post_meta( $post->ID, "secondary_title", true );
$phone     = get_post_meta( $post->ID, "phone", true );
$fax       = get_post_meta( $post->ID, "fax", true );
$email     = get_post_meta( $post->ID, "email", true );
$linkedin  = get_post_meta( $post->ID, "linkedin", true );
$biography = get_post_meta( $post->ID, "biography", true );
$title     = get_post_meta( $post->ID, "title", true );

$quote              = get_post_meta( $post->ID, "quote", true );
$academic_creds     = get_post_meta( $post->ID, "academic_creds", true );
$attorney_languages = get_post_meta( $post->ID, "attorney_languages", true );
$special_exp        = get_post_meta( $post->ID, "special_exp", true );
$prof_affilations   = get_post_meta( $post->ID, "prof_affilations", true );
$courts_forums      = get_post_meta( $post->ID, "courts_forums", true );
$civic_affiliations = get_post_meta( $post->ID, "civic_affiliations", true );
$honors_awards      = get_post_meta( $post->ID, "honors_awards", true );
$custom_title       = get_post_meta( $post->ID, "custom_title", true );
$custom_body        = get_post_meta( $post->ID, "custom_body", true );
$recent_exp         = get_post_meta( $post->ID, "recent_exp", true );
$recent_speaking    = get_post_meta( $post->ID, "recent_speaking", true );

$this_post = $post->ID;

$areas_practice         = get_post_meta( $post->ID, 'areas_practice', 'single' );
$areas_related_practice = get_post_meta( $post->ID, 'areas_related_practice', 'single' );
$industries             = get_post_meta( $post->ID, 'industry', 'single' );

?>

	<div id="primary" class="content-area terminal-page">

	<?php while ( have_posts() ) : the_post(); ?>

		<header class="page-header">
			<div class="span12 aligncenter">
				<h1 class="page-title"><?php the_title(); ?></h1>
				<?php if ( $title ) : ?>
					<div class="entry-meta">
						<strong class="meta-title font-heading caps"><?php echo $title; ?></strong>
					</div><!-- .entry-meta -->
				<?php endif; ?>
				<?php the_post_thumbnail( 'full', array( 'class' => 'attorney-pic' ) ); ?>
			</div>
		</header><!-- .entry-header -->

		<main id="main" class="site-main span12 aligncenter clear" role="main">

			<aside class="aside aside-left span2 push-left">

				<div class="border-block top contact-info">
					<h3 class="block-label phone">Phone</h3>
					<ul>
						<li><?php echo $phone; ?></li>
					</ul>
					<h3 class="block-label fax">Fax</h3>
					<ul>
						<li><?php echo $fax; ?></li>
					</ul>
					<h3 class="block-label email">Email</h3>
					<ul>
						<li>
							<a href="mailto:<?php echo $email; ?>" target="_blank" class="link-gray3"><?php echo $email; ?></a>
						</li>
					</ul>
					<h3 class="block-label vcard">
						<a href="<?php echo esc_url( home_url( '/' ) ) . 'v-card/' . $post->post_name; ?>" class="link-gray3"><span class="small icon-download"></span>&nbsp;&nbsp;Download vCard</a>
					</h3>

					<h3 class="block-label print">
						<a href="javascript:if(window.print)window.print();" class="link-gray3"><span class="icon-print"></span>&nbsp;&nbsp;Print Profile</a>
					</h3>
				</div>

			</aside>


			<article id="post-<?php the_ID(); ?>" class="span6 push-left">

				<div class="entry-content">
					<?php echo apply_filters( 'the_content', $biography ); ?>
				</div>
				<!-- .entry-content -->

			</article>
			<!-- #post-## -->


			<aside class="aside aside-right">

				<?php if ( $areas_practice ) : ?>
					<div class="border-block top practice-areas">
						<h3 class="block-label">Practice Areas</h3>
						<ul>
							<?php foreach ( $areas_practice as $practice ) : ?>
								<li>
									<a href="<?php echo get_the_permalink( $practice ); ?>"><?php echo get_the_title( $practice ); ?></a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>

				<?php if ( $industries ) : ?>
					<div class="border-block top industry">
						<h3 class="block-label">Industries</h3>
						<ul>
							<?php foreach ( $industries as $industry ) : ?>
								<li>
									<a href="<?php echo get_the_permalink( $industry ); ?>"><?php echo get_the_title( $industry ); ?></a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>

				<div class="border-block top academic-creds">
					<h3 class="block-label">Academic Credentials</h3>
					<ul>
						<li><?php echo $academic_creds; ?></li>
					</ul>
				</div>

				<a class="button" href="<?php echo esc_url( home_url( '/' ) ) . 'news-events/attorney/' . $post->post_name . '/'; ?>">View <?php echo get_post_meta( $post->ID, "first_name", true ) . '\'s' ?> Blog Posts
					<span class="icon-arrow-right"></span>
				</a>

			</aside>

			<section class="bottom-matter">

				<div class="menu span3 push-left">
					<h3 class="experience-affiliations menu-item border-block top-right active">Experience &amp; Affiliations</h3>

					<h3 class="publications menu-item border-block top-right">Publications</h3>

				</div>

				<div class="sections span6 push-left">

					<section class="experience-affiliations bottom-section border-block top-right-bottom active">
						<?php if ( $special_exp ) : ?>
							<h4>Representative Matters</h4>
							<?php echo $special_exp; ?>
						<?php endif; ?>

						<?php if ( $prof_affilations ) : ?>
							<h4>Professional Organizations</h4>
							<?php echo $prof_affilations; ?>
						<?php endif; ?>

						<?php if ( $courts_forums ) : // @todo: could change everything under the hood to use attorneys instead of courts {?>
							<h4>Addmissions and Forums</h4>
							<?php echo $courts_forums; ?>
							<?php endif; ?>

						<?php if ( $civic_affiliations ) : ?>
							<h4>Civic and Charitable</h4>
							<?php echo $civic_affiliations; ?>
						<?php endif; ?>

						<?php if ( $recent_speaking ) : ?>
							<h4>Recent Speaking Engagements</h4>
							<?php echo $recent_speaking; ?>
						<?php endif; ?>

						<?php if ( $honors_awards ) : ?>
							<h4>Honors and Awards</h4>
							<?php echo $honors_awards; ?>
						<?php endif; ?>

						<?php if ( $custom_title && $custom_body ) : ?>
							<h4><?php echo $custom_title; ?></h4>
							<?php echo $custom_body; ?>
						<?php endif; ?>
					</section>


					<section class="publications bottom-section border-block top-right-bottom">
						<?php
						$loop = new WP_Query( array(
							'post_type'      => 'publications',
							'orderby'        => 'date',
							'order'          => 'DESC',
							'posts_per_page' => 100
						) );
						if ( $loop->have_posts() ) :
							?>
							<h4>Publications</h4>
							<article>
								<?php
								$related_count = 0;
								$i             = 0;
								while ( $loop->have_posts() ) : $loop->the_post();
									$custom      = get_post_custom( $post->ID );
									$pub_summary = get_post_meta( $post->ID, "pub_summary", true );
									$type        = wp_get_post_terms( $post->ID, 'publications' );
									if ( $type ) {
										$type = $type[0]->name;
									}
									$date = get_the_date( 'm/d/y' );

									$pub_summary = strip_tags( $pub_summary );
									if ( strlen( $pub_summary ) > 350 ) {
										$pub_summary = preg_replace( '/\s+?(\S+)?$/', '', substr( $pub_summary, 0, 350 ) );
										$pub_summary .= '…';
									}
									$pub_attorneys = get_post_meta( $post->ID, 'pub_attorneys', 'single' );


									if ( is_array( $pub_attorneys ) && in_array( $this_post, $pub_attorneys ) ) :
										?>

										<div class="date"><?php echo $date; ?></div>
										<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>


										<?php
										$i ++;
									endif;
								endwhile;
								if ( $i == 0 ) :
									$related_count ++;
									// this JS could probably be moved into the core script
									?>
									<script type="text/javascript">
										jQuery(function ($) {
											$(function () {
												$('.publications').remove();
											});
										});
									</script>
								<?php
								endif;
								?>
							</article>
						<?php endif; ?>
					</section>

				</div>

		</main><!-- #main -->

	<?php endwhile; // end of the loop. ?>

	</div><!-- #primary -->

<?php get_footer();
