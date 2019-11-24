<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title>
<?php
	global $page, $paged;

	wp_title( '|', true, 'right' );

	bloginfo( 'name' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		echo " | $site_description";
	}

	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		echo esc_html( ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) ) );
	}
?>
</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
<link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
<?php
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_head();
?>
</head>

<body <?php body_class(); ?>>
<?php
	if( is_home() || is_front_page() ){
?>
	<div class="home-header-mask"></div>
<?php
	}
?>
	<header class="<?php echo (is_home() || is_front_page()) ? '' : 'header-normal'; ?>">
		<div class="container">
			<div class="logo">
				<a href="<?php echo site_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="logo" /></a>
			</div>
			<div class="header-right">
				<?php
					wp_nav_menu(
						array(
							'container'  => 'nav',
							'container_class' => 'header-menu',
							'theme_location'  => 'primary',
						)
					);
				?>
				<div class="header-enter-now">
					<a class="header-enter-now-btn" href="<?php echo site_url(); ?>/entry-form">ENTER NOW</a>
				</div>
			</div>
		</div>
	</header>