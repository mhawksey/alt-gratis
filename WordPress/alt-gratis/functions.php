<?php
/*
 *  Author: Todd Motto | @toddmotto
 *  URL: altgratis.com | @altgratis
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

/*if (!isset($content_width))
{
    $content_width = 700;
}*/

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    //add_image_size('large', 700, '', true); // Large Thumbnail
    //add_image_size('medium', 250, '', true); // Medium Thumbnail
    //add_image_size('small', 120, '', true); // Small Thumbnail
	//add_image_size('slider-top-large', 1006, 250, true);
	//add_image_size('slider-large', 990, 250, true);
	//add_image_size('slider-responsile', 925, 250, true);
	add_image_size('slider-middle', 756, 250, true);
	add_image_size('slider-thumbnail', 80, 50, true);
	add_image_size('post-thumbnails', 320, 160, true);
	add_image_size('single-post-thumbnail', 707, 530, true);

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    /*add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

    // Add Support for Custom Header - Uncomment below if you're going to use
    /*add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
    ));*/

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('altgratis', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// HTML5 Blank navigation
function altgratis_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'menu-{menu slug}-container',
		'container_id'    => '',
		'menu_class'      => 'menu',
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
}



// Load HTML5 Blank scripts (header.php)
function altgratis_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

    	wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
        wp_enqueue_script('conditionizr'); // Enqueue it!

        wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!

        wp_register_script('altgratisscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('altgratisscripts'); // Enqueue it!
		
		wp_register_script('cc_rotate', get_template_directory_uri() . '/js/jquery-ui-tabs-rotate.js', array('jquery', 'jquery-ui-tabs'));
		
    }
}

// Load HTML5 Blank conditional scripts
function altgratis_conditional_scripts()
{
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('scriptname'); // Enqueue it!
    }
}

