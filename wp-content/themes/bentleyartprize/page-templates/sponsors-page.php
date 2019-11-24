<?php
/**
 * Template Name: Sponsors
 */
global $post;
get_header(); ?>
<?php
	if( have_posts() ){
		while( have_posts() ){
			the_post();
?>
<div class="page-title">
	<h1><?php the_title(); ?></h1>
</div>
<div class="page-blue-content">
	<div class="container">
		<h2><?php the_field('sponsors_page_title'); ?></h2>
	</div>
</div>
<div class="page-sponsors blue-gradient">
	<div class="container">
		<div class="page-sponsors-title">
			<h2>Major Sponsors</h2>
		</div>
		<div class="page-sponsors-list">
			<?php
				if(have_rows('major_sponsors')){

					while(have_rows('major_sponsors')){
						the_row();

						$sponsor = get_sub_field('sponsor');
			?>
			<div class="page-sponsor-1">
				<img src="<?php echo $sponsor; ?>" />
			</div>
			<?php
					}
				}
			?>
		</div>
	</div>
</div>
<div class="page-sponsors">
	<div class="container">
		<div class="page-sponsors-title">
			<h2>Minor Sponsors</h2>
		</div>
		<div class="page-sponsors-list">
			<?php
				if(have_rows('minor_sponsors')){

					while(have_rows('minor_sponsors')){
						the_row();

						$sponsor = get_sub_field('sponsor');
			?>
			<div class="page-sponsor-2">
				<img src="<?php echo $sponsor; ?>" />
			</div>
			<?php
					}
				}
			?>
		</div>
	</div>
</div>
<?php
		}
	}
?>
<?php get_footer(); ?>