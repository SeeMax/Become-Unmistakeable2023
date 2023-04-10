<?php

//////////////  SEEMAXWORK  /////////////////
////////// GENERAL WORDPRESS FIXES /////////
///////////////////////////////////////////

// Add basic theme support
function seemax_setup() {
  add_editor_style();
  add_theme_support('automatic-feed-links');
  add_theme_support('post-thumbnails');
} add_action('after_setup_theme', 'seemax_setup');

// /*	ALLOW SVG UPLOAD XMLRPC 	*/
// function cc_mime_types($mimes) {
//   $mimes['svg'] = 'image/svg+xml';
//   return $mimes;
// } add_filter('upload_mimes', 'cc_mime_types');

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '') {
  $args['container'] = false;
  return $args;
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist) {
  return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class
function add_slug_to_body_class($classes) {
  global $post;
  if (is_home()) {
    $key = array_search('blog', $classes);
    if ($key > -1) {
      unset($classes[$key]);
    }
  } elseif (is_page()) {
    $classes[] = sanitize_html_class($post->post_name);
  } elseif (is_singular()) {
    $classes[] = sanitize_html_class($post->post_name);
  }
  return $classes;
}

function seemax_add_parent_body_class($classes) {
  // You can modify this check so it will run on every post type
  if (is_page()) {
    global $post;
    // If we *do* have an ancestors list, process it
    // http://codex.wordpress.org/Function_Reference/get_post_ancestors
    if ($parents = get_post_ancestors($post->ID)) {
      foreach ((array)$parents as $parent) {
        // As the array contains IDs only, we need to get each page
        if ($page = get_page($parent)) {
        // Add the current ancestor to the body class array
          $classes[] = "{$page->post_name}-{$page->post_type}-style";
        }
      }
    }
    // Add the current page to our body class array
    $classes[] = "{$post->post_type}-{$post->post_name}";
  }
  return $classes;
} add_filter('body_class', 'seemax_add_parent_body_class');


// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag) {
  return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions($html) {
  $html = preg_replace('/(width|height)="d*"s/', "", $html);
  return $html;
}


///////////////  SEEMAXWORK  ////////////////
////////// WP-ADMIN EMOJI STUFF ////////////
///////////////////////////////////////////

/* 	Disable the emoji's 	*/
function disable_emojis() {
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
  add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
  add_filter('wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2);
} add_action('init', 'disable_emojis');

/**
* REMOVE EMOJIS
* @param array $plugins
* @return array Difference betwen the two arrays
*/
function disable_emojis_tinymce($plugins) {
  if (is_array($plugins)) {
    return array_diff($plugins, array( 'wpemoji' ));
  } else {
    return array();
  }
}

/* Remove emoji CDN hostname from DNS prefetching hints.*/
function disable_emojis_remove_dns_prefetch($urls, $relation_type) {
  if ('dns-prefetch' == $relation_type) {
    /** This filter is documented in wp-includes/formatting.php */
    $emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/');
    $urls = array_diff($urls, array( $emoji_svg_url ));
  }
  return $urls;
}

/*	DISABLE XMLRPC 	*/
add_filter('xmlrpc_enabled', '__return_false');


///////////////  WORDPRESS  /////////////////
/////////// JS AND CSS LIBRARIES ///////////
///////////////////////////////////////////
add_action( 'wp_enqueue_scripts', function(){
  wp_deregister_script( 'jquery' );
  wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js', array(), null, false );
  wp_enqueue_script( 'jquery');
});

/* Enqueue Scripts */
function theme_header_scripts() {
  if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
    // wp_enqueue_script('imagesLoaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array(), '4.1.4', true);
    // wp_enqueue_script('isotope', get_template_directory_uri() . '/js/isotope.js', array(), '3.0.6', true);
    // Turn on Lity CSS File Below As Well
    // wp_enqueue_script('lightbox', get_template_directory_uri() . '/js/lity.min.js', array(), '2.4.1', true);
    // GSAP PLUGINS - Add to gsapRegisters.js when turning on
    // wp_enqueue_script('CSSRulePlugin', get_template_directory_uri() . '/js/CSSRulePlugin.min.js', array(), '3.4.0', true);
    // wp_enqueue_script('DrawSVGPlugin', get_template_directory_uri() . '/js/DrawSVGPlugin.min.js', array(), '3.4.0', true);
    // wp_enqueue_script('MorphSVGPlugin', get_template_directory_uri() . '/js/MorphSVGPlugin.min.js', array(), '3.4.0', true);
    wp_enqueue_script('SplitText', get_template_directory_uri() . '/js/SplitText.min.js', array(), '3.4.0', true);
    wp_enqueue_script('ScrollTrigger', get_template_directory_uri() . '/js/ScrollTrigger.min.js', array(), '3.4.0', true);
    wp_enqueue_script('ScrollTo', get_template_directory_uri() . '/js/ScrollToPlugin.min.js', array(), '3.4.0', true);
    wp_enqueue_script('gsap', get_template_directory_uri() . '/js/gsap.min.js', array(), '3.4.0', true);
    wp_enqueue_script('slickslider', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), '1.8.0', true);
    wp_enqueue_script( 'seemax-theme-scripts', get_template_directory_uri() . '/dist/js/bundle.js', array('jquery'), '1.0.0', true );
  }
}

