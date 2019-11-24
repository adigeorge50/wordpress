<?php
/**
 * Template Name: Contact
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
<div class="contact-page">
	<div class="container">
		<div class="contact-page-row">
			<div class="contact-content">
				<?php the_field('contact_content'); ?>
			</div>
			<div class="contact-form">
				<?php echo apply_filters('the_content', get_field('contact_shortcode')); ?>
			</div>
		</div>
	</div>
</div>
<?php
		}
	}
?>
<?php get_footer(); ?>