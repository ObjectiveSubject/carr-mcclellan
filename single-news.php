<?php
	get_header();
	$custom = get_post_custom($post->ID);
	$summary = $custom["summary"][0];
	$date = $custom["date"][0];
	$source = $custom["source"][0];
	$source_url = $custom["source_url"][0];
	$attachments = attachments_get_attachments();
	$pdf = $attachments[0]['location'];
?>
<body>
	<div id="wrapper">
		<div class="w1">
			<div class="w2">
				<?php include('sidebar.php'); ?>
				<div class="container">
					<header id="header" class="header-4">
						<div class="panel">
							<ul class="breadcrumbs">
								<a href="<?php bloginfo('url');?>">Home</a> ·
								<a href="<?= get_permalink('32'); ?>">News & Events</a> ·
								<a href="<?= get_permalink('41'); ?>">In The News</a>
							</ul>
							<span class="addthis link-share">Share</span>
						</div>
						<h1>In The News</h1>
					</header>
					<div id="main">
						<section id="content">
							<header class="article-head" style="margin-top:20px;margin-bottom:0px;">
								<div class="article-title" style="font-weight:normal;">
									<?php
										$fix_date = explode('/', $date);
										$fix_date = $fix_date[2] . '-' . $fix_date[1] . '-20' . $fix_date[0];
										$fix_date = date('M. j, Y', strtotime($fix_date));
										echo ($fix_date) ? $fix_date : '';
										if($date && $source){
											echo ' | ';
											if($source_url){
												echo 'Source: <a href="' . $source_url . '">' . $source . '</a>';
											} else {
												echo 'Source: ' . $source;
											}
										}
									?>
								</div>
								<div>
									<?php if($pdf) : ?><a href="<?=$pdf;?>" class="link pdf">PDF Version</a><?php endif; ?>
								</div>
								<div class="clear"></div>
							</header>
							<div class="content-holder block-3">
							<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail('news-medium', array('class' => 'alignright news-image'));
							}
							?>
							<h3 style="margin-bottom:30px;"><?php the_title();?></h3>
							<?php echo $summary; ?>
							</div>
						</section>
					</div>
					<?php include('pre-footer.php'); ?>
				</div>
			</div>
		</div>
<?php get_footer(); ?>