/* Enqueue Styles */
function theme_style() {
  wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;700&family=Open+Sans:wght@300;400;600&display=swap');
  wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.all.min.css', array(), '5.5', 'all');
  wp_enqueue_style('normalize', get_template_directory_uri() . '/css/normalize.min.css', array(), '7.0', 'all');
  wp_enqueue_style('SlickSlider', get_template_directory_uri() . '/css/slick.css', array(), '1.0', 'all');
  wp_enqueue_style('SlickTheme', get_template_directory_uri() . '/css/slick-theme.css', array(), '1.0', 'all');
  // wp_enqueue_style('lightbox', get_template_directory_uri() . '/css/lity.min.css', array(), '0.131', 'all');
  wp_enqueue_style('seemax-theme-stylesheet', get_template_directory_uri() . '/dist/css/bundle.css', array(), '1.0.0', 'all');
}
add_action('wp_enqueue_scripts', 'theme_style');


///////////////  WORDPRESS  /////////////////
////// ACTIONS, FILTERS, & SHORTCODES //////
///////////////////////////////////////////
add_action('init', 'theme_header_scripts'); // Add Custom Scripts to wp_head
add_action('init', 'html5wp_pagination'); // Add HTML5 Pagination
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether


///////////////  SEEMAXWORK  ////////////////
///////// WP-ADMIN CUSTOMIZATION  //////////
///////////////////////////////////////////

/*	CUSTOMIZE ADMIN LOGIN 	*/
function custom_login_logo() {
  $blog_title = get_bloginfo( 'name' );
  echo
  "<style type='text/css'>
	h1 a {
    background-image: url('.get_template_directory_uri().'/img/logo-admin.png) !important; display:none !important;
  }

  h1::after {
    content:'$blog_title Login';
    position:relative;
    line-height:2;
  }
	</style>";
} add_action('login_head', 'custom_login_logo');

/*	CUSTOMIZE ADMIN FOOTER 	*/
function remove_footer_admin() {
  echo '<span id="footer-thankyou"> A Custom Theme By <a target="_blank" href="http://www.seemax.work">SeeMaxWork</a> </span>';
} add_filter('admin_footer_text', 'remove_footer_admin');

/* ADMIN AREA CLEANUP AND GLOBAL MODS */
function remove_dashboard_meta() {
  remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
  remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
  remove_meta_box('dashboard_primary', 'dashboard', 'side');
  remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
  remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
  remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
  remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
  remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
  remove_meta_box('dashboard_activity', 'dashboard', 'normal');//since 3.8
} add_action('admin_init', 'remove_dashboard_meta');

/* DASHBOARD CLEANUP */
if (!function_exists('disable_default_dashboard_widgets')) {
  function disable_default_dashboard_widgets() {
    global $wp_meta_boxes;
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);    // Right Now Widget
    unset($wp_meta_boxes['dashboard']['normal']['core']['welcome_panel']);             // Activity Widget
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);        // Activity Widget
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); // Comments Widget
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);  // Incoming Links Widget
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);         // Plugins Widget
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);       // Quick Press Widget
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);     // Recent Drafts Widget
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);           //
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);         //
    // unset($wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget']);           // Yoast's SEO Plugin Widget
  } add_action('wp_dashboard_setup', 'disable_default_dashboard_widgets');
}

