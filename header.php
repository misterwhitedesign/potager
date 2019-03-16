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
		</div>
		<nav id="site-navigation" class="main-navigation">
			<?php
			$menu = wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
			) );
			$menu_src = get_field('hamburger', 'menu-1');
			?>
			<button class="menu-toggle"
							aria-controls="primary-menu" aria-expanded="false"
							style="background: url(<?php echo $menu_src ?>)"></button>
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
		$src = resize_and_keepratio($src, array(700,700), array(700,700));
		$dims = getimagesize($src);
		$bgsize = ($dims[0] * 800 / $dims[1]) < 500 ? "31.25rem auto" : "auto 100vh";
		?>
		<style>
		.leftcolumn {
  		background-image: url('<?php echo $src?>');
			background-size: <?php echo $bgsize?>;
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
					echo $post->post_content;
			endif; ?>
		</div>
		<div class="rightcolumn">
			<?php
			if (is_front_page()) {
				the_title( '<h1 class="home-title">', '</h1>' );
			}
			?>
