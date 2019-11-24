<?php
/**
 * Template Name: Entry Form
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
<div class="entry-form-page">
	<div class="container">
		<?php echo apply_filters('the_content', get_field('entry_form_shortcode')); ?>
	</div>
</div>
<?php
		}
	}
?>
<?php get_footer(); ?>