// Remove Wordpress Main Menu Items
function remove_menus(){
  if ( is_user_logged_in() ) {
    $current_user = wp_get_current_user();
    if (!in_array($current_user->ID, array(1))) {
    // remove_menu_page( 'edit.php' );                       //Posts
    // remove_menu_page( 'index.php' );                      //Dashboard
    // remove_menu_page( 'jetpack' );                        //Jetpack
    // remove_menu_page( 'themes.php' );                     //Appearance
    // remove_menu_page( 'plugins.php' );                    //Plugins
    // remove_menu_page( 'users.php' );                      //Users
    // remove_menu_page( 'tools.php' );                      //Tools
    // remove_menu_page( 'options-general.php' );            //Settings
    remove_menu_page( 'edit-comments.php' );                 //Comments
    remove_menu_page('edit.php?post_type=acf-field-group');  //ACF
    }
  }
} add_action( 'admin_menu', 'remove_menus', 9999);

//////////////  SEEMAXWORK  /////////////////
/////// CUSTOMIZE WORDPRESS FEATURES ///////
///////////////////////////////////////////
//function to call first uploaded image in functions file?
function main_image() {
$files = get_children('post_parent='.get_the_ID().'&post_type=attachment
&post_mime_type=image&order=desc');
  if($files) :
    $keys = array_reverse(array_keys($files));
    $j=0;
    $num = $keys[$j];
    $image=wp_get_attachment_image($num, 'large', true);
    $imagepieces = explode('"', $image);
    $imagepath = $imagepieces[1];
    $main=wp_get_attachment_url($num);
        $template=get_template_directory();
        $the_title=get_the_title();
    print "<img src='$main' alt='$the_title' class='frame' />";
  endif;
}

// CUSTOM EXCERPT STYLES //
function seemax_custom_excerpt_length( $length ) {
   return 30;
} add_filter( 'excerpt_length', 'seemax_custom_excerpt_length', 999 );

function seemax_custom_excerpt_more($more) {
  global $post;
  // return '<a href="'. get_permalink($post->ID) . '">'. __(' ...Read More') .'</a>';
  return '...';
} add_filter('excerpt_more', 'seemax_custom_excerpt_more');


// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination() {
  global $wp_query;
  $big = 999999999;
  echo paginate_links(array(
    'base' => str_replace($big, '%#%', get_pagenum_link($big)),
    'format' => '?paged=%#%',
    'current' => max(1, get_query_var('paged')),
    'total' => $wp_query->max_num_pages,
    'prev_text'=> 'Previous',
    'next_text'=> 'Next',
    'end_size' => 0,
    'mid_size' => 1,
    'show_all' => false,
    // 'prev_next' => false,
  ));
}


/* Modify Main Nav Styles */
function main_theme_nav() {
  wp_nav_menu(
    array(
      'theme_location'  => 'header-menu',
      'menu'            => '',
      'container'       => 'div',
      'container_class' => 'menu-{menu slug}-container',
      'container_id'    => '',
      'menu_class'      => 'nav navMenu',
      'menu_id'         => '',
      'echo'            => true,
      'fallback_cb'     => 'wp_page_menu',
      'before'          => '',
      'after'           => '',
      'link_before'     => '',
      'link_after'      => '',
      'items_wrap'      => '%3$s',
      'depth'           => 0,
      'walker'          => new Description_Walker
      )
  );
}

function footer_theme_nav() {
  wp_nav_menu(
    array(
      'theme_location'  => 'footer-menu',
      'menu'            => '',
      'container'       => 'div',
      'container_class' => 'menu-{menu slug}-container',
      'container_id'    => '',
      'menu_class'      => 'nav navMenu',
      'menu_id'         => '',
      'echo'            => true,
      'fallback_cb'     => 'wp_page_menu',
      'before'          => '',
      'after'           => '',
      'link_before'     => '',
      'link_after'      => '',
      'items_wrap'      => '%3$s',
      'depth'           => 0,
      'walker'          => new Description_Walker
      )
  );
}

// Remove LI form Menu Items
class Description_Walker extends Walker_Nav_Menu {
  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    $classes = empty($item->classes) ? array () : (array) $item->classes;
    $class_names = join(' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
    !empty ( $class_names ) and $class_names = ' class="'. esc_attr( $class_names ) . '"';
    $output .= "";
    $attributes  = '';
    !empty( $item->attr_title ) and $attributes .= ' title="'  . esc_attr( $item->attr_title ) .'"';
    !empty( $item->target ) and $attributes .= ' target="' . esc_attr( $item->target     ) .'"';
    !empty( $item->xfn ) and $attributes .= ' rel="'    . esc_attr( $item->xfn        ) .'"';
    !empty( $item->url ) and $attributes .= ' href="'   . esc_attr( $item->url        ) .'"';
    $title = apply_filters( 'the_title', $item->title, $item->ID );
    $item_output = $args->before
    . "<a $attributes $class_names>"
    . $args->link_before
    . $title
    . '</a>'
    . $args->link_after
    . $args->after;
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }
}

