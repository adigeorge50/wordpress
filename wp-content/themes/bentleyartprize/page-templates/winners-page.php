<?php
/**
 * Template Name: Winners
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
<div class="winners-section">
	<div class="container">
		<div class="winners-list">
			<?php
				if(have_rows('winners')){

					while(have_rows('winners')){
						the_row();
			?>
			<div class="winner-item">
				<div class="winner-profile">
					<img src="<?php echo the_sub_field('profile_image'); ?>" />
				</div>
				<div class="winner-name">
					<h2><?php echo the_sub_field('name'); ?></h2>
				</div>
				<div class="winner-year">
					<h3><?php echo the_sub_field('year'); ?> WINNER</h3>
				</div>
				<div class="winner-team">
					<span><span><?php echo the_sub_field('team'); ?></span></span>
				</div>
				<div class="winner-content">
					<p><?php echo the_sub_field('content'); ?></p>
				</div>
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