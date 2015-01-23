<?php
/**
 * Template Name: Attorney Landing
 **/

get_header();

/*$attorneys = new WP_Query(array(
	'post_type' => 'attorneys',
	'orderby' => 'menu_order',
	'order' => 'ASC',
	'posts_per_page' => -1
));*/

global $wpdb;
global $post;

// Originally sorting was done with menu_order and a plugin to rearrange in the backend
// This is a bit ugly, but uses a custom query to sort by the last_name post meta field

$attorneys = "
    SELECT wposts.*
    FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
    WHERE wposts.ID = wpostmeta.post_id
    AND wpostmeta.meta_key = 'last_name'
    AND wposts.post_type = 'attorneys'
    ORDER BY wpostmeta.meta_value ASC
    LIMIT 80
    ";

	$attorneys = $wpdb->get_results( $attorneys, OBJECT );
?>

<div id="primary" class="content-area page-default">
	<header class="page-header">
		<div class="span12 aligncenter">
			<h1 class="page-title"><?php the_title(); ?></h1>
		</div>
	</header>

	<main id="main" class="site-main span12 aligncenter" role="main">

		<aside class="aside aside-left span2 push-left">
			<div class="border-block top sidebar-menu-block">
				<h3 class="block-label sidebar-menu-header">Filter by practice  <span class="icon-arrow-down"></span></h3>

				<?php
					$practices = new WP_Query(array(
						'post_type' => 'practices',
						'orderby' => 'title',
						'order' => 'ASC',
						'posts_per_page' => 100
					));
				?>
				<ul class="practice-list sidebar-menu">
						<li class="practice all active">All Practices</li>
					<?php while ( $practices->have_posts() ) : $practices->the_post(); ?>
						<li class="practice <?php echo $post->post_name; ?>"><?php the_title();?></li>
					<?php endwhile; ?>
				</ul>
			</div>
		</aside>

		<section class="span9 push-right attorneys">
			<?php // while ( $attorneys->have_posts() ) : $attorneys->the_post(); ?>
			<?php foreach ( $attorneys as $post ) : ?>

				<?php
					$custom = get_post_custom( $post->ID );
					$name = get_post_meta( $post->ID, 'first_name', true ) . ' ';
					$name .= get_post_meta( $post->ID, 'middle_initial', true ) . ' ';
					$name .= get_post_meta( $post->ID, 'last_name', true);

					$title = get_post_meta( $post->ID, 'title', true );
					$sec_title = get_post_meta( $post->ID, 'secondary_title', true );

					// $areas_practice = get_post_meta($post->ID, 'areas_practice', true);
					$areas_practice = get_post_meta($post->ID, 'areas_practice', 'single');

					$practice_areas = '';
					foreach ( $areas_practice as $practice ) {
						$practice_post = get_post( $practice );
						$practice_areas .= $practice_post->post_name . ' ';
					}

				?>

				<article class="border-block top-right-bottom square attorney sortable all <?php echo $practice_areas; ?> active">
					<a href="<?php the_permalink() ?>">
						<h3><?php echo $name; ?></h3>
	
						<p class="titles">
							<?php echo $title; ?>
							<?php if ( $title && $sec_title ) echo '<br>'; ?>
							<?php echo $sec_title; ?>
						</p>
	
						<?php the_post_thumbnail('attorney-thumb', array( 'class' => 'alignleft png-bg' ) ); ?>
					</a>
				</article>

			<?php // endwhile; ?>
			<?php endforeach; ?>
		</section>

	</main>
</div>
		
<?php get_footer(); ?>