/* Modify Custom Nav Styles
function extra_theme_nav()
{
    wp_nav_menu(
    array(
        'theme_location'  => 'custom-menu',
        'menu'            => '',
        'container'       => 'div',
        'container_class' => 'menu-{menu slug}-container',
        'container_id'    => '',
        'menu_class'      => 'nav navMenu',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul>%3$s</ul>',
        'depth'           => 0,
        'walker'          => ''
        )
    );
}  */


/* CUSTOM MENUS

function wpb_custom_new_menu() {
  register_nav_menus(
    array(
      'our-foods-footer' => __('Our Foods Footer'),
      'about-us-footer' => __('About Us Footer'),
      'find-us-footer' => __('Find Us Footer')
    )
  );
}
add_action( 'init', 'wpb_custom_new_menu' );
*/

// Register HTML5 Blank Navigation
function register_html5_menu() {
  register_nav_menus(array( // Using array to specify more menus if needed
    'header-menu' => __('Header Menu', 'theme'), // Main Navigation
    'footer-menu' => __('Footer Menu', 'theme'), // Sidebar Navigation
    // 'custom-menu' => __('Custom Menu', 'theme') // Sidebar Navigation
  ));
}

///////////////  SEEMAXWORK  ////////////////
///////// ACFS, CPTS, TAXONOMIES,  /////////
///////////////////////////////////////////

/*	ACF OPTIONS PAGES*/
if (function_exists('acf_add_options_page')) {
  acf_add_options_page(array(
    'page_title'    => 'Contact + Social',
    'menu_title'    => 'Contact + Social',
    'menu_slug'    => 'contact_social',
    'capability'    => 'edit_posts',
    'redirect'    => false,
    'icon_url' => 'dashicons-phone',
    'position' => 6
  ));

  // acf_add_options_page(array(
  //   'page_title'    => '404 Page Text',
  //   'menu_title'    => '404 Page Text',
  //   'menu_slug'    => 'fourohfour_options',
  //   'capability'    => 'edit_posts',
  //   'redirect'    => false,
  //   'icon_url' => 'dashicons-welcome-comments',
  //   'position' => 6
  // ));
}

/*  ACF GLOBAL	*/
function is_post_type($type){
  global $wp_query;
  if ($type == get_post_type($wp_query->post->ID)) {
    return true;
  }
  return false;
}

/* CUSTOM POST TYPES  */
function seemax_blocks_create_post_type() {

  register_post_type('bios',
    array(
      'labels' => array(
        'name' => __('Bios'),
        'singular_name' => __('Bio'),
        'add_new_item' => __( 'Add Bio' ),
            'add_new' => __( 'Add Bio' ),
            'edit_item' => __( 'Edit Bio' )
      ),
      'public' => true,
      'menu_icon' => 'dashicons-buddicons-buddypress-logo',
      'has_archive' => true,
      'show_in_rest'=> true,
      //  
      // 'supports' => array('title','editor'),
    )
  );

  register_post_type('companies',
    array(
      'labels' => array(
        'name' => __('Companies'),
        'singular_name' => __('Company'),
        'add_new_item' => __( 'Add Company' ),
            'add_new' => __( 'Add Company' ),
            'edit_item' => __( 'Edit Company' )
      ),
      'public' => true,
      'menu_icon' => 'dashicons-businessman',
      'has_archive' => true,
      'show_in_rest'=> true,
      //  
      // 'supports' => array('title','editor'),
    )
  );

  // register_post_type('reports',
  //   array(
  //     'labels' => array(
  //       'name' => __('Reports'),
  //       'singular_name' => __('Report')
  //     ),
  //     'public' => true,
  //     'menu_icon' => 'dashicons-chart-area',
  //     'has_archive' => true,
  //     //  
  //     // 'supports' => array('title','editor'),
  //   )
  // );

} add_action('init', 'seemax_blocks_create_post_type');


