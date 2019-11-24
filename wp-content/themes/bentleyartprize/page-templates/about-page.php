<?php
/**
 * Template Name: About
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
<div class="about-gradient-content">
	<div class="container">
		<?php the_field('blue_gradient_cotnet'); ?>
	</div>
</div>
<div class="about-content">
	<div class="about-container">
		<?php the_field('normal_content'); ?>
	</div>
</div>
<div class="page-blue-content mgb-120">
	<div class="container">
		<h2><?php the_field('blue_background_text'); ?></h2>
	</div>
</div>
<?php
		}
	}
?>
<?php get_footer(); ?>