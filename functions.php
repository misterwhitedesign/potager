<?php
/**
 * potager functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package potager
 */

if ( ! function_exists( 'potager_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function potager_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on potager, use a find and replace
		 * to change 'potager' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'potager', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'potager' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'potager_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'potager_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function potager_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'potager_content_width', 640 );
}
add_action( 'after_setup_theme', 'potager_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function potager_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'potager' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'potager' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'potager_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function potager_scripts() {
	/**
	 * add wp-less plugin
	 **/
	require dirname(__FILE__) . '/vendor/wp-less/bootstrap-for-theme.php';
	$less = WPLessPlugin::getInstance();
	$less->dispatch();

	wp_enqueue_style( 'potager-style', get_template_directory_uri() . '/layouts/potager.less' );

	wp_enqueue_script( 'potager-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'potager-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'potager_scripts' );

/**
 * retrieves logo url
 **/
 function get_logo_url() {
	 $custom_logo_id = get_theme_mod( 'custom_logo' );
	 $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
	 return $image[0];
 }


function get_max_dimension($images, $idx){
		$dims = array_map(function($image) use ($idx) {
			$sizes = getimagesize($image['full_image_url']);
		  return $sizes[$idx];
		}, $images);
		return max($dims);
}
/**
 * get maximum ratios out of a set of images
 */
 function get_max_dimensions($images) {
	return array(get_max_dimension($images, 0), get_max_dimension($images, 1));
 }

 function get_ratio($dim, $req, $max) {
	 $ratio = 1;
	 error_log($dim.' '.$req.' '.$max);
	 if ($dim > $req) {
		 $ratio = $req / $max;
	 }
	 return $ratio;
 }

 /**
  * get class suffix depending on a given string
	**/
 function get_figure_size_class($some_string) {
	 	$r = strlen($some_string) % 3;
		$class = array("small","mid","big")[$r];
		return $class;
 }

 /**
 * get resized image based on max ratios (see above)
 */
 function resize_and_keepratio($image, $max_dimensions, $req_dimensions) {
		$dimensions = getimagesize($image);
		$dim_index = $dimensions[0] > $dimensions[1] ? 0 : 1;
		$ratio = get_ratio($dimensions[$dim_index], $req_dimensions[$dim_index], $max_dimensions[$dim_index]);
		return acf_photo_gallery_resize_image($image, $dimensions[0] * $ratio, $dimensions[1] * $ratio);
 }

 function projet_module() {
	 $args = array(
		 'label' => __('Projets'),
		 'singular_label' => __('Projet'),
		 'public' => true,
		 'show_ui' => true,
		 '_builtin' => false,
		 '_edit_link' => 'post.php?post=%d',
		 'capability_type' => 'post',
		 'rewrite' => array("slug" => "projets"),
		 'query_var' => "projets",
		 'supports' => array('title', 'editor', 'thumbnail'),
		 'taxonomies' => array( 'category' ),
	 );
	 register_post_type( 'projet' , $args );
	 register_taxonomy_for_object_type('post_tag', 'projet','show_tagcloud=1&hierarchical=true');
//add_action("admin_init", "admin_init"); function pour ajouter des champs personnalisés
//add_action('save_post', 'save_custom'); function pour la sauvegarde de nos champs personnalisés
}

add_action('init', 'projet_module');
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