/* 	CPT TAXONOMIES 	*/
// function add_cpt_taxonomies() {
//   $labels = array(
//    'name'            => 'CPT Type',
//    'singular_name'   => 'CPT Type',
//    'search_items'    => 'Search CPT Type',
//    'edit_item'       => 'Edit CPT Type',
//    'update_item'     => 'Update CPT Type',
//    'add_new_item'     => 'Add New CPT Type',
//    'new_item_name'    => 'New CPT Type',
//    'menu_name'        => 'CPT Types',
//   );
//   $args = array(
//    'labels'            => $labels,
//    'public'            =>  true,
//    'hierarchical'      =>  true,
//    'tax_position' => true,
//    'show_in_nav_menus' =>  true,
//   	'has_archive'       =>  true,
//    'show_ui'           =>  true,
//    'show_admin_column' =>  true,
//    'rewrite'           =>  array('slug' => 'member-type', 'with_front' => false),
//   );
//   register_taxonomy('member-type', array('custom_post_type'), $args);
// } add_action('init', 'add_cpt_taxonomies');

// function add_reports_taxonomies() {
//   $labels = array(
//    'name'            => 'Report Type',
//    'singular_name'   => 'Report Type',
//    'search_items'    => 'Search Report Type',
//    'edit_item'       => 'Edit Report Type',
//    'update_item'     => 'Update Report Type',
//    'add_new_item'     => 'Add New Report Type',
//    'new_item_name'    => 'New Report Type',
//    'menu_name'        => 'Report Types',
//   );
//   $args = array(
//    'labels'            => $labels,
//    'public'            =>  true,
//    'hierarchical'      =>  true,
//    'tax_position' => true,
//    'show_in_nav_menus' =>  true,
//   	'has_archive'       =>  true,
//    'show_ui'           =>  true,
//    'show_admin_column' =>  true,
//    'rewrite'           =>  array('slug' => 'report-type', 'with_front' => false),
//   );
//   register_taxonomy('report-type', array('reports'), $args);
// } add_action('init', 'add_reports_taxonomies');


// Disable Guttenberg Blocks for a Custom Post Type / Normal Post / Pages / Etc.
add_filter('use_block_editor_for_post_type', function( $useBlockEditor, $postType ){

  if($postType == 'bios' || $postType == 'companies' || $postType == 'post')
  // if($postType == 'custom_post_type')
      return false;
  return $useBlockEditor;

}, 10, 2);

// Change The Enter Title Text For Custom Post Types
function wpb_change_title_text( $title ){
  $screen = get_current_screen();

  if  ( 'bios' == $screen->post_type ) {
       $title = 'Enter Name';
  }

  if  ( 'companies' == $screen->post_type ) {
    $title = 'Enter Company Name';
}

  // if  ( 'reports' == $screen->post_type ) {
  //   $title = 'Enter Report Title';
  // }

  return $title;
}
add_filter( 'enter_title_here', 'wpb_change_title_text' );



//////////////  SEEMAXWORK  ///////////////
///// ACF GUTTENBERG CUSTOMIZATION  //////
/////////////////////////////////////////


