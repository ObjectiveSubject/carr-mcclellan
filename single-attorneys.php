<?php
get_header();

$custom = get_post_custom( $post->ID );
$name   = $custom["first_name"][0] . ' ';
$name .= ( $custom["middle_initial"][0] ) ? $custom["middle_initial"][0] . ' ' : '';
$name .= $custom["last_name"][0];
$title     = $custom["title"][0];
$sec_title = $custom["secondary_title"][0];
$phone     = $custom["phone"][0];
$fax       = $custom["fax"][0];
$email     = $custom["email"][0];
$linkedin  = $custom["linkedin"][0];
$biography = $custom["biography"][0];
$title     = $custom["title"][0];

$quote              = $custom["quote"][0];
$academic_creds     = $custom["academic_creds"][0];
$attorney_languages = $custom["attorney_languages"][0];
$special_exp        = $custom["special_exp"][0];
$prof_affilations   = $custom["prof_affilations"][0];
$courts_forums      = $custom["courts_forums"][0];
$civic_affiliations = $custom["civic_affiliations"][0];
$honors_awards      = $custom["honors_awards"][0];
$custom_title       = $custom["custom_title"][0];
$custom_body        = $custom["custom_body"][0];
$recent_exp         = $custom["recent_exp"][0];
$recent_speaking    = $custom["recent_speaking"][0];

$this_post = $post->ID;

$areas_practice         = get_post_meta( $post->ID, 'areas_practice', 'single' );
$areas_related_practice = get_post_meta( $post->ID, 'areas_related_practice', 'single' );
$industries         = get_post_meta( $post->ID, 'industry', 'single' );



$v_card = get_bloginfo( 'template_url' ) . '/inc/v_card.php?';
$v_card .= 'f_name=' . $custom["first_name"][0];
$v_card .= '&l_name=' . $custom["last_name"][0];
$v_card .= '&m_name=' . $custom["middle_initial"][0];
$v_card .= '&company=Carr McClellan P.C.';
$v_card .= '&title=' . $custom["title"][0];
$v_card .= '&address=216 Park Road';
$v_card .= '&city=Burlingame';
$v_card .= '&state=CA';
$v_card .= '&postal=94010';
$v_card .= ( $custom["phone"][0] ) ? '&phone=' . $custom["phone"][0] : '&phone=(650) 342-9600 ';
$v_card .= ( $custom["fax"][0] ) ? '&fax=' . $custom["fax"][0] : '&fax=(650) 342-7685';
$v_card .= '&email=' . $custom["email"][0];
$v_card .= '&url=' . get_permalink();
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
					<a href="#" class="link-gray3"><span class="icon-print"></span>&nbsp;&nbsp;Print Profile</a></h3>
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

			<a class="button">View <?php echo $custom["first_name"][0] . '\'s' ?> Blog Posts
				<span class="icon-arrow-right"></span></a>

		</aside>

		<section class="bottom-matter">

		<div class="menu span3 push-left">
			<h3 class="experience-affiliations menu-item border-block top-right active">Experience &amp; Affiliations</h3>

			<h3 class="publications menu-item border-block top-right">Publications</h3>

			<h3 class="related-content menu-item border-block top-right">Related Content</h3>
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

			<?php if ( $courts_forums ) : // @todo: could change everything under the hood to use attorneys instead of courts ?>
				<h4>Attorneys and Forums</h4>
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
						$pub_summary = $custom["pub_summary"][0];
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
						?>
						<script type="text/javascript">
							$(function () {
								$('.li-publications').remove();
							});
						</script>
					<?php
					endif;
					?>
				</article>
			<?php endif; ?>
		</section>

		<section class="related-content bottom-section border-block top-right-bottom">
			<h4>News</h4>
			<article>
				<?php
				$loop = new WP_Query( array(
					'post_type'      => 'news',
					'meta_key'       => 'date',
					'orderby'        => 'meta_value',
					'order'          => 'DESC',
					'posts_per_page' => 100
				) );
				$i    = 0;
				while ( $loop->have_posts() ) : $loop->the_post();
					$custom         = get_post_custom( $post->ID );
					$date           = $custom["date"][0];
					$fix_date       = explode( '/', $date );
					$fix_date       = $fix_date[1] . '/' . $fix_date[2] . '/' . $fix_date[0];
					$source         = $custom["source"][0];
					$source_url     = $custom["source_url"][0];
					$news_attorneys = get_post_meta( $post->ID, 'news_attorneys', 'single' );

					$news_type_select = $custom["news_type_select"][0];
					$link_target      = ( $news_type_select == 'external' || $news_type_select == 'pdf' ) ? 'target="_blank"' : '';

					$attachments = attachments_get_attachments();
					if ( $attachments ) {
						$pdf = $attachments[0]['location'];
					} else {
						$pdf = '';
					}

					if ( $pdf ) {
						$source_url = $pdf;
					}

					if ( is_array( $news_attorneys ) && in_array( $this_post, $news_attorneys ) ) :
						?>


						<div class="date"><?php echo $fix_date; ?> | Source: <?php echo $source; ?></div>
						<h5><a href="<?php echo $source_url; ?>" <?php echo $link_target; ?>><?php the_title(); ?></a></h5>


						<?php
						$i ++;
					endif;
				endwhile;
				if ( $i == 0 ) :
					$related_count ++;
					?>
					<script type="text/javascript">
						$(function () {
							$('.li-news').remove();
						});
					</script>
				<?php
				endif;
				?>
			</article>

			<h4>Blog Posts</h4>

				<?php
				$loop = new WP_Query( array(
					'post_type'      => 'post',
					'orderby'        => 'date',
					'order'          => 'DESC',
					'posts_per_page' => 100
				) );
				$i    = 0;
				while ( $loop->have_posts() ) :
					$loop->the_post();
					$post_attorneys = get_post_meta( $post->ID, 'post_attorneys', 'single' );


					if ( is_array( $post_attorneys ) && in_array( $this_post, $post_attorneys ) ) :
						?>
						<article>
							<div class="date"><?php the_date( 'm/d/y' ); ?></div>
							<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
						</article>

						<?php
						$i ++;
					endif;
				endwhile;
				if ( $i == 0 ) :
					$related_count ++;
					?>
					<script type="text/javascript">
						$(function () {
							$('.li-blogs').remove();
						});
					</script>
				<?php
				endif;
				?>
			</article>

		</section>
		</div>

		</main><!-- #main -->

	<?php endwhile; // end of the loop. ?>

	</div><!-- #primary -->

<?php get_footer();
