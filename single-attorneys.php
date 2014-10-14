<?php
	get_header();

	$custom = get_post_custom($post->ID);
	$name = $custom["first_name"][0] . ' ';
	$name .= ($custom["middle_initial"][0]) ? $custom["middle_initial"][0] . ' ' : '';
	$name .= $custom["last_name"][0];
	$title = $custom["title"][0];
	$sec_title = $custom["secondary_title"][0];
	$phone = $custom["phone"][0];
	$fax = $custom["fax"][0];
	$email = $custom["email"][0];
	$linkedin = $custom["linkedin"][0];
	$biography = $custom["biography"][0];
	$title = $custom["title"][0];

	$attachments = attachments_get_attachments();
	$pdf = $attachments[0]['location'];

	$quote = $custom["quote"][0];
	$academic_creds = $custom["academic_creds"][0];
	$attorney_languages = $custom["attorney_languages"][0];
	$special_exp = $custom["special_exp"][0];
	$prof_affilations = $custom["prof_affilations"][0];
	$courts_forums = $custom["courts_forums"][0];
	$civic_affiliations = $custom["civic_affiliations"][0];
	$honors_awards = $custom["honors_awards"][0];
	$custom_title = $custom["custom_title"][0];
	$custom_body = $custom["custom_body"][0];
	$recent_exp = $custom["recent_exp"][0];
	$recent_speaking = $custom["recent_speaking"][0];

	$this_post = $post->ID;

	$areas_practice = get_post_meta($post->ID, 'areas_practice', 'single');
	$areas_related_practice = get_post_meta($post->ID, 'areas_related_practice', 'single');


	$v_card = get_bloginfo('template_url') . '/functions/v_card.php?';
	$v_card .= 'f_name=' . $custom["first_name"][0];
	$v_card .= '&l_name=' . $custom["last_name"][0];
	$v_card .= '&m_name=' . $custom["middle_initial"][0];
	$v_card .= '&company=Carr, McClellan, Ingersoll, Thompson &amp; Horn';
	$v_card .= '&title=' . $custom["title"][0];
	$v_card .= '&address=216 Park Road';
	$v_card .= '&city=Burlingame';
	$v_card .= '&state=CA';
	$v_card .= '&postal=94010';
	$v_card .= ($custom["phone"][0]) ? '&phone=' . $custom["phone"][0] : '&phone=(650) 342-9600 ';
	$v_card .= ($custom["fax"][0]) ? '&fax=' . $custom["fax"][0] : '&fax=(650) 342-7685';
	$v_card .= '&email=' . $custom["email"][0];
	$v_card .= '&url=' . get_permalink();
?>

	<div id="primary" class="content-area terminal-page">

		<?php while ( have_posts() ) : the_post(); ?>

		<header class="page-header">
			<div class="span12 aligncenter">
				<h1 class="page-title"><?php the_title(); ?></h1>
				<? if ($title) : ?>
				<div class="entry-meta">
					<strong class="meta-title font-heading caps"><?php echo $title; ?></strong>
				</div><!-- .entry-meta -->
				<? endif; ?>
				<? the_post_thumbnail('full', array('class' => 'attorney-pic')); ?>
			</div>
		</header><!-- .entry-header -->

		<main id="main" class="site-main span12 aligncenter clear" role="main">

				<aside class="aside aside-left span2 push-left">

					<div class="border-block top contact-info">
						<h3 class="block-label phone">Phone</h3>
						<ul>
							<li><? echo $phone; ?></li>
						</ul>
						<h3 class="block-label fax">Fax</h3>
						<ul>
							<li><? echo $fax; ?></li>
						</ul>
						<h3 class="block-label email">Email</h3>
						<ul>
							<li><a href="mailto:<? echo $email; ?>" target="_blank" class="link-gray3"><? echo $email; ?></a></li>
						</ul>
						<h3 class="block-label vcard"><a href="<? echo $v_card; ?>" class="link-gray3"><span class="small icon-download"></span>&nbsp;&nbsp;Download vCard</a></h3>
						<h3 class="block-label print"><a href="#" class="link-gray3"><span class="icon-print"></span>&nbsp;&nbsp;Print Profile</a></h3>
					</div>

				</aside>


				<article id="post-<?php the_ID(); ?>" <?php post_class('span9 push-left'); ?>>

					<div class="entry-content">
						<?php echo $biography; ?>
					</div><!-- .entry-content -->

				</article><!-- #post-## -->


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
					
		</main><!-- #main -->

		<?php endwhile; // end of the loop. ?>

	</div><!-- #primary -->

<?php get_footer(); ?>