// Register Guttenberg Blocks for ACF - SeeMaxWork
function register_acf_block_types() {

  acf_register_block_type(array(
    'name'              => 'hero-section',
    'title'             => __('Hero'),
    'description'       => __('Add a single image, or a carousel, with text and button'),
    'category'          => 'layout',
    'icon'              => 'embed-photo',
    'keywords'          => array( 'hero', 'image', 'carousel' ),
    'mode'               => 'auto',
    'align'             => 'full',
    'supports'          => array( 'align' =>false ),
    'render_template'   => get_template_directory() . '/blocks/layout/hero-section/hero-section.php',
    'enqueue_style'     => get_template_directory_uri() . '/blocks/layout/hero-section/hero-section.css',
    'enqueue_script'    => get_template_directory_uri() . '/blocks/dist/js/hero-section.js'
  ));
  
  acf_register_block_type(array(
    'name'              => 'posts-preview-section',
    'title'             => __('Posts Preview Section'),
    'description'       => __('Add a preview of the 3 most recent posts'),
    'category'          => 'layout',
    'icon'              => 'excerpt-view',
    'keywords'          => array( 'blog', 'text', 'posts'),
    'mode'               => 'auto',
    'align'             => 'full',
    'supports'          => array( 'align' =>false ),
    'render_template'   => get_template_directory() . '/blocks/layout/posts-preview-section/posts-preview-section.php',
    'enqueue_style'     => get_template_directory_uri() . '/blocks/layout/posts-preview-section/posts-preview-section.css',
    'enqueue_script'    => get_template_directory_uri() . '/blocks/dist/js/posts-preview-section.js'
  ));

  acf_register_block_type(array(
    'name'              => 'three-column-section',
    'title'             => __('Three Column Section'),
    'description'       => __('Add A Section with Three columns'),
    'category'          => 'layout',
    'icon'              => 'id',
    'keywords'          => array( 'basic', 'text', 'image'),
    'mode'               => 'auto',
    'align'             => 'full',
    'supports'          => array( 'align' =>false ),
    'render_template'   => get_template_directory() . '/blocks/layout/three-column-section/three-column-section.php',
    'enqueue_style'     => get_template_directory_uri() . '/blocks/layout/three-column-section/three-column-section.css',
    'enqueue_script'    => get_template_directory_uri() . '/blocks/dist/js/three-column-section.js'
  ));

  acf_register_block_type(array(
    'name'              => 'half-half-section',
    'title'             => __('Half and Half Section'),
    'description'       => __('Add A Split Section with two columns of Image and Text'),
    'category'          => 'layout',
    'icon'              => 'id',
    'keywords'          => array( 'basic', 'text', 'image'),
    'mode'               => 'auto',
    'align'             => 'full',
    'supports'          => array( 'align' =>false ),
    'render_template'   => get_template_directory() . '/blocks/layout/half-half-section/half-half-section.php',
    'enqueue_style'     => get_template_directory_uri() . '/blocks/layout/half-half-section/half-half-section.css',
    'enqueue_script'    => get_template_directory_uri() . '/blocks/dist/js/half-half-section.js'
  ));

  acf_register_block_type(array(
    'name'              => 'image-text-split-section',
    'title'             => __('Image / Text Split Section'),
    'description'       => __('Add A Split Section with Image on One side and Text on the other'),
    'category'          => 'layout',
    'icon'              => 'columns',
    'keywords'          => array( 'basic', 'text', 'image'),
    'mode'               => 'auto',
    'align'             => 'full',
    'supports'          => array( 'align' =>false ),
    'render_template'   => get_template_directory() . '/blocks/layout/image-text-split-section/image-text-split-section.php',
    'enqueue_style'     => get_template_directory_uri() . '/blocks/layout/image-text-split-section/image-text-split-section.css',
    'enqueue_script'    => get_template_directory_uri() . '/blocks/dist/js/image-text-split-section.js'
  ));

  acf_register_block_type(array(
    'name'              => 'custom-post-type-grid-section',
    'title'             => __('Custom Post Type Grid Section'),
    'description'       => __('Add A Grid of Custom Post Types'),
    'category'          => 'layout',
    'icon'              => 'groups',
    'keywords'          => array('grid'),
    'mode'               => 'auto',
    'align'             => 'full',
    'supports'          => array( 'align' =>false ),
    'render_template'   => get_template_directory() . '/blocks/layout/custom-post-type-grid-section/custom-post-type-grid-section.php',
    'enqueue_style'     => get_template_directory_uri() . '/blocks/layout/custom-post-type-grid-section/custom-post-type-grid-section.css',
    'enqueue_script'    => get_template_directory_uri() . '/blocks/dist/js/custom-post-type-grid-section.js'
  ));

  acf_register_block_type(array(
    'name'              => 'signup-form-section',
    'title'             => __('Contact Form Section'),
    'description'       => __('Add A Contact Form'),
    'category'          => 'layout',
    'icon'              => 'edit-page',
    'keywords'          => array( 'signup', 'form'),
    'mode'               => 'auto',
    'align'             => 'full',
    'supports'          => array( 'align' =>false ),
    'render_template'   => get_template_directory() . '/blocks/layout/signup-form-section/signup-form-section.php',
    'enqueue_style'     => get_template_directory_uri() . '/blocks/layout/signup-form-section/signup-form-section.css',
    'enqueue_script'    => get_template_directory_uri() . '/blocks/dist/js/signup-form-section.js'
  ));

  acf_register_block_type(array(
    'name'              => 'full-width-section',
    'title'             => __('Full Width Section'),
    'description'       => __('Add A Full Width Section'),
    'category'          => 'layout',
    'icon'              => 'align-wide',
    'keywords'          => array( 'highlight'),
    'mode'               => 'auto',
    'align'             => 'full',
    'supports'          => array( 'align' =>false ),
    'render_template'   => get_template_directory() . '/blocks/layout/full-width-section/full-width-section.php',
    'enqueue_style'     => get_template_directory_uri() . '/blocks/layout/full-width-section/full-width-section.css',
    'enqueue_script'    => get_template_directory_uri() . '/blocks/dist/js/full-width-section.js'
  ));

  acf_register_block_type(array(
    'name'              => 'regular-text-section',
    'title'             => __('Regular Text Section'),
    'description'       => __('Add A Regular Text Section'),
    'category'          => 'layout',
    'icon'              => 'align-wide',
    'keywords'          => array( 'highlight'),
    'mode'               => 'auto',
    'align'             => 'full',
    'supports'          => array( 'align' =>false ),
    'render_template'   => get_template_directory() . '/blocks/layout/regular-text-section/regular-text-section.php',
    'enqueue_style'     => get_template_directory_uri() . '/blocks/layout/regular-text-section/regular-text-section.css',
    'enqueue_script'    => get_template_directory_uri() . '/blocks/dist/js/regular-text-section.js'
  ));

  acf_register_block_type(array(
    'name'              => 'quote-section',
    'title'             => __('Company Carousel Section'),
    'description'       => __('Add A Carousel of Companies'),
    'category'          => 'layout',
    'icon'              => 'businessman',
    'keywords'          => array( 'highlight'),
    'mode'               => 'auto',
    'align'             => 'full',
    'supports'          => array( 'align' =>false ),
    'render_template'   => get_template_directory() . '/blocks/layout/quote-section/quote-section.php',
    'enqueue_style'     => get_template_directory_uri() . '/blocks/layout/quote-section/quote-section.css',
    'enqueue_script'    => get_template_directory_uri() . '/blocks/dist/js/quote-section.js'
  ));
}

