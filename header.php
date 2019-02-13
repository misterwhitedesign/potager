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
	<div class="scroll">
<?php
  $background_image = '';
	if ($post) {
		$post_id = get_post_thumbnail_id( $post );
	  $src = get_field('image_principale')['url'];
		if (!$src) {
			$src = wp_get_attachment_image_src($post_id)[0];
		}
		$src = resize_and_keepratio($src, array(700,700), array(700,700));
		?>
		<style>
		.leftcolumn {
  		background-image: url('<?php echo $src?>');
		}
		</style>
		<?php
	}
?>
<div class="firstpage">
	<div class="leftcolumn">
		<?php
		if (is_front_page()) :
				echo $post->post_content;
		endif; ?>
	</div>
<div id="page" class="site">
	<div id="content" class="site-content">
