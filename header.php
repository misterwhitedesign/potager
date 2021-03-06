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
	<link href="//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.css" type="text/css" rel="stylesheet" />
	<link href="//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.gallery.min.css" type="text/css" rel="stylesheet" />

	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header id="masthead" class="site-header">
		<div class="site-branding">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link" rel="home" itemprop="url">
				<img src="<?php echo esc_url( get_logo_url() ); ?>" class="custom-logo" alt="potager" itemprop="logo">
			</a>
		</div>
		<nav id="site-navigation" class="main-navigation">
			<?php
			$menu = wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
			) );
			?>
			<button class="menu-toggle"
							aria-controls="primary-menu"
							aria-expanded="false">
			</button>
		</nav>
	</header>
	<div class="scroll">
<?php
  $background_image = '';
	if ($post && ! is_home() && ! is_front_page()) {
		$post_id = get_post_thumbnail_id( $post );
	  $src = get_field('image_principale')['url'];
		if (!$src) {
			$src = wp_get_attachment_image_src($post_id)[0];
		}
		$dims = getimagesize($src);
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
	<?php
		if ($post && ! is_home() && ! is_front_page()) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		}
	?>
	<div class="two-columns">
		<div class="leftcolumn">
			<?php
			if (is_front_page()) :
			?><div class="entry-content">
			<?php		echo $post->post_content; ?>
			</div>
			<?php
			elseif ( $post->post_type != 'projet'):
				include 'galleries/gallerie-page.php';
			endif; ?>
		</div>
		<div class="rightcolumn">
			<?php
			if (is_front_page()) {
				the_title( '<h1 class="home-title">', '</h1>' );
			}
			?>