// ADD MAIN STYLE SHEET TO ADMIN AREA FOR PROPER GUTTENBERG STYLING //
// ADD EACH BLOCKS .css HERE AS WELL
function seemax_gutenberg_css(){
	add_theme_support( 'editor-styles' ); // if you don't add this line, your stylesheet won't be added
  add_editor_style( 
    array( 
      '/dist/css/bundle.css',
      '/blocks/layout/hero-section/hero-section.css',
      '/blocks/layout/posts-preview-section/posts-preview-section.css',
      '/blocks/layout/half-half-section/half-half-section.css',
      '/blocks/layout/three-column-section/three-column-section.css',
      '/blocks/layout/custom-post-type-grid-section/custom-post-type-grid-section.css',
      '/blocks/layout/signup-form-section/signup-form-section.css',
      '/blocks/layout/full-width-section/full-width-section.css',
      '/blocks/layout/regular-text-section/regular-text-section.css',
      '/blocks/layout/quote-section/quote-section.css',
      '/blocks/layout/image-text-split-section/image-text-split-section.css'
    )
 ); 
}
add_action( 'after_setup_theme', 'seemax_gutenberg_css' );


// Check if Guttneberg ACF block function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
  add_action('acf/init', 'register_acf_block_types');
}

// Add Full Style Sheet to Style the General WP UI
add_action( 'admin_enqueue_scripts', 'load_admin_style' );
function load_admin_style() {
  wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/css/wp-backend.css', false, '1.0.0' );
}


// RESTRICT GUTTENBERG BLOCK TYPES //
function seemax_allowed_block_types( $allowed_blocks, $post ) {
  // Only Show Core Blocks for Building Posts
  $allowed_blocks = array(
    'core/paragraph',
    'core/image',
    'core/heading',
  //   // 'core/gallery',
  //   'core/list',
    'core/quote',
  //   // 'core/audio',
  //   'core/video',
  //   'core/pullquote',
  //   // 'core/shortcode',
  //   'core-embed/youtube',
  //   'core-embed/vimeo',
	);
  // Only Show Custom ACF Blocks for Building Pages
	if( $post->post_type === 'page' ) {
		$allowed_blocks = array(
  		'acf/hero-section',
      'acf/posts-preview-section',
      'acf/three-column-section',
      'acf/custom-post-type-grid-section',
      'acf/signup-form-section',
      'acf/full-width-section',
      'acf/quote-section',
      'acf/image-text-split-section',
      'acf/half-half-section',
      'acf/regular-text-section'
      // 'core/paragraph',
      // 'core/image',
      // 'core/heading',
      // 'core/gallery',
      // 'core/list',
      // 'core/quote',
      // 'core/audio',
      // 'core/video',
      // 'core/pullquote',
      // 'core/shortcode',
      // 'core-embed/youtube',
      // 'core-embed/vimeo',
  	);
	}
	return $allowed_blocks;
} add_filter( 'allowed_block_types', 'seemax_allowed_block_types', 10, 2 );

