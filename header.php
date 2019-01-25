<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package potager
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="scroll">
<?php
  $background_image = '';
	if ($post) {
		$post_id = get_post_thumbnail_id( $post );
	  $src = get_field('image_principale')['url'];
		if (!$src) {
			$src = wp_get_attachment_image_src($post_id)[0];
		}
		?>
		<style>
		#page:before {
  		filter:grayscale(1);
  		content: "";
  		position: fixed;
  		left: 0;
  		right: 0;
  		z-index: -1;
  		display: block;
  		background-image: url('<?php echo $src?>');
  		height: 100vh;
  		width:auto;
			background-repeat: no-repeat;
			background-size: auto 100vh;
			background-position:left top;
			clip-path: polygon(0 0, 300px 0, 300px 100%, 0 100%);
		}
		</style>
		<?php
	}
?>
<div id="page" class="site">
	<header id="masthead" class="site-header">
		<div class="site-branding">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link" rel="home" itemprop="url">
				<img src="<?php echo esc_url( get_logo_url() ); ?>" class="custom-logo" alt="potager" itemprop="logo">
			</a>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'potager' ); ?></button>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
			) );
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
