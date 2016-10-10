<?php
get_header();

$month         = strlen( get_the_date( 'F' ) );
$date          = ( $month > 3 ? get_the_date( 'M. j, Y' ) : get_the_date( 'M j, Y' ) );
$attachments   = attachments_get_attachments();
$pub_attorneys = get_post_meta( $post->ID, 'pub_attorneys', 'single' );
$pub_practices = get_post_meta( $post->ID, 'pub_practices', 'single' );

if ( $attachments ) {
	$pdf = $attachments[0]['location'];
} else {
	$pdf = '';
}
?>

	<div id="primary" class="content-area page-default">

		<header class="page-header">
			<div class="span12 aligncenter">
				<h1 class="page-title"><?php the_title(); ?></h1>
				<?php if ( has_term( 'food-beverage', 'industries_tax') ) : ?>
					<div class="page-subtitle">
						<a href="<?php echo esc_url( site_url( '/insights-industries/food-beverage/' ) ); ?>">Food & Beverage</a>
					</div>
				<?php endif; ?>
				<div class="entry-meta">
					<strong class="meta-date font-heading caps"><?php echo get_the_date('M. j, Y'); ?></strong>
				</div><!-- .entry-meta -->
			</div>
		</header>

		<main id="main" class="site-main span12 aligncenter clear" role="main">

			<aside class="aside aside-left aside-author-share">
				<div class="border-block top categories">
					<h3 class="block-label">Attorneys</h3>

					<ul class="list list-2 attorney_article">
						<?php
						$loop = new WP_Query( array(
							'post_type'      => 'attorneys',
							'meta_key'       => 'last_name',
							'orderby'        => 'meta_value',
							'order'          => 'ASC',
							'posts_per_page' => 100
						) );
						while ( $loop->have_posts() ) : $loop->the_post();
							if ( in_array( $post->ID, $pub_attorneys ) ) :
								?>
								<li>
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</li>
							<?php
							endif;
						endwhile;
						?>
					</ul>
				</div>
			</aside>

			<article id="post-<?php the_ID(); ?>" <?php post_class('span6 push-left'); ?>>

				<?php if ( have_posts() ) :

					while ( have_posts() ) : the_post(); ?>

						<div class="entry-content">
							<?php the_content(); ?>
						</div>

					<?php endwhile; ?>

				<?php endif; ?>

			</article>

			<aside class="aside aside-right aside-categories">

				<div class="border-block top categories">
					<h3 class="block-label">Practice Areas</h3>
					<ul class="list list-2">
						<?php
						$loop = new WP_Query( array(
							'post_type'      => 'practices',
							'orderby'        => 'title',
							'order'          => 'ASC',
							'posts_per_page' => 100
						) );
						while ( $loop->have_posts() ) : $loop->the_post();
							if ( in_array( $post->ID, $pub_practices ) ) :
								?>
								<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
							<?php
							endif;
						endwhile;
						?>
					</ul>
				</div>

			</aside>
	</div>

<?php get_footer(); ?>