// Remove Jetpack Open Graph //
add_filter( 'jetpack_enable_open_graph', '__return_false' );


//********** WORDPRESS API CUSTOMIZATION ***************//
//register acf fields to Wordpress API
//https://support.advancedcustomfields.com/forums/topic/json-rest-api-and-acf/

function acf_to_rest_api($response, $post, $request) {
  if (!function_exists('get_fields')) return $response;

  if (isset($post)) {
      $acf = get_fields($post->id);
      $response->data['acf'] = $acf;
  }
  return $response;
}
add_filter('rest_prepare_post', 'acf_to_rest_api', 10, 3);

// add this to functions.php
//register acf fields to Wordpress API
//https://support.advancedcustomfields.com/forums/topic/json-rest-api-and-acf/

function acf_cpt_to_rest_api($response, $post, $request) {
    if (!function_exists('get_fields')) return $response;

    if (isset($post)) {
        $acf = get_fields($post->id);
        $response->data['acf'] = $acf;
    }
    return $response;
}
add_filter('rest_prepare_board_advisor', 'acf_cpt_to_rest_api', 10, 3);

// Show Category Names in WP API PT 1
function wpse_287931_register_categories_names_field()
{
    register_rest_field(
        array('post'),
        'categories_names',
        array(
            'get_callback'    => 'wpse_287931_get_categories_names',
            'update_callback' => null,
            'schema'          => null,
        )
    );
}
// Show Category Names in WP API PT 2
add_action('rest_api_init', 'wpse_287931_register_categories_names_field');

function wpse_287931_get_categories_names($object, $field_name, $request)
{
    $formatted_categories = array();

    $categories = get_the_category($object['id']);

    foreach ($categories as $category) {
        $formatted_categories[] = $category->name;
    }

    return $formatted_categories;
}

// From: https://css-tricks.com/snippets/wordpress/get-the-first-image-from-a-post/
// If There is No Featured Image Get the First Image. 
// If There are no images at all show a default
function catch_that_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+?src=[\'"]([^\'"]+)[\'"].*?>/i', $post->post_content, $matches);
$first_img = $matches[1][0];

if(empty($first_img)) {
$first_img = get_template_directory_uri() . "/dist/images/default-image.jpg";
}
return $first_img;
}

// // Change dashboard Posts Label
// add_action( 'init', 'cp_change_post_object' );
// function cp_change_post_object() {
// $get_post_type = get_post_type_object('post');
// $labels = $get_post_type->labels;
// $labels->name = 'Insights';
// $labels->singular_name = 'Insight';
// $labels->add_new = 'Add Insight';
// $labels->add_new_item = 'Add Insight';
// $labels->edit_item = 'Edit Insight';
// $labels->new_item = 'Insight';
// $labels->view_item = 'View Insights';
// $labels->search_items = 'Search Insights';
// $labels->not_found = 'No Insights found';
// $labels->not_found_in_trash = 'No Insights found in Trash';
// $labels->all_items = 'All Insights';
// $labels->menu_name = 'Insights';
// $labels->name_admin_bar = 'Insights';
// }

// // Change dashboard Posts Icon
// function change_post_menu_label_icon() {
// global $menu;
// $menu[5][6] = 'dashicons-megaphone';
// echo '';
// }
// add_action( 'admin_menu', 'change_post_menu_label_icon' );


// // Move Jetpack Logos
// function jptweak_remove_share() {
// remove_filter( 'the_content', 'sharing_display', 19 );
// remove_filter( 'the_excerpt', 'sharing_display', 19 );
// if ( class_exists( 'Jetpack_Likes' ) ) {
// remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
// }
// }

// add_action( 'loop_start', 'jptweak_remove_share' );

////////////// SEEMAXWORK ///////////////
//// PROJECT SPECIFIC CUSTOMIZATION /////
/////////////////////////////////////////