<?php
/**
 * Template Name: Home
 */
global $post;
get_header(); ?>
<?php
	if( have_posts() ){
		while( have_posts() ){
			the_post();
?>
<div class="home-hero">
	<div class="container">
		<div class="home-hero-content">
			<?php echo get_field('home_page_hero_content'); ?>
			<a class="home-hero-btn" href="<?php the_field('home_page_hero_enter_now_button_link'); ?>">ENTER NOW</a>
		</div>
		<div class="home-hero-image">
			<div class="home-hero-image-mask">
				<img src="<?php echo get_template_directory_uri(); ?>/images/winner_mask.svg" alt="">
			</div>
			<div class="home-hero-image-painer">
				<img src="<?php echo get_template_directory_uri(); ?>/images/women_painting.svg" alt="">
			</div>
		</div>
	</div>
</div>
<div class="home-sponsor">
	<div class="container">
		<div class="home-sponsor-row">
			<?php
				if(have_rows('home_page_sponsors')){

					while(have_rows('home_page_sponsors')){
						the_row();

						$sponsor = get_sub_field('sponsor');
			?>
			<div class="home-sponsor-item">
				<img src="<?php echo $sponsor; ?>" />
			</div>
			<?php
					}
				}
			?>
		</div>
	</div>
</div>
<div class="home-video">
	<div class="home-video-inner">
		<div class="home-video-image">
			<img src="<?php the_field('homepage_video_image'); ?>" />
		</div>
		<div class="home-video-content">
			<?php the_field('homepage_video_content'); ?>
		</div>
	</div>
</div>
<div class="home-welcome">
	<div class="container">
		<div class="home-welcome-row">
			<div class="home-welcome-content">
				<?php the_field('home_page_welcome_content'); ?>
				<div class="home-welcome-btn">
					<a href="<?php the_field('home_page_welcome_button_link'); ?>">READ MORE</a>
				</div>
			</div>
			<div class="home-welcome-image">
				<img src="<?php the_field('home_page_welcome_image_1'); ?>">
				<div class="home-welcome-image-2">
					<img src="<?php the_field('home_page_welcome_image_2'); ?>">
				</div>
			</div>
		</div>
	</div>
</div>
<div class="home-winner">
	<div class="container">
		<div class="home-winner-title">
			<img src="<?php echo get_template_directory_uri(); ?>/images/winner_title.png" />
		</div>
		<div class="home-winner-row">
			<?php
				if(have_rows('home_page_winners')){

					while(have_rows('home_page_winners')){
						the_row();

						$winner = get_sub_field('winner');
			?>
			<div class="home-winner-item">
				<img src="<?php echo $winner; ?>" />
			</div>
			<?php
					}
				}
			?>
		</div>
		<div class="home-winner-btn">
			<a href="<?php the_field('home_page_winner_button_link'); ?>">ALL WINNERS</a>
		</div>
	</div>
</div>
<?php
		}
	}
?>
<div class="home-testimonial">
	<div class="container">
		<div class="home-testimonial-title">
			<h2>TESTIMONIALS</h2>
		</div>
		<div class="home-testimonial-slider">
			<div class="home-testimonial-slider-wrapper">
				<div class="home-testimonial-slider-arrow">
					<div class="home-testimonial-slider-prev"></div>
					<div class="home-testimonial-slider-next"></div>
				</div>
				<div class="home-testimonial-slider-inner">
					<?php
						$args = array(
							'post_type' => 'testimonial',
							'orderby' => 'date',
							'order' => 'DESC',
							'posts_per_page' => '5'
						);

						$the_query = new WP_Query( $args );
		 
						if ( $the_query->have_posts() ) {
						    while ( $the_query->have_posts() ) {
						        $the_query->the_post();
					?>
					<div class="home-testimonial-slider-item">
						<div class="home-testimonial-slider-item-content">
							<?php the_content() ?>
						</div>
						<div class="home-testimonial-slider-item-author">
							<h2><?php the_title() ?></h2>
							<h3>
								<?php
									$testimonial_category_list = get_the_terms($post->ID, 'testimonial_category');

									foreach($testimonial_category_list as $key => $item){
										if( $key > 0 ){
											echo ', ';
										}

										echo $item->name;
									}
								?>
							</h3>
						</div>
					</div>
					<?php
						    }
						}

						wp_reset_postdata();
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="home-gallery">
	<div class="home-gallery-title">
		<h2>GALLERY</h2>
	</div>
	<div class="home-gallery-wrapper">
		<div class="gallery-sizer"></div>
		<?php
			$gallery = get_field('home_page_gallery', $post->ID);

			foreach($gallery as $key => $item){
		?>
			<div class="gallery gallery-<?php echo $key + 1; ?>" style="background-image:url(<?php echo $item['url']; ?>)"></div>
		<?php
			}
		?>
	</div>
</div>
<?php get_footer(); ?>