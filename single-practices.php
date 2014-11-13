<?php
get_header();

$custom              = get_post_custom( $post->ID );
$tagline             = $custom["tagline"][0];
$description         = $custom["description"][0];
$attorney_title      = ( $custom["attorney_title"][0] ) ? $custom["attorney_title"][0] : 'Practice Contact';
$chair_id            = $custom["chair_id"][0];
$attorney_title_2    = $custom["attorney_title_2"][0];
$chair_id_2          = $custom["chair_id_2"][0];
$rep_matters         = $custom["rep_matters"][0];
$this_post           = $post->ID;
$areas_focus         = get_post_meta( $post->ID, 'areas_focus', true );
$practices_attorneys = get_post_meta( $post->ID, 'practices_attorneys', true );
$industries         = get_post_meta( $post->ID, 'industry', 'single' );

if ( $chair_id_2 ) {
	$attorney_title = $attorney_title . 's';
}
?>

<div id="primary" class="content-area terminal-page">

	<header class="page-header">
		<div class="span12 aligncenter">
			<h1 class="page-title"><?php the_title(); ?></h1>
		</div>
	</header><!-- .entry-header -->

<main id="main" class="site-main span12 aligncenter clear" role="main">

<aside class="aside aside-left span2 push-left">
	<div class="border-block top">
		<h3 class="block-label">Practices</h3>

		<?php
		$practices = new WP_Query( array(
			'post_type'      => 'practices',
			'orderby'        => 'title',
			'order'          => 'ASC',
			'posts_per_page' => 100
		) );

		while ( $practices->have_posts() ) : $practices->the_post();
			?>
			<ul>
				<li class="<?php echo $post->post_name; ?>">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			</ul>

		<?php endwhile; ?>
	</div>
</aside>

<section class="span6 push-left">

	<article class="block-2 practice-content">
		<div class="entry-content">
		<?php echo ( $tagline ) ? '<h2>' . $tagline . '</h2>' : ''; ?>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
		<?php endif; ?>
		</div>
	</article>
</section>

<aside class="aside aside-right">
	<div class="border-block top">

		<?php if ( $chair_id && get_post( $chair_id ) ) : ?>
			<h3 class="block-label"><?php echo $attorney_title; ?></h3>
			<div class="block-person border-block top-right">
				<?php
				// Get Attorney by Id
				$practice_chair = get_post_meta( $chair_id );
				$chair_name     = $practice_chair['first_name'][0] . ' ';
				$chair_name .= $practice_chair['middle_initial'][0] . ' ';
				$chair_name .= $practice_chair['last_name'][0];
				$chair_phone = $practice_chair['phone'][0];
				$chair_email = $practice_chair['email'][0];

				// Get Attorney URL
				$get_chair = get_post( $chair_id );
				$chair_url = $get_chair->guid;
				?>
				<div class="holder">
					<h3 class="block-label"><a href="<?php echo get_permalink( $chair_id ); ?>"><?php echo $chair_name; ?></a></h3>

					<p>
						P: <?php echo $chair_phone; ?>
					</p>
					<ul class="links">
						<?php if ( $chair_email ) : ?>
							<li class="link-mail"><a href="mailto:<?php echo $chair_email; ?>">Email</a></li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		<?php endif; ?>
		<?php if ( $chair_id_2 && get_post( $chair_id_2 ) ) : ?>
			<div class="block-person border-block top-right">
				<?php
				// Secondary Practice Contact

				// Get Attorney by Id
				$practice_chair = get_post_meta( $chair_id_2 );
				$chair_name     = $practice_chair['first_name'][0] . ' ';
				$chair_name .= $practice_chair['middle_initial'][0] . ' ';
				$chair_name .= $practice_chair['last_name'][0];
				$chair_phone = $practice_chair['phone'][0];
				$chair_email = $practice_chair['email'][0];

				// Get Attorney URL
				$get_chair = get_post( $chair_id_2 );
				$chair_url = $get_chair->guid;
				?>
				<div class="holder ">
					<h3 class="block-label"><a href="<?php echo get_permalink( $chair_id_2 ); ?>"><?php echo $chair_name; ?></a></h3>
					<p>
						P: <?php echo $chair_phone; ?>
					</p>
					<ul class="links">
						<?php if ( $chair_email ) : ?>
							<li class="link-mail"><a href="mailto:<?php echo $chair_email; ?>">Email</a></li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		<?php endif; ?>

		<div class="border-block top">
			<h3 class="block-label top">Practicing Attorneys</h3>
			<ul>
			<?php
			// Get current page title, and remove special characters
			$current_practice = get_the_title();
			$current_practice = str_replace( ',', '', $current_practice );
			$current_practice = str_replace( '&', '', $current_practice );


			// Get all Attorneys
			$loop = new WP_Query( array(
				'post_type'      => 'attorneys',
				'meta_key'       => 'last_name',
				'orderby'        => 'meta_value',
				'order'          => 'ASC',
				'posts_per_page' => 1000
			) );
			while ( $loop->have_posts() ) : $loop->the_post();
				$custom = get_post_custom( $post->ID );
				$name   = $custom["first_name"][0] . ' ';
				$name .= $custom["middle_initial"][0] . ' ';
				$name .= $custom["last_name"][0];

				$areas_practice = get_post_meta( $post->ID, 'areas_practice', true );

				// Only show Attorneys where areas of practice match current page
				if (
					( is_array( $areas_practice ) && in_array( $current_practice, $areas_practice ) ) ||
					( is_array( $practices_attorneys ) && in_array( $post->ID, $practices_attorneys ) )
				) :

					?>

					<li>
						<a href="<?php the_permalink() ?>"><?php echo $name; ?></a>
					</li>

				<?php
				endif;
			endwhile;
			?>
		</ul>
		</div>

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


		<?php wp_reset_postdata(); ?>
		<a class="button" href="<?php echo esc_url( home_url( '/' ) ) . 'news-events/practice/' . $post->post_name . '/'; ?>">View <?php the_title(); ?> Blog Posts
			<span class="icon-arrow-right"></span>
		</a>

	</div>
</aside>

<section class="bottom-matter">

	<div class="menu span3 push-left">
		<h3 class="rep-matters menu-item border-block top-right active">Representative Matters</h3>
		<h3 class="articles menu-item border-block top-right">Articles</h3>
		<h3 class="news menu-item border-block top-right">News</h3>
	</div>

	<div class="sections span6 push-left">

		<h3 class="rep-matters section-title border-block top-right active">Representative Matters</h3>

		<section class="rep-matters bottom-section border-block top-right-bottom  active">
			<?php echo $rep_matters; ?>
		</section>

		<?php if ( ! $rep_matters ) : ?>
		<script type="text/javascript">
			jQuery(function ($) {
				$(function () {
					$('.rep-matters').remove();
				});
			});
		</script>
		<?php endif; ?>

		<h3 class="articles section-title border-block top-right">Articles</h3>

		<section class="articles bottom-section border-block top-right-bottom ">

			<?php
			$loop = new WP_Query( array(
				'post_type'      => 'articles',
				'orderby'        => 'date',
				'order'          => 'DESC',
				'posts_per_page' => 100
			) );
			$i    = 0;
			while ( $loop->have_posts() ) : $loop->the_post();
				$custom      = get_post_custom( $post->ID );
				$pub_summary = $custom["pub_summary"][0];
				$date        = get_the_date( 'm/d/y' );

				$pub_summary = strip_tags( $pub_summary );
				if ( strlen( $pub_summary ) > 350 ) {
					$pub_summary = preg_replace( '/\s+?(\S+)?$/', '', substr( $pub_summary, 0, 350 ) );
					$pub_summary .= '&hellip;';
				}
				$pub_practices = get_post_meta( $post->ID, 'pub_practices', true );

				if ( is_array( $pub_practices ) && in_array( $this_post, $pub_practices ) ) :
					?>

					<div class="date"><?php echo $date; ?></div>
					<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>


					<?php
					$i ++;
				endif;
			endwhile;
			if ( $i == 0 ) : ?>
				<script type="text/javascript">
					jQuery(function ($) {
						$(function () {
							$('.articles').remove();
						});
					});
				</script>
			<?php endif; ?>
		</section>

		<h3 class="news section-title border-block top-right">News</h3>

		<section class="news bottom-section border-block top-right-bottom ">


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
				$news_practices = get_post_meta( $post->ID, 'news_practices', true );

				$news_type_select = $custom["news_type_select"][0];
				$link_target      = ( $news_type_select == 'external' || $news_type_select == 'pdf' ) ? 'target="_blank"' : '';
				if ( $news_type_select == 'internal' ) {
					$source_url = get_permalink();
				}
				$attachments = attachments_get_attachments();
				if ( $attachments ) {
					$pdf = $attachments[0]['location'];
				} else { $pdf = ''; }

				if ( $pdf ) {
					$source_url = $pdf;
				}

				if ( is_array( $news_practices ) && in_array( $this_post, $news_practices ) ) :
					?>

					<div class="date"><?php echo $fix_date; ?> | Source: <?php echo $source; ?></div>
					<h5><a href="<?php echo $source_url; ?>" <?php echo $link_target; ?>><?php the_title(); ?></a></h5>


					<?php
					$i ++;
				endif;
			endwhile;
			if ( $i == 0 ) : ?>
				<script type="text/javascript">
					jQuery(function ($) {
						$(function () {
							$('.news').remove();
						});
					});
				</script>
			<?php endif; ?>

		</section>
	</div>
</section>

</main>

<?php get_footer();