// Load HTML5 Blank styles
function altgratis_styles()
{
    wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize'); // Enqueue it!

    wp_register_style('altgratis', get_template_directory_uri() . '/style.css', array(), '1.0', 'screen');
    wp_enqueue_style('altgratis'); // Enqueue it!
	
	wp_register_style('fontawesome', get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.min.css', array(), '4.4.0'); // Modernizr
    wp_enqueue_style('fontawesome'); // Enqueue it!
}

// Register HTML5 Blank Navigation
function register_html5_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'altgratis'), // Main Navigation
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
	// how many sidebars
	if (is_active_sidebar('sidebar-first') && is_active_sidebar('sidebar-second')){
		$classes[] = 'two-sidebars';
	} elseif (is_active_sidebar('sidebar-first') || is_active_sidebar('sidebar-second')){
		$classes[] = 'one-sidebar';
		if (is_active_sidebar('sidebar-first')){
			$classes[] = 'sidebar-first';
		}
		if (is_active_sidebar('sidebar-second')){
			$classes[] = 'sidebar-second';
		}
	} else {
		$classes[] = 'no-sidebar';
	}
	
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

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
 	// Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Sidebar Second', 'altgratis'),
        'description' => __('Sidebar right', 'altgratis'),
        'id' => 'sidebar-second',
        'before_widget' => '<div id="%1$s" class="%2$s block">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    ));
	
	// Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Sidebar First', 'altgratis'),
        'description' => __('Sidebar left', 'altgratis'),
        'id' => 'sidebar-first',
        'before_widget' => '<div id="%1$s" class="%2$s block">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    ));

    
	
	// Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Top Links', 'altgratis'),
        'description' => __('Top links area', 'altgratis'),
        'id' => 'sidebar-toplinks',
        'before_widget' => '<div id="%1$s" class="%2$s block">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    )); 
	
	register_sidebar(array(
        'name' => __('Fullwidth', 'altgratis'),
        'description' => __('Fullwidth', 'altgratis'),
        'id' => 'sidebar-fullwidthhighlight',
        'before_widget' => '<div id="%1$s" class="%2$s block">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    ));  
	
	register_sidebar(array(
        'name' => __('Preface First', 'altgratis'),
        'description' => __('Preface First', 'altgratis'),
        'id' => 'sidebar-preface-first',
        'before_widget' => '<div id="%1$s" class="%2$s block">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    )); 
	register_sidebar(array(
        'name' => __('Preface Second', 'altgratis'),
        'description' => __('Preface Second', 'altgratis'),
        'id' => 'sidebar-preface-second',
        'before_widget' => '<div id="%1$s" class="%2$s block">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    )); 
	register_sidebar(array(
        'name' => __('Preface Third', 'altgratis'),
        'description' => __('Preface Third', 'altgratis'),
        'id' => 'sidebar-preface-third',
        'before_widget' => '<div id="%1$s" class="%2$s block">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    )); 
	
	register_sidebar(array(
        'name' => __('Fullwidth', 'altgratis'),
        'description' => __('Fullwidth', 'altgratis'),
        'id' => 'sidebar-fullwidthhighlight',
        'before_widget' => '<div id="%1$s" class="%2$s block">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    ));  
	
	register_sidebar(array(
        'name' => __('Footer First', 'altgratis'),
        'description' => __('Footer First', 'altgratis'),
        'id' => 'sidebar-footer-first',
        'before_widget' => '<div id="%1$s" class="%2$s block">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    )); 
	register_sidebar(array(
        'name' => __('Footer Second', 'altgratis'),
        'description' => __('Footer Second', 'altgratis'),
        'id' => 'sidebar-footer-second',
        'before_widget' => '<div id="%1$s" class="%2$s block">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    )); 
	register_sidebar(array(
        'name' => __('Footer Third', 'altgratis'),
        'description' => __('Footer Third', 'altgratis'),
        'id' => 'sidebar-footer-third',
        'before_widget' => '<div id="%1$s" class="%2$s block">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    )); 
	
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function altgratis_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function altgratis_index() // Create 20 Word Callback for Index page Excerpts, call using altgratis_excerpt('altgratis_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using altgratis_excerpt('altgratis_custom_post');
function altgratis_custom_post()
{
    return 80;
}
// Create 40 Word Callback for Custom Post Excerpts, call using altgratis_excerpt('altgratis_custom_post');
function altgratis_slideshow()
{
    return 30;
}

// Create the Custom Excerpts callback
function get_altgratis_excerpt($length_callback = '', $more_callback = '')
{
    if (function_exists($length_callback)) {
        $num_words = call_user_func( $length_callback );
    }
    if (function_exists($more_callback)) {
		$more = call_user_func( $more_callback );
    }
	$output = wp_trim_words(get_the_excerpt(),$num_words).$more;
    $output = '<p itemprop="description">' . $output . '</p>';
    return $output;
}

// Create the Custom Excerpts callback
function altgratis_excerpt($length_callback = '', $more_callback = '')
{
    echo get_altgratis_excerpt($length_callback, $more_callback);
}

// Custom View Article link to Post
function altgratis_view_more()
{
    global $post;
	return ' <a class="view-article" href="' . get_permalink(get_the_ID()) . '">' . __('View Article', 'altgratis') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function altgratisgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function altgratiscomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, 35 ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'altgratis_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'altgratis_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'altgratis_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
//add_action('init', 'create_post_type_html5'); // Add our HTML5 Blank Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'altgratis_pagination'); // Add our HTML5 Pagination
add_action('admin_menu', 'custom_editor_admin_menu'); // custom menu for editors

// Remove Actions
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

// Add Filters
add_filter('avatar_defaults', 'altgratisgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
//add_filter('excerpt_more', 'altgratis_view_more'); // Add 'View Article' button instead of [...] for Excerpts
//add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images
add_filter( 'user_has_cap', 'pxlcore_give_edit_theme_options' ); // allow editor theme edit capabilities 

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether
// https://www.kerstner.at/en/2013/06/wordpress-search-redirects-to-home-when-search-query-is-empty/
function searchRequestFilter( $query_vars ) {
    if( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) {
        $query_vars['s'] = " ";
    }
    return $query_vars;
}
 
add_filter( 'request', 'searchRequestFilter' );

// Shortcodes
add_shortcode('alt_cse_result', 'alt_gratis_cse');
add_shortcode('alt_slider', 'alt_gratis_slider');
add_shortcode('box', 'alt_gratis_box');


// allow editors to modify menus and widgets
// http://markwilkinson.me/2014/05/allow-wordpress-editors-access-widgets-menus/#comment-12128
function custom_editor_admin_menu() {

	$user = new WP_User(get_current_user_id());
	if (!empty( $user->roles) && is_array($user->roles)) {
		foreach ($user->roles as $role)
			$role = $role;
	}

	if($role == "editor") {
		global $submenu;
		unset($submenu['themes.php'][6]); // remove customize link
		remove_submenu_page( 'themes.php', 'themes.php' );
	}
}

// http://markwilkinson.me/2014/05/allow-wordpress-editors-access-widgets-menus/
function pxlcore_give_edit_theme_options( $caps ) {
	
	/* check if the user has the edit_pages capability */
	if( ! empty( $caps[ 'edit_pages' ] ) ) {
		
		/* give the user the edit theme options capability */
		$caps[ 'edit_theme_options' ] = true;
		
	}
	
	/* return the modified capabilities */
	return $caps;
	
}


/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

function alt_gratis_cse($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return "<gcse:searchresults-only></gcse:searchresults-only>";
}

function alt_gratis_box($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    extract(shortcode_atts(array('type' => 'note'), $atts));
	return '<p class="'.$type.'">'.$content.'</p>';
}

function alt_gratis_slider($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    extract(shortcode_atts(array(
                'amount' => '4',
                'category__in' => array(),
                'category_name' => '',
                'page_id' => '',
                'post_type' => 'post',
                'orderby' => 'DESC',
                'slider_nav' => 'on',
                'caption' => 'on',
                'caption_height' => '',
                'caption_top' => '',
                'caption_width' => '',
                'reflect' => '',
                'width' => '',
                'height' => '',
                'id' => '',
                'background' => '',
                'slider_nav_color' => '',
                'slider_nav_hover_color' => '',
                'slider_nav_selected_color' => '',
                'slider_nav_font_color' => '',
                'time_in_ms' => '5000',
                'allow_direct_link' => __('yes', 'cc'),
                'open_new_tab' => __('no', 'cc'),
                    ), $atts));
					
	wp_enqueue_script('cc_rotate');
	add_action('wp_footer', 'cc_footer_js', 99);
	
	//$atts = array_merge($atts, $same_attrs);
	$tmp = '<div id="cc_slidertop"><div id="cc_slider-top" class="hidden-phone row-fluid">';
	$tmp .= cc_slider($atts, $content = null);
	$tmp .= '</div>';
	$tmp .= '<div class="slidershadow hidden-phone span10"><img src="'.get_template_directory_uri().'/img/slideshow/'.cc_slider_shadow().'" alt="'.__('Slideshow shadow', 'cc').'"></div>';
	$tmp .='</div><div class="clear"></div>';
	return $tmp;
}


function cc_footer_js(){
	global $cc_js;

	if(empty($cc_js))
		return;

	$js = '';

	if(!empty($cc_js) && count($cc_js) > 0){
		$js .= '<script type="text/javascript">';

		// Slideshow or slider
		if(isset($cc_js['slideshow'])){
			foreach ($cc_js['slideshow'] as $key => $params) {
				$js .= 'jQuery("#featured'.$params['id'].'").tabs({fx:{opacity: "toggle"}}).tabs("rotate", '.$params['time_in_ms'].', true);
						jQuery("#featured'.$params['id'].'").hover(
							function(){jQuery("#featured'.$params['id'].'").tabs("rotate",0,true);},
							function(){jQuery("#featured'.$params['id'].'").tabs("rotate",'.$params['time_in_ms'].',true);
						});';
			}
		}

		// Image effects (reflects)
		if(isset($cc_js['img_effect'])){
			foreach ($cc_js['img_effect'] as $key => $params) {
				$js .= 'jQuery("#img_effect'.$params['id'].'").reflect({height:'.$params['rheight'].',opacity:'.$params['ropacity'].'});';
			}
		}

		// Accordion
		if(isset($cc_js['accordion'])){
			foreach ($cc_js['accordion'] as $key => $params) {
				$js .= 'jQuery("#accordion'.$params['id'].' div.swap'.$params['id'].'").hide();
						jQuery("#accordion'.$params['id'].' h3").click(function(){
							jQuery(this).nextUntil("h3", "div.swap'.$params['id'].'").slideToggle("slow").siblings("div.swap'.$params['id'].':visible").slideUp("slow");
							jQuery(this).toggleClass("active");
							jQuery(this).siblings("h3").removeClass("active");
						});';
			}
		}

		// List posts
		if(isset($cc_js['list_posts'])){
			if ($cc_js['list_posts'] === true){
				$js .= 'jQuery(".boxgrid.captionfull").hover(function(){
							jQuery(".cover", this).stop().animate({top:"-90px"},{queue:false,duration:160});
						}, function(){
							jQuery(".cover", this).stop().animate({top:"0px"},{queue:false,duration:160});
						});';
			}
		}

		$js .= '</script>';
	}

	echo $js;
}

/**
 * get the right img for the slideshow shadow
 *
 * @package Custom Community
 * @since 1.8.3
 */
function cc_slider_shadow() {
	return "slider-shadow-sharp.png";
}
/**
 * Slider functions, used in slideshow parts
 * @global object $post post object
 * @global type $cc_js
 * @global type $cap
 * @global type $post
 * @param type $atts
 * @param type $content
 * @return type
 */
function cc_slider($atts, $content = null) {
    global $post, $cc_js, $cap;
    extract(shortcode_atts(array(
                'amount' => '4',
                'category__in' => array(),
                'category_name' => '',
                'page_id' => '',
                'post_type' => 'post',
                'orderby' => 'DESC',
                'slider_nav' => 'on',
                'caption' => 'on',
                'caption_height' => '',
                'caption_top' => '',
                'caption_width' => '',
                'reflect' => '',
                'width' => '',
                'height' => '',
                'id' => '',
                'background' => '',
                'slider_nav_color' => '',
                'slider_nav_hover_color' => '',
                'slider_nav_selected_color' => '',
                'slider_nav_font_color' => '',
                'time_in_ms' => '5000',
                'allow_direct_link' => __('no', 'cc'),
                'open_new_tab' => __('no', 'cc'),
                    ), $atts));



    if ($page_id != '' && $post_type == 'post') {
        $post_type = array('page', 'post');
    }
    //pages haven't categories
    if (!empty($page_id)){
        $category_name = '';
        $category__in = array();
    }

    if ($page_id != '') {
        $page_id = explode(',', $page_id);
    }

    $tmp = chr(13);

    $tmp .= '<style type="text/css">' . chr(13);
    $tmp .= 'div.post img {' . chr(13);
    $tmp .= 'margin: 0 0 1px 0;' . chr(13);
    $tmp .= '}' . chr(13);
    $tmp .= '.row-fluid #cc_slider'.$id.'.cc_slider .info.span8{';
    $tmp .= 'width: 100%;';
    $tmp .= 'padding-right: 15px';
    $tmp .= '}';

    if ($slider_nav == 'off') {
        $tmp .= '#featured' . $id . ' ul.ui-tabs-nav {
                visibility: hidden;
            }
            #featured' . $id . ' {
                background: none;
                padding:0;
            }
            div#cc_slider'.$id.'.cc_slider .featured .ui-tabs-panel{
                width: 100%;
            }';
    } else {
        $tmp .= 'div#cc_slider'.$id.'.cc_slider .featured .ui-tabs-panel{
                width: 75%;
            }';
    }

    if ($width != "") {
        $tmp .= '#featured' . $id . ' ul.ui-tabs-nav {' . chr(13);
        $tmp .= 'left:' . $width . 'px;' . chr(13);
        $tmp .= '}' . chr(13);
    }

    if ($caption_height != "") {
        $tmp .= '#featured' . $id . ' .ui-tabs-panel .info{' . chr(13);
        $tmp .= 'height:' . $caption_height . 'px;' . chr(13);
        $tmp .= '}' . chr(13);
    }

    if ($caption_width != "") {
        $tmp .= '#featured' . $id . ' .ui-tabs-panel .info{' . chr(13);
        $tmp .= 'width:' . $caption_width . 'px;' . chr(13);
        $tmp .= '}' . chr(13);
    }

    if ($caption_top != "") {
        $tmp .= '#featured' . $id . ' .ui-tabs-panel .info{' . chr(13);
        $tmp .= 'top:' . $caption_top . 'px;' . chr(13);
        $tmp .= '}' . chr(13);
    }

    if ($background != '') {
        $tmp .= '#featured' . $id . '{' . chr(13);
        $tmp .= 'background: #' . $background . ';' . chr(13);
        $tmp .= '}' . chr(13);
    }

    if ($width != '' || $height != '' || $slider_nav == 'off') {
        $tmp .= '#featured' . $id . '{' . chr(13);
        $tmp .= 'width:' . $width . 'px;' . chr(13);
        $tmp .= 'height:' . $height . 'px;' . chr(13);
        $tmp .= '}' . chr(13);
        $tmp .= '#featured' . $id . ' .ui-tabs-panel{' . chr(13);
        $tmp .= 'width:' . $width . 'px; height:' . $height . 'px;' . chr(13);
        $tmp .= 'background:none; position:relative;' . chr(13);
        $tmp .= '}' . chr(13);
    }

    if ($slider_nav_color != '') {
        $tmp .= '#featured' . $id . ' li.ui-tabs-nav-item a{' . chr(13);
        $tmp .= '    background: none repeat scroll 0 0 #' . $slider_nav_color . ';' . chr(13);
        $tmp .= '}' . chr(13);
    }
    if ($slider_nav_hover_color != '') {
        $tmp .= '#featured' . $id . ' li.ui-tabs-nav-item a:hover{' . chr(13);
        $tmp .= '    background: none repeat scroll 0 0 #' . $slider_nav_hover_color . ';' . chr(13);
        $tmp .= '}' . chr(13);
    }

    if ($slider_nav_selected_color != '') {
        $tmp .= '#featured' . $id . ' .ui-tabs-selected {' . chr(13);
        $tmp .= 'padding-left:0;' . chr(13);
        $tmp .= '}' . chr(13);
        $tmp .= '#featured' . $id . ' .ui-tabs-selected a{' . chr(13);
        $tmp .= '    background: none repeat scroll 0 0 #' . $slider_nav_selected_color . ' !important;' . chr(13);
        $tmp .= 'padding-left:0;' . chr(13);
        $tmp .= '}' . chr(13);
    }

    if ($slider_nav_font_color != '') {
        $tmp .= '#featured' . $id . ' ul.ui-tabs-nav li span{' . chr(13);
        $tmp .= 'color:#' . $slider_nav_font_color . chr(13);
        $tmp .= '}' . chr(13);
    }
    $tmp .= '</style>' . chr(13);

    $args = array(
        'orderby' => $orderby,
        'post_type' => $post_type,
        'post__in' => $page_id,
        'category__in' => $category__in,
        'category_name' => $category_name,
        'posts_per_page' => $amount
    );

    remove_all_filters('posts_orderby');
    query_posts($args);
    if (have_posts()) {
        $shortcodeclass = '';
        if ($id == "top")
            $shortcodeclass = "cc_slider_shortcode";

        $tmp .='<div id="cc_slider' . $id . '" class="cc_slider hidden-phone span12' . $shortcodeclass . '">' . chr(13);
        $tmp .='<div id="featured' . $id . '" class="featured">' . chr(13);

        $i = 1;
        $slider_class = $slider_nav == 'off' ? 'span12' : 'span8';
        while (have_posts()) : the_post();
            global $post;
            $url = get_permalink();
            $theme_fields = get_post_custom_values('my_url');
            if (isset($theme_fields[0])) {
                $url = $theme_fields[0];
            }
            $tmp .='<div id="fragment-' . $id . '-' . $i . '" class="ui-tabs-panel ' . $slider_class . '">' . chr(13);

            if ($width != '' || $height != '') {
                $ftrdimg = get_the_post_thumbnail($post->ID, array($width + 10, $height), array('class' => $reflect, 'alt' => get_the_title()));
                if (empty($ftrdimg)) {
                    if ($cap->slideshow_img) {
                        $ftrdimg = '<img src="' . $cap->slideshow_img . '" />';
                    } else {
                        $ftrdimg = '<img src="' . get_template_directory_uri() . '/img/slideshow/noftrdimg-1006x250.jpg" />';
                    }
                }
            } else {

                $thumb = $cap->cc_responsive_enable ? 'slider-responsile' : 'slider-middle';

                $ftrdimg = get_the_post_thumbnail($post->ID, $thumb, array('alt' => get_the_title()));
                if (empty($ftrdimg)) {
                    if ($cap->slideshow_img) {
                        $ftrdimg = '<img src="' . $cap->slideshow_img . '" width="756" height="250"/>';
                    } else {
                        $ftrdimg = '<img src="' . get_template_directory_uri() . '/img/slideshow/noftrdimg.jpg" />';
                    }
                }
            }
            if($open_new_tab == __('yes', 'cc')){
                $target = 'target="_blank"';
            } else {
                $target = '';
            }
            $tmp .='    <a class="reflect" href="' . $url . '" '.$target.'>' . $ftrdimg . '</a>' . chr(13);

            if ($caption == 'on') {
                $tmp .=' <div class="info span8" >' . chr(13);
                $tmp .='    <h2><a href="' . $url . '" >' . get_the_title() . '</a></h2>' . chr(13);
                $tmp .='    <p>' . get_altgratis_excerpt('altgratis_slideshow', 'altgratis_view_more') . '</p>' . chr(13);
                $tmp .=' </div>' . chr(13);
            }
            $tmp .='</div>' . chr(13);
            $i++;
        endwhile;

        $tmp .='<ul class="ui-tabs-nav span4 offset1">' . chr(13);
        $i = 1;
        while (have_posts()) : the_post();
            if (get_the_post_thumbnail($post->ID, 'slider-thumbnail', array('alt' => get_the_title())) == '') {
                if (!empty($cap->slideshow_small_img) || $cap->slideshow_small_img != '') {
                    $ftrdimgs = '<img src="' . $cap->slideshow_small_img . '" width="80" height="50"/>';
                } else {
                    $ftrdimgs = '<img src="' . get_template_directory_uri() . '/img/slideshow/noftrdimg-80x50.jpg" />';
                }
            } else {
                $ftrdimgs = get_the_post_thumbnail($post->ID, 'slider-thumbnail', array('alt' => get_the_title()));
            }
            $title = mb_substr(get_the_title(), 0, 65);
            if ($allow_direct_link == __('yes', 'cc')) {
                $ftrdimgs = '<a href="#fragment-' . $id . '-' . $i . '" class="allow-dirrect-links" data-url="' . get_permalink($post->ID) . '">' . $ftrdimgs . '<span>' . $title . '</span></a>';
            } else {
                $ftrdimgs = '<a href="#fragment-' . $id . '-' . $i . '">' . $ftrdimgs . '<span>' . $title . '</span></a>';
            }
            $tmp .='<li class="ui-tabs-nav-item ui-tabs-selected" id="nav-fragment-' . $id . '-' . $i . '">' . $ftrdimgs . '</li>' . chr(13);
            $i++;
        endwhile;
        $tmp .='</ul>' . chr(13);

        $tmp .= '</div></div>' . chr(13);
    } else {
        $tmp .='<div id="cc_slider_prev" class="cc_slider">' . chr(13);
        $tmp .='<div id="featured_prev" class="featured">' . chr(13);
        $tmp .='<h2 class="center">' . __('Empty Slideshow', 'cc') . '</h2>' . chr(13);
        $tmp .='<p class="center">' . __('Something went wrong here. Some help: <br>Check your theme settings and write a post with an featured image! <br> Have a look how to setup your <a href="http://support.themekraft.com/entries/21647926-slideshow" target="_blank">Slideshow</a> or check out our <a href="http://themekraft/support" target="_blank">Support</a> if you still get stuck.', 'cc') . '</p>' . chr(13);
        $tmp .='</div></div>' . chr(13);
    }
    wp_reset_query();

    // js vars
    $cc_js['slideshow'][] = array(
        'id' => $id,
        'time_in_ms' => $time_in_ms
    );

    return $tmp . chr(13);
}

/*
Plugin Name: WP Google Search
Plugin URI: http://webshoplogic.com/
Description: This plugin gives a very simple way to integrate Google Search into your WordPress site.  
Version: 1.0.4
Author: WebshopLogic
Author URI: http://webshoplogic.com/
License: GPLv2 or later
Text Domain: wgs
Requires at least: 3.7
Tested up to: 4.2.2
*/

if ( ! class_exists( 'WP_Google_Search_ALT' ) ) {

class WP_Google_Search_ALT {

	public $plugin_path;

	public $plugin_url;


	function __construct() {

		include_once( get_template_directory().'/inc/wgs-admin-page.php' );
		
		add_action( 'init', array( $this, 'init' ), 0 );
		
		add_action('after_switch_theme',  array( $this, 'wgs_activation' ) , 10 ,  2);
		//register_activation_hook( __FILE__, array( $this, 'wgs_activation' ) );
		
		$options = get_option( 'wgs_general_settings' );

		//if (!empty($options['google_search_engine_id'])) { //$options['enable_plugin']

			include_once( get_template_directory().'/inc/wgs-widget.php' );
			do_action( 'wgs_init' );

		//}

	}

	public function init() {

		load_plugin_textdomain( 'wgs', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );


		global $wgs_admin_page;
		$wgs_admin_page = new WGS_Admin_Page;

		$options = get_option('wgs_general_settings');

		//if ( !empty($options['google_search_engine_id']) ) { //$options['enable_plugin']
			
			wp_register_script(
				'google_cse_v2',
				get_template_directory_uri() . '/assets/js/google_cse_v2.js',
				array( // dependencies 
  						),
 					1.0,
					true
			);

			wp_enqueue_script( 'google_cse_v2' );
			
			if ($options['use_default_correction_css'] == 1)
				wp_enqueue_style( 'wgs', get_template_directory_uri().'/inc/wgs.css' );
			
			$script_params = array(
				'google_search_engine_id' => $options['google_search_engine_id']
				);
				
			wp_localize_script( 'google_cse_v2', 'scriptParams', $script_params );			

			add_shortcode( 'wp_google_search', array( $this, 'wp_google_search_shortcode' ));
			add_shortcode( 'wp_google_searchbox', array( $this, 'wp_google_searchbox_shortcode' ));

			do_action( 'wgs_init', $this );

		//}

	}
	
	public function wgs_activation() {

		//create search page if not exists
			
		$options = get_option( 'wgs_general_settings' );
		
		$search_gcse_page_id = $options['search_gcse_page_id'];

		if ($options['search_gcse_page_id'] == null or get_post($options['search_gcse_page_id']) == null) {

			$search_gcse_page = array(
			  //'ID'             => [ <post id> ] // Are you updating an existing post?
			  'post_content'   => '[wp_google_search]', //'<gcse:searchresults-only linktarget="_self"></gcse:searchresults-only>', //[ <string> ] // The full text of the post.
			  'post_name'      => 's', //[ <string> ] // The name (slug) for your post
			  'post_title'     => __('Search Results','wgs'), //[ <string> ] // The title of your post.
			  'post_status'    => 'publish', //[ 'draft' | 'publish' | 'pending'| 'future' | 'private' | custom registered status ] // Default 'draft'.
			  'post_type'      => 'page', //[ 'post' | 'page' | 'link' | 'nav_menu_item' | custom post type ] // Default 'post'.
			  'post_author'    => get_current_user_id(), //[ <user ID> ] // The user ID number of the author. Default is the current user ID.
			  'post_excerpt'   => __('Search Results','wgs'), //[ <string> ] // For all your post excerpt needs.
			  'post_date'      => date('Y-m-d H:i:s'), //[ Y-m-d H:i:s ] // The time post was made.
			  'comment_status' => 'closed',
			  'ping_status'    => 'closed',
			  
			  //'post_date_gmt'  => [ Y-m-d H:i:s ] // The time post was made, in GMT.
			  //'comment_status' => [ 'closed' | 'open' ] // Default is the option 'default_comment_status', or 'closed'.
			  //'post_category'  => [ array(<category id>, ...) ] // Default empty.
			  //'tags_input'     => [ '<tag>, <tag>, ...' | array ] // Default empty.
			  //'tax_input'      => [ array( <taxonomy> => <array | string> ) ] // For custom taxonomies. Default empty.
			  //'page_template'  => [ <string> ] // Default empty.
			);  
			
			$search_gcse_page_id = wp_insert_post( $search_gcse_page );

			$options['search_gcse_page_id'] = $search_gcse_page_id;
			
			$options['search_gcse_page_url'] = get_page_link( $search_gcse_page_id );
			
			//update_option( $option, $new_value );
			update_option( 'wgs_general_settings', $options );

		}

	}
	

	function wp_google_search_shortcode( $atts ){
		
		$options = get_option( 'wgs_general_settings' );

		//if ($options['use_default_correction_css'] == 1)
		//	wp_enqueue_style( 'wgs', plugins_url('wgs.css', __FILE__) );
		
		if ($options['searchbox_before_results'] == 1 or $options['support_overlay_display'] == 1)
			$gcse_code = 'search';
		else
			$gcse_code = 'searchresults-only';

		$content  = '<div class="wgs_wrapper" id="wgs_wrapper_id">';
		//$content .= '<gcse:searchresults-only linktarget="_self"></gcse:searchresults-only>';
		
		//You can use HTML5-valid div tags as long as you observe these guidelines: //20140423
		//The class attribute must be set to gcse-XXX
		//Any attributes must be prefixed with data-.
		//$content .= '<gcse:' . $gcse_code . ' linktarget="_self"></gcse:' . $gcse_code . '>';
		$content .= '<div class="gcse-' . $gcse_code . '" data-linktarget="_self"></div>';
		
		$content .= '</div>';

		$content = apply_filters('wgs_shortcode_content', $content);
		
		return $content;
		
	}

	function wp_google_searchbox_shortcode( $atts ){
		
		$options = get_option( 'wgs_general_settings' );

		//if ($options['use_default_correction_css'] == 1)
		//	wp_enqueue_style( 'wgs', plugins_url('wgs.css', __FILE__) );

		$search_gcse_page_url = get_page_link( $options['search_gcse_page_id'] );

		if ( $options['support_overlay_display'] == 1 )
			$gcse_code = 'search';
		else
			$gcse_code = 'searchbox-only';
				
		$content  = '<div class="wgs_wrapper" id="wgs_widget_wrapper_id">';
		//You can use HTML5-valid div tags as long as you observe these guidelines: //20140423
		//The class attribute must be set to gcse-XXX
		//Any attributes must be prefixed with data-.
		//$content .= '<gcse:searchbox-only resultsUrl="' . $search_gcse_page_url . '"></gcse:searchbox-only>';
		$content .= '<div class="gcse-' . $gcse_code . '" data-resultsUrl="' . $search_gcse_page_url . '"></div>';
				
		$content .= '</div>';

		$content = apply_filters('wgs_searchbox_shortcode_content', $content);
		
		return $content;
		
	}
}

//Init WP_Google_Search class
$GLOBALS['wp_google_search'] = new WP_Google_Search_ALT();

}

