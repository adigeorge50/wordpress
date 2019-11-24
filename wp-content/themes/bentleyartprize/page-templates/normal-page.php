<?php
/**
 * Template Name: Normal
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
<div class="page-content">
	<div class="page-container">
		<?php the_field('page_content'); ?>
	</div>
</div>
<?php
		}
	}
?>
<?php get_footer(); ?>