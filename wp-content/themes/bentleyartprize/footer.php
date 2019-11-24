<?php
	global $post;

	$template = get_page_template_slug($post);

	if( $template != 'page-templates/contact-page.php' && $template != 'page-templates/entry-form-page.php' ){
?>
<div class="your-chance">
	<div class="container">
		<div class="your-chance-inner">
			<div class="your-chance-content">
				<h2><?php the_field( 'footer_chance_title', 'option'); ?></h2>
				<h3><?php the_field( 'footer_chance_content', 'option'); ?></h3>
			</div>
			<div class="your-chance-button">
				<a href="#">ENTER NOW</a>
			</div>
		</div>
	</div>
</div>
<?php
	}
?>
<footer>
	<div class="container">
		<div class="footer-row">
			<div class="footer-info-col">
				<h2><?php the_field( 'footer_title', 'option'); ?></h2>
				<ul>
					<li><a href="<?php the_field( 'facebook_url', 'option'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png" alt="facebook"></a></li>
					<li><a href="<?php the_field( 'twitter_url', 'option'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" alt="twitter"></a></li>
					<li><a href="<?php the_field( 'instagram_url', 'option'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/instagram.png" alt="instagram"></a></li>
				</ul>
			</div>
			<div class="footer-nav-col">
				<?php
					wp_nav_menu(
						array(
							'container'  => 'nav',
							'container_class' => 'header-menu',
							'theme_location'  => 'footer_menu_1',
						)
					);
				?>
			</div>
			<div class="footer-nav-col">
				<?php
					wp_nav_menu(
						array(
							'container'  => 'nav',
							'container_class' => 'header-menu',
							'theme_location'  => 'footer_menu_2',
						)
					);
				?>
			</div>
		</div>
		<div class="footer-copyright">
			<p><?php the_field( 'footer_copyright', 'option'); ?></p>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
