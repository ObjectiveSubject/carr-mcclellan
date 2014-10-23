<?php
	get_header();

	$custom = get_post_custom($post->ID);
	$tagline = $custom["tagline"][0];
	$description = $custom["description"][0];
	$attorney_title = ($custom["attorney_title"][0]) ? $custom["attorney_title"][0] : 'Practice Contact';
	$chair_id = $custom["chair_id"][0];
	$attorney_title_2 = $custom["attorney_title_2"][0];
	$chair_id_2 = $custom["chair_id_2"][0];
	$rep_matters = $custom["rep_matters"][0];
	$this_post = $post->ID;
	$areas_focus = get_post_meta($post->ID, 'areas_focus', true);
	$practices_attorneys = get_post_meta($post->ID, 'practices_attorneys', true);

	if($chair_id_2) {$attorney_title = $attorney_title . 's';}
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
			$practices = new WP_Query(array(
				'post_type' => 'practices',
				'orderby' => 'title',
				'order' => 'ASC',
				'posts_per_page' => 100
			));

			while ( $practices->have_posts() ) : $practices->the_post();
				?>
				<ul>
					<li class="<?php echo $post->post_name; ?>"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
				</ul>

			<?php endwhile; ?>
		</div>
	</aside>

	<section class="span6 push-left">

		<article class="block-2 practice-content">
			<?php echo ($tagline) ? '<h2>' . $tagline . '</h2>' : ''; ?>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
			<?php endwhile; ?>
			<?php endif; ?>
		</article>
	</section>

	<aside class="aside aside-right">
		<div class="border-block top">

		<?php if($chair_id && get_post($chair_id) ) :?>
			<h3 class="block-label"><?php echo $attorney_title;?></h3>
			<div class="block-person">
			<?php
				// Get Attorney by Id
				$practice_chair = get_post_meta($chair_id);
				$chair_name = $practice_chair['first_name'][0] . ' ';
				$chair_name .= $practice_chair['middle_initial'][0] . ' ';
				$chair_name .= $practice_chair['last_name'][0];
				$chair_phone = $practice_chair['phone'][0];
				$chair_email = $practice_chair['email'][0];

				// Get Attorney URL
				$get_chair = get_post($chair_id);
				$chair_url = $get_chair->guid;
			?>
			<div class="holder">
				<a href="<?php echo get_permalink($chair_id); ?>"><?php echo $chair_name;?></a>
				<p>
					P: <?php echo $chair_phone;?>
				</p>
				<ul class="links">
					<?php if($chair_email) : ?>
					<li class="link-mail"><a href="mailto:<?php echo $chair_email;?>">Email</a></li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
		<?php endif; ?>
		<?php if($chair_id_2 && get_post($chair_id_2) ) : ?>
			<div class="block-person" style="margin-top: 10px;">
			<?php
				// Secondary Practice Contact

				// Get Attorney by Id
				$practice_chair = get_post_meta($chair_id_2);
				$chair_name = $practice_chair['first_name'][0] . ' ';
				$chair_name .= $practice_chair['middle_initial'][0] . ' ';
				$chair_name .= $practice_chair['last_name'][0];
				$chair_phone = $practice_chair['phone'][0];
				$chair_email = $practice_chair['email'][0];

				// Get Attorney URL
				$get_chair = get_post($chair_id_2);
				$chair_url = $get_chair->guid;
			?>
			<div class="holder">
				<a href="<?php echo get_permalink($chair_id_2); ?>"><?php echo $chair_name;?></a>
				<dl>
					<dt>P: </dt>
					<dd><?php echo $chair_phone;?></dd>
				</dl>
				<ul class="links">
					<?php if($chair_email) : ?>
					<li class="link-mail"><a href="mailto:<?php echo $chair_email;?>">Email</a></li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
		<?php endif; ?>

		<h3 class="block-label">Practicing Attorneys</h3>
		<ul class="list list-2">
			<?php
				// Get current page title, and remove special characters
				$current_practice = get_the_title();
				$current_practice = str_replace(',','', $current_practice);
				$current_practice = str_replace('&','', $current_practice);


				// Get all Attorneys
				$loop = new WP_Query(array(
						'post_type' => 'attorneys',
						'meta_key' => 'last_name',
						'orderby' => 'meta_value',
						'order' => 'ASC',
						'posts_per_page' => 1000
					));
				while ( $loop->have_posts() ) : $loop->the_post();
					$custom = get_post_custom($post->ID);
					$name = $custom["first_name"][0].' ';
					$name .= $custom["middle_initial"][0] . ' ';
					$name .= $custom["last_name"][0];

					$areas_practice = get_post_meta($post->ID, 'areas_practice', true);

					// Only show Attorneys where areas of practice match current page
					if(
						( is_array($areas_practice) && in_array($current_practice, $areas_practice) ) ||
						( is_array($practices_attorneys) && in_array($post->ID, $practices_attorneys) )
					) :

			?>

				<li>
					<a href="<?php the_permalink() ?>"><?php echo $name;?></a><br />
				</li>

			<?php
					endif;
				endwhile;
			?>
		</ul>

		</div>
	</aside>

	<section class="">

		<?php if($areas_focus[0]['title']) : ?>
			<div class="span6">
				<h2>AREAS OF FOCUS</h2>
				<ul class="list-content accordion">

					<?php foreach($areas_focus as $area) : if($area['title']) : ?>
						<li>
							<a href="#" class="opener"><?php echo $area['title'];?></a>
							<article class="slide">
								<?php echo $area['description'];?>
							</article>
						</li>
					<?php endif; endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>

		<?php $ii = 0; ?>


		<?php if($rep_matters) : $ii++;?>
			<h3 class="span3 push-left">Representative Matters</h3>
			<article class="span6 push-left">
				<?php echo $rep_matters;?>
			</article>
		<?php endif; ?>

		<h3 class="span3 push-left">Publications</h3>
		<article class="span6 push-left">

			<?php
				$loop = new WP_Query(array(
						'post_type' => 'publications',
						'orderby' => 'date',
						'order' => 'DESC',
						'posts_per_page' => 100
					));
				$i = 0;
				while ( $loop->have_posts() ) : $loop->the_post();
					$custom = get_post_custom($post->ID);
					$pub_summary = $custom["pub_summary"][0];
					$type = wp_get_post_terms($post->ID, 'publications');
					$type = $type[0]->name;
					$date = get_the_date('m/d/y');

					$pub_summary = strip_tags($pub_summary);
					if(strlen($pub_summary) > 350){
						$pub_summary = preg_replace('/\s+?(\S+)?$/', '', substr($pub_summary, 0, 350));
						$pub_summary .= '…';
					}
					$pub_practices = get_post_meta($post->ID, 'pub_practices', true);

				if( is_array($pub_practices) && in_array($this_post, $pub_practices)) :
			?>

				<?php echo $date;?><br />
				<a href="<?php the_permalink(); ?>"><?php the_title();?></a><br /><br />


			<?php
				$i++;
				$ii++;
				endif;
				endwhile;
				if($i == 0) :
			?>

			<?php endif; ?>

		</article>


		<?php
			$loop = new WP_Query(array(
				'post_type' => 'events',
				'meta_key' => 'date',
				'orderby' => 'meta_value',
				'order' => 'ASC',
				'posts_per_page' => 100
			));
			$i = 0;

			if ( $loop->have_posts() ) :
		?>
		<h3 class="span3 push-left">Events</h3>
		<article class="span6 push-left">

		<?php
			while ( $loop->have_posts() ) : $loop->the_post();
				$custom = get_post_custom($post->ID);
				$today = date('y/m/d');

				$date = $custom["date"][0];
				$fix_date = explode('/', $date);
				$fix_date = $fix_date[2] . '-' . $fix_date[1] . '-20' . $fix_date[0];
				$fix_date = date('M. j, Y', strtotime($fix_date));

				$time = $custom["time"][0];
				$location = $custom["location"][0];
				$description = $custom["description"][0];
				$rsvp = $custom["rsvp"][0];
				$wufoo = get_post_meta($post->ID, 'wufoo', true);

				$event_practices = get_post_meta($post->ID, 'event_practices', true);


				if( ( is_array($event_practices) && in_array($this_post, $event_practices) ) && $date >= $today) :
			?>

				<strong><?php the_title();?></strong><br />
				<?php echo $fix_date;?><br /><br />
				<?php if (has_post_thumbnail()):?>
					<div class="thumbnail"><?php the_post_thumbnail('event-large');?></div><br>
				<?php endif; ?>
				<p><?php echo $description;?></p>
				<?php if( !empty($wufoo) ) : ?>
					<a href="#wufoo-popup-<?php echo $post->ID; ?>" class="wufoo-reister open-popup-link">EVENT REGISTRATION</a>
					<div id="wufoo-popup-<?php echo $post->ID; ?>" class="white-popup mfp-hide">
						<?php echo do_shortcode( $wufoo ); ?>
					</div>
				<?php endif; ?>
				<br /><br />

			<?php
				$i++;
				$ii++;
				endif;
				endwhile;
				if($i == 0) :
			?>
				<script type="text/javascript">
					$(function(){
						$('.li-events').remove();
					});
				</script>
			<?php
				endif;
			?>
		</article>
		<?php endif; ?>

		<h3 class="span3 push-left">News</h3>
		<article class="span6 push-left">


		<?php
			$loop = new WP_Query(array(
					'post_type' => 'news',
					'meta_key' => 'date',
					'orderby' => 'meta_value',
					'order' => 'DESC',
					'posts_per_page' => 100
				));
			$i = 0;
			while ( $loop->have_posts() ) : $loop->the_post();
				$custom = get_post_custom($post->ID);
				$date = $custom["date"][0];
				$fix_date = explode('/', $date);
				$fix_date = $fix_date[1] . '/' . $fix_date[2] . '/' . $fix_date[0];
				$source = $custom["source"][0];
				$source_url = $custom["source_url"][0];
				$news_practices = get_post_meta($post->ID, 'news_practices', true);

				$news_type_select = $custom["news_type_select"][0];
				$link_target = ($news_type_select == 'external' || $news_type_select == 'pdf') ? 'target="_blank"' : '';
				if($news_type_select == 'internal'){
					$source_url = get_permalink();
				}
				$attachments = attachments_get_attachments();
				$pdf = $attachments[0]['location'];
				if($pdf){
					$source_url = $pdf;
				}

			if(in_array($this_post, $news_practices)) :
		?>

			<?php echo $fix_date;?> | Source: <?php echo $source;?><br />
			<a href="<?php echo $source_url;?>" <?php echo $link_target;?>><?php the_title();?></a>


			<?php if($news_type_select == 'external') : ?>
				<img src="<?php bloginfo('template_url');?>/images/external-icon.png" width="10" height="10" alt="External Icon">
			<?php elseif($news_type_select == 'pdf' || $pdf) :?>
				<img src="<?php bloginfo('template_url');?>/images/tiny-pdf.png" width="10" height="10" alt="External Icon">
			<?php endif; ?>
			<br /><br />


		<?php
			$i++;
			$ii++;
			endif;
			endwhile;
			if($i == 0) :
		?>
			<script type="text/javascript">
				$(function(){
					$('.li-news').remove();
				});
			</script>
		<?php
			endif;
		?>

	</article>

		<h3 class="span3 push-left">Blog Posts</h3>
		<article class="span6 push-left">
			<?php
				$loop = new WP_Query(array(
						'post_type' => 'post',
						'orderby' => 'date',
						'order' => 'DESC',
						'posts_per_page' => 100
					));
				$i = 0;
				while ( $loop->have_posts() ) :
					$loop->the_post();
					$post_practices = get_post_meta($post->ID, 'post_practices', true);

				if(is_array($post_practices) && in_array($this_post, $post_practices)) :
			?>

				<?php the_time('m/d/y');?><br />
				<a href="<?php the_permalink();?>"><?php the_title();?></a><br /><br />



			<?php
				$i++;
				$ii++;
				endif;
				endwhile;
				if($i == 0) :
					$related_count++;
			?>

			<?php
				endif;
			?>
		</article>

	</section>

<?php get_footer();