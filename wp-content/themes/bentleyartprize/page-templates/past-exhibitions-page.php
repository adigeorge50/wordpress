<?php
/**
 * Template Name: Past Exhibitions
 */
global $post;
get_header(); ?>
<?php
	if( have_posts() ){
		while( have_posts() ){
			the_post();
		}
	}
?>
<div class="page-title">
	<h1><?php echo $post->post_title; ?></h1>
</div>
<?php
	$exhibitions = array();

	if(have_rows('exhibitions', $post->ID)){
		while(have_rows('exhibitions', $post->ID)){
			the_row();

			$exhibitions[] = get_sub_field('exhibition');
		}
	}

	foreach($exhibitions as $exhibition){
?>
<div class="exhibition">
	<div class="container">
		<div class="exhibition-title">
			<h2><?php echo $exhibition->post_title; ?></h2>
		</div>
		<div class="exhibition-list">
			<?php
				if(have_rows('gallery', $exhibition->ID)){
					while(have_rows('gallery', $exhibition->ID)){
						the_row();

						$image = get_sub_field('image');
			?>
			<div class="exhibition-item">
				<img src="<?php echo $image['sizes']['gallery-square-thumb']; ?>" />
				<h2><?php the_sub_field('title'); ?></h2>
				<p><?php the_sub_field('caption'); ?></p>
			</div>
			<?php
					}
				}
			?>
		</div>
		<div class="exhibition-winners">
			<a href="<?php the_field('winner_pdf_file', $exhibition->ID); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/pdf_download.jpg" /></a>
		</div>
		<div class="exhibition-winners-content">
			<h3><?php the_field('winner_pdf_download_description_title', $exhibition->ID); ?></h3>
			<p><?php the_field('winner_pdf_download_description_content', $exhibition->ID); ?></p>
		</div>
	</div>
</div>
<?php
	}
?>
<?php get_footer(); ?>