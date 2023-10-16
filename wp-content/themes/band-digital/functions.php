<?php

if (!function_exists('band_digital_setup')) {
  function band_digital_setup()
  {
    add_theme_support('custom-logo', [
      'height' => 50,
      'width' => 130,
      'flex-width' => false,
      'flex-height' => false,
      'header-text' => '',
      'unlink-homepage-logo' => false,
    ]);
    add_theme_support('html5', array(
      'comment-list',
      'comment-form',
      'search-form',
      'gallery',
      'caption',
      'script',
      'style',
    ));
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
  set_post_thumbnail_size(730, 480);
  }
  add_action('after_setup_theme', 'band_digital_setup');
}
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style( 'main', get_stylesheet_uri());
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() .'/plugins/bootstrap/bootstrap.min.css', array('main'), null );
    wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/plugins/fontawesome/css/all.css', array('main'), null );
    wp_enqueue_style( 'icofont', get_template_directory_uri() . '/plugins/icofont/icofont.css', array('main'), null);
    wp_enqueue_style( 'style', get_template_directory_uri() . '/css/style.css', array('icofont'), null);
    wp_enqueue_style( 'favicon', get_template_directory_uri() . '/images/favicon.png', array('icofont'), null);

    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', get_template_directory_uri() . '/plugins/jquery/jquery.min.js');
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/plugins/bootstrap/bootstrap.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script( 'googleapis', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU', array('jquery'), '1.0.0', true);
    wp_enqueue_script('google-map', get_template_directory_uri() . '/plugins/google-map/map.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('js-script', get_template_directory_uri() . '/js/script.js"', array('jquery'), '1.0.0', true);
});
add_theme_support('post-thumbnails');
add_theme_support('title-tag');
add_theme_support('custom-logo');
add_filter( 'upload_mimes', function ( $mimes ) {
    $mimes['svg']  = 'image/svg+xml';

    return $mimes;
});

add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5 );

# Исправление MIME типа для SVG файлов.
function fix_svg_mime_type( $data, $file, $filename, $mimes, $real_mime = '' ){

    // WP 5.1 +
    if( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) ){
        $dosvg = in_array( $real_mime, [ 'image/svg', 'image/svg+xml' ] );
    }
    else {
        $dosvg = ( '.svg' === strtolower( substr( $filename, -4 ) ) );
    }

    // mime тип был обнулен, поправим его
    // а также проверим право пользователя
    if( $dosvg ){

        // разрешим
        if( current_user_can('manage_options') ){

            $data['ext']  = 'svg';
            $data['type'] = 'image/svg+xml';
        }
        // запретим
        else {
            $data['ext']  = false;
            $data['type'] = false;
        }

    }

    return $data;
}

function band_digital_menus() {
  // собираем несколько зон (областей) меню
$locations = array(
  'header' => __( 'Header Menu', 'band_digital'),
  'footer_left' => __( 'Footer Left Menu', 'band_digital' ),
  'footer_right' => __( 'Footer Right Menu', 'band_digital' ),
);
  register_nav_menus($locations);
}
add_action( 'init', 'band_digital_menus' );
/**
 * Class Name: wp_bootstrap4_navwalker
 * GitHub URI: https://github.com/twittem/wp-bootstrap-navwalker
 * Description: A custom WordPress nav walker class to implement the Bootstrap 4 navigation style in a custom theme using the WordPress built in menu manager.
 * Version: 2.0.4
 * Author: Edward McIntyre - @twittem
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
class wp_bootstrap4_navwalker extends Walker_Nav_Menu
{
  /**
   * @param string $output Passed by reference. Used to append additional content.
   * @param int $depth Depth of page. Used for padding.
   * @see Walker::start_lvl()
   * @since 3.0.0
   *
   */
  public function start_lvl(&$output, $depth = 0, $args = array())
  {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<div role=\"menu\" class=\" dropdown-menu\">\n";
  }

  /**
   * Ends the list of after the elements are added.
   *
   * @param string $output Passed by reference. Used to append additional content.
   * @param int $depth Depth of menu item. Used for padding.
   * @param array $args An array of arguments. @see wp_nav_menu()
   * @since 3.0.0
   *
   * @see Walker::end_lvl()
   *
   */
  public function end_lvl(&$output, $depth = 0, $args = array())
  {
    $indent = str_repeat("\t", $depth);
    $output .= "$indent</div>\n";
  }

  /**
   * Start the element output.
   *
   * @param string $output Passed by reference. Used to append additional content.
   * @param object $item Menu item data object.
   * @param int $depth Depth of menu item. Used for padding.
   * @param array $args An array of arguments. @see wp_nav_menu()
   * @param int $id Current item ID.
   * @since 3.0.0
   *
   * @see Walker::start_el()
   *
   */
  public function end_el(&$output, $item, $depth = 0, $args = array())
  {
    if ($depth === 1) {
      if (strcasecmp($item->attr_title, 'divider') == 0 || strcasecmp($item->title, 'divider') == 0) {
        $output .= '</div>';
      } else if ($depth === 1 && (strcasecmp($item->attr_title, 'header') == 0 && $depth === 1)) {
        $output .= '</h6>';
      }
    } else {
      $output .= '</li>';
    }
  }

  /**
   * @param string $output Passed by reference. Used to append additional content.
   * @param object $item Menu item data object.
   * @param int $depth Depth of menu item. Used for padding.
   * @param int $current_page Menu item ID.
   * @param object $args
   * @since 3.0.0
   *
   * @see Walker::start_el()
   */
  public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
  {
    $indent = ($depth) ? str_repeat("\t", $depth) : '';
    /**
     * Dividers, Headers or Disabled
     * =============================
     * Determine whether the item is a Divider, Header, Disabled or regular
     * menu item. To prevent errors we use the strcasecmp() function to so a
     * comparison that is not case sensitive. The strcasecmp() function returns
     * a 0 if the strings are equal.
     */
    //( strcasecmp($item->attr_title, 'disabled' ) == 0 )

    if ($depth === 1 && (strcasecmp($item->attr_title, 'divider') == 0 || strcasecmp($item->title, 'divider') == 0)) {
      $output .= $indent . '<div class="dropdown-divider">';
    } else if ((strcasecmp($item->attr_title, 'header') == 0 && $depth === 1) && $depth === 1) {
      $output .= $indent . '<h6 class="dropdown-header">' . esc_attr($item->title);
    } else {
      $class_names = $value = '';
      $classes = empty($item->classes) ? array() : (array)$item->classes;

      $atts = array();
      $atts['title'] = !empty($item->title) ? $item->title : '';
      $atts['target'] = !empty($item->target) ? $item->target : '';
      $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
      $atts['href'] = !empty($item->url) ? $item->url : '';
      $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);

      if (in_array('current-menu-item', $classes))
        $classes[] = ' active';
      if ($depth === 0) {
        $classes[] = 'nav-item';
        $classes[] = 'nav-item-' . $item->ID;
        $atts['class'] = 'nav-link';
        if ($args->has_children) {
          $classes[] = ' dropdown';
          $atts['href'] = '#';
          $atts['data-toggle'] = 'dropdown';
          $atts['class'] = 'dropdown-toggle nav-link';
          $atts['role'] = 'button';
          $atts['aria-haspopup'] = 'true';
        }
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        $output .= $indent . '<li' . $id . $value . $class_names . '>';
      } else {
        $classes[] = 'dropdown-item';
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $atts['class'] = $class_names;
        $atts['id'] = $id;
      }

      $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);
      $attributes = '';
      foreach ($atts as $attr => $value) {
        if (!empty($value)) {
          $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
          $attributes .= ' ' . $attr . '="' . $value . '"';
        }
      }
      $item_output = $args->before;
      $item_output .= '<a' . $attributes . '>';

      /*
       * Icons
       * ===========
       * Since the the menu item is NOT a Divider or Header we check the see
       * if there is a value in the attr_title property. If the attr_title
       * property is NOT null we apply it as the class name for the icon
       */
      if (!empty($item->attr_title)) {
        $item_output .= '<span class="' . esc_attr($item->attr_title) . '"></span>&nbsp;';
      }
      $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
      $item_output .= '</a>';
      $item_output .= $args->after;
      $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
  }

  /**
   * Traverse elements to create list from elements.
   *
   * Display one element if the element doesn't have any children otherwise,
   * display the element and its children. Will only traverse up to the max
   * depth and no ignore elements under that depth.
   *
   * This method shouldn't be called directly, use the walk() method instead.
   *
   * @param object $element Data object
   * @param array $children_elements List of elements to continue traversing.
   * @param int $max_depth Max depth to traverse.
   * @param int $depth Depth of current element.
   * @param array $args
   * @param string $output Passed by reference. Used to append additional content.
   * @return null Null on failure with no changes to parameters.
   * @since 2.5.0
   *
   * @see Walker::start_el()
   */
  public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
  {
    if (!$element)
      return;
    $id_field = $this->db_fields['id'];
    // Display this element.
    if (is_object($args[0]))
      $args[0]->has_children = !empty($children_elements[$element->$id_field]);
    parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
  }

  /**
   * Menu Fallback
   * =============
   * If this function is assigned to the wp_nav_menu's fallback_cb variable
   * and a manu has not been assigned to the theme location in the WordPress
   * menu manager the function with display nothing to a non-logged in user,
   * and will add a link to the WordPress menu manager if logged in as an admin.
   *
   * @param array $args passed from the wp_nav_menu function.
   *
   */
  public static function fallback($args)
  {
    if (current_user_can('manage_options')) {
      extract($args);
      $fb_output = null;
      if ($container) {
        $fb_output = '<' . $container;
        if ($container_id)
          $fb_output .= ' id="' . $container_id . '"';
        if ($container_class)
          $fb_output .= ' class="' . $container_class . '"';
        $fb_output .= '>';
      }
      $fb_output .= '<ul';
      if ($menu_id)
        $fb_output .= ' id="' . $menu_id . '"';
      if ($menu_class)
        $fb_output .= ' class="' . $menu_class . '"';
      $fb_output .= '>';
      $fb_output .= '<li><a href="' . admin_url('nav-menus.php') . '">Add a menu</a></li>';
      $fb_output .= '</ul>';
      if ($container)
        $fb_output .= '</' . $container . '>';
      echo $fb_output;
    }
  }
}
  ## отключаем создание миниатюр файлов для указанных размеров
  add_filter( 'intermediate_image_sizes', 'delete_intermediate_image_sizes' );




  function delete_intermediate_image_sizes( $sizes ){

    // размеры которые нужно удалить
    return array_diff( $sizes, [
      'medium_large',
      'large',
      '1536x1536',
      '2048x2048',
    ] );
}

// удаляет H2 из шаблона пагинации
add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
function my_navigation_template( $template, $class ){
  return '
	<nav class="navigation %1$s" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>
	';
}

// выводим пагинацию
the_posts_pagination( array(
  'end_size' => 2,
) );
add_action( 'widgets_init', 'band_digital_widgets_init');
function band_digital_widgets_init() {
  register_sidebar( array(
  'name'=> esc_html__('Сайдбар блогa', 'band_digital'),
  'id' => "sidebar-blog",
  'before_widget' => '<section id="%1$s" class="sidebar-widget %2$s">',
  'after_widget' => '</section>',
  'before_title' => '<h5 class="widget-title mb-3">',
  'after_title' => '</h5>'
  ));
  register_sidebar( array(
  'name'=> esc_html__('Текст в подвале', 'band_digital'),
  'id' => "sidebar-footer-text",
  'before_widget' => '<div class="footer-widget footer-link %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<h4>',
  'after_title' => '</h4>'
  ));
  register_sidebar( array(
  'name'=> esc_html__('Контакты в подвале', 'band_digital'),
  'id' => "sidebar-footer-contacts",
  'before_widget' => '<div class="footer-widget footer-text %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<h4>',
  'after_title' => '</h4>'
  ));
 }

/**
 * Добавление нового виджета Download_Widget.
 */
class Download_Widget extends WP_Widget {

  // Регистрация виджета используя основной класс
  function __construct() {
    // вызов конструктора выглядит так:
    // __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
    parent::__construct(
      'download_didget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: download_didget
      'Полезные файлы',
      array( 'description' => 'Прикрепите ссылки', 'classname' => 'download', )
    );

    // скрипты/стили виджета, только если он активен
    if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
      add_action('wp_enqueue_scripts', array( $this, 'add_download_scripts' ));
      add_action('wp_head', array( $this, 'add_download_style' ) );
    }
  }

  /**
   * Вывод виджета во Фронт-энде
   *
   * @param array $args     аргументы виджета.
   * @param array $instance сохраненные данные из настроек
   */
  function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance['title'] );
    $file_name = $instance['file_name'];
    $file = $instance['file'];

    echo $args['before_widget'];
    if ( ! empty( $title ) ) {
      echo $args['before_title'] . $title . $args['after_title'];
    }
    echo '<a href="'.$file.'"><i class="fa fa-file-pdf"></i>'.$file_name.'</a>';
    echo $args['after_widget'];
  }

  /**
   * Админ-часть виджета
   *
   * @param array $instance сохраненные данные из настроек
   */
  function form( $instance ) {
    $title = @ $instance['title'] ?: 'Полезные файлы';
    $file_name = @ $instance['file_name'] ?: 'Название файла';
    $file = @ $instance['file'] ?: 'URL файла';

    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'file_name' ); ?>"><?php _e( 'Название файла:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'file_name' ); ?>" name="<?php echo $this->get_field_name( 'file_name' ); ?>" type="text" value="<?php echo esc_attr( $file_name ); ?>">
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'file' ); ?>"><?php _e( 'Ссылка на файл:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'file' ); ?>" name="<?php echo $this->get_field_name( 'file' ); ?>" type="text" value="<?php echo esc_attr( $file ); ?>">
    </p>
    <?php
  }

  /**
   * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
   *
   * @see WP_Widget::update()
   *
   * @param array $new_instance новые настройки
   * @param array $old_instance предыдущие настройки
   *
   * @return array данные которые будут сохранены
   */
  function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['file_name'] = ( ! empty( $new_instance['file_name'] ) ) ? strip_tags( $new_instance['file_name'] ) : '';
    $instance['file'] = ( ! empty( $new_instance['file'] ) ) ? strip_tags( $new_instance['file'] ) : '';

    return $instance;
  }

  // скрипт виджета
  function add_download_scripts() {
    // фильтр чтобы можно было отключить скрипты
    if( ! apply_filters( 'show_download_script', true, $this->id_base ) )
      return;

    $theme_url = get_template_directory_uri();

    // wp_enqueue_script('download_script', $theme_url .'/js/download_script.js' );
  }

  // стили виджета
  function add_download_style() {
    // фильтр чтобы можно было отключить стили
    if( ! apply_filters( 'show_download_style', true, $this->id_base ) )
      return;
    ?>
    <style type="text/css">
      .download a{ display:inline; }
    </style>
    <?php
  }

}

add_action( 'widgets_init', 'register_download_widget' );

function register_download_widget() {
  register_widget( 'Download_Widget' );
}

class Bootstrap_Walker_Comment extends Walker {

	/**
	 * What the class handles.
	 *
	 * @since 2.7.0
	 * @var string
	 *
	 * @see Walker::$tree_type
	 */
	public $tree_type = 'comment';

	/**
	 * Database fields to use.
	 *
	 * @since 2.7.0
	 * @var string[]
	 *
	 * @see Walker::$db_fields
	 * @todo Decouple this
	 */
	public $db_fields = array(
		'parent' => 'comment_parent',
		'id'     => 'comment_ID',
	);

	/**
	 * Starts the list before the elements are added.
	 *
	 * @since 2.7.0
	 *
	 * @see Walker::start_lvl()
	 * @global int $comment_depth
	 *
	 * @param string $output Used to append additional content (passed by reference).
	 * @param int    $depth  Optional. Depth of the current comment. Default 0.
	 * @param array  $args   Optional. Uses 'style' argument for type of HTML list. Default empty array.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 1;

		switch ( $args['style'] ) {
			case 'div':
				break;
			case 'ol':
				$output .= '<ol class="children">' . "\n";
				break;
			case 'ul':
			default:
				$output .= '<ul class="children">' . "\n";
				break;
		}
	}

	/**
	 * Ends the list of items after the elements are added.
	 *
	 * @since 2.7.0
	 *
	 * @see Walker::end_lvl()
	 * @global int $comment_depth
	 *
	 * @param string $output Used to append additional content (passed by reference).
	 * @param int    $depth  Optional. Depth of the current comment. Default 0.
	 * @param array  $args   Optional. Will only append content if style argument value is 'ol' or 'ul'.
	 *                       Default empty array.
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 1;

		switch ( $args['style'] ) {
			case 'div':
				break;
			case 'ol':
				$output .= "</ol><!-- .children -->\n";
				break;
			case 'ul':
			default:
				$output .= "</ul><!-- .children -->\n";
				break;
		}
	}

	/**
	 * Traverses elements to create list from elements.
	 *
	 * This function is designed to enhance Walker::display_element() to
	 * display children of higher nesting levels than selected inline on
	 * the highest depth level displayed. This prevents them being orphaned
	 * at the end of the comment list.
	 *
	 * Example: max_depth = 2, with 5 levels of nested content.
	 *     1
	 *      1.1
	 *        1.1.1
	 *        1.1.1.1
	 *        1.1.1.1.1
	 *        1.1.2
	 *        1.1.2.1
	 *     2
	 *      2.2
	 *
	 * @since 2.7.0
	 *
	 * @see Walker::display_element()
	 * @see wp_list_comments()
	 *
	 * @param WP_Comment $element           Comment data object.
	 * @param array      $children_elements List of elements to continue traversing. Passed by reference.
	 * @param int        $max_depth         Max depth to traverse.
	 * @param int        $depth             Depth of the current element.
	 * @param array      $args              An array of arguments.
	 * @param string     $output            Used to append additional content. Passed by reference.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		if ( ! $element ) {
			return;
		}

		$id_field = $this->db_fields['id'];
		$id       = $element->$id_field;

		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

		/*
		 * If at the max depth, and the current element still has children, loop over those
		 * and display them at this level. This is to prevent them being orphaned to the end
		 * of the list.
		 */
		if ( $max_depth <= $depth + 1 && isset( $children_elements[ $id ] ) ) {
			foreach ( $children_elements[ $id ] as $child ) {
				$this->display_element( $child, $children_elements, $max_depth, $depth, $args, $output );
			}

			unset( $children_elements[ $id ] );
		}

	}

	/**
	 * Starts the element output.
	 *
	 * @since 2.7.0
	 * @since 5.9.0 Renamed `$comment` to `$data_object` and `$id` to `$current_object_id`
	 *              to match parent class for PHP 8 named parameter support.
	 *
	 * @see Walker::start_el()
	 * @see wp_list_comments()
	 * @global int        $comment_depth
	 * @global WP_Comment $comment       Global comment object.
	 *
	 * @param string     $output            Used to append additional content. Passed by reference.
	 * @param WP_Comment $data_object       Comment data object.
	 * @param int        $depth             Optional. Depth of the current comment in reference to parents. Default 0.
	 * @param array      $args              Optional. An array of arguments. Default empty array.
	 * @param int        $current_object_id Optional. ID of the current comment. Default 0.
	 */
	public function start_el( &$output, $data_object, $depth = 0, $args = array(), $current_object_id = 0 ) {
		// Restores the more descriptive, specific name for use within this method.
		$comment = $data_object;

		$depth++;
		$GLOBALS['comment_depth'] = $depth;
		$GLOBALS['comment']       = $comment;

		if ( ! empty( $args['callback'] ) ) {
			ob_start();
			call_user_func( $args['callback'], $comment, $args, $depth );
			$output .= ob_get_clean();
			return;
		}

		if ( 'comment' === $comment->comment_type ) {
			add_filter( 'comment_text', array( $this, 'filter_comment_text' ), 40, 2 );
		}

		if ( ( 'pingback' === $comment->comment_type || 'trackback' === $comment->comment_type ) && $args['short_ping'] ) {
			ob_start();
			$this->ping( $comment, $depth, $args );
			$output .= ob_get_clean();
		} elseif ( 'html5' === $args['format'] ) {
			ob_start();
			$this->html5_comment( $comment, $depth, $args );
			$output .= ob_get_clean();
		} else {
			ob_start();
			$this->comment( $comment, $depth, $args );
			$output .= ob_get_clean();
		}

		if ( 'comment' === $comment->comment_type ) {
			remove_filter( 'comment_text', array( $this, 'filter_comment_text' ), 40 );
		}
	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @since 2.7.0
	 * @since 5.9.0 Renamed `$comment` to `$data_object` to match parent class for PHP 8 named parameter support.
	 *
	 * @see Walker::end_el()
	 * @see wp_list_comments()
	 *
	 * @param string     $output      Used to append additional content. Passed by reference.
	 * @param WP_Comment $data_object Comment data object.
	 * @param int        $depth       Optional. Depth of the current comment. Default 0.
	 * @param array      $args        Optional. An array of arguments. Default empty array.
	 */
	public function end_el( &$output, $data_object, $depth = 0, $args = array() ) {
		if ( ! empty( $args['end-callback'] ) ) {
			ob_start();
			call_user_func(
				$args['end-callback'],
				$data_object, // The current comment object.
				$args,
				$depth
			);
			$output .= ob_get_clean();
			return;
		}
		if ( 'div' === $args['style'] ) {
			$output .= "</div><!-- #comment-## -->\n";
		} else {
			$output .= "</li><!-- #comment-## -->\n";
		}
	}

	/**
	 * Outputs a pingback comment.
	 *
	 * @since 3.6.0
	 *
	 * @see wp_list_comments()
	 *
	 * @param WP_Comment $comment The comment object.
	 * @param int        $depth   Depth of the current comment.
	 * @param array      $args    An array of arguments.
	 */
	protected function ping( $comment, $depth, $args ) {
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
		?>
		<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( '', $comment ); ?>>
			<div class="comment-body">
				<?php _e( 'Pingback:' ); ?> <?php comment_author_link( $comment ); ?> <?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
			</div>
		<?php
	}

	/**
	 * Filters the comment text.
	 *
	 * Removes links from the pending comment's text if the commenter did not consent
	 * to the comment cookies.
	 *
	 * @since 5.4.2
	 *
	 * @param string          $comment_text Text of the current comment.
	 * @param WP_Comment|null $comment      The comment object. Null if not found.
	 * @return string Filtered text of the current comment.
	 */
	public function filter_comment_text( $comment_text, $comment ) {
		$commenter          = wp_get_current_commenter();
		$show_pending_links = ! empty( $commenter['comment_author'] );

		if ( $comment && '0' == $comment->comment_approved && ! $show_pending_links ) {
			$comment_text = wp_kses( $comment_text, array() );
		}

		return $comment_text;
	}

	/**
	 * Outputs a single comment.
	 *
	 * @since 3.6.0
	 *
	 * @see wp_list_comments()
	 *
	 * @param WP_Comment $comment Comment to display.
	 * @param int        $depth   Depth of the current comment.
	 * @param array      $args    An array of arguments.
	 */
	protected function comment( $comment, $depth, $args ) {
		if ( 'div' === $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}

		$commenter          = wp_get_current_commenter();
		$show_pending_links = isset( $commenter['comment_author'] ) && $commenter['comment_author'];

		if ( $commenter['comment_author_email'] ) {
			$moderation_note = __( 'Your comment is awaiting moderation.' );
		} else {
			$moderation_note = __( 'Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.' );
		}
		?>
		<<?php echo $tag; ?> <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?> id="comment-<?php comment_ID(); ?>">
		<?php if ( 'div' !== $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
		<?php endif; ?>
		<div class="comment-author vcard">
			<?php
			if ( 0 != $args['avatar_size'] ) {
				echo get_avatar( $comment, $args['avatar_size'] );
			}
			?>
			<?php
			$comment_author = get_comment_author_link( $comment );

			if ( '0' == $comment->comment_approved && ! $show_pending_links ) {
				$comment_author = get_comment_author( $comment );
			}

			printf(
				/* translators: %s: Comment author link. */
				__( '%s <span class="says">says:</span>' ),
				sprintf( '<cite class="fn">%s</cite>', $comment_author )
			);
			?>
		</div>
		<?php if ( '0' == $comment->comment_approved ) : ?>
		<em class="comment-awaiting-moderation"><?php echo $moderation_note; ?></em>
		<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata">
			<?php
			printf(
				'<a href="%s">%s</a>',
				esc_url( get_comment_link( $comment, $args ) ),
				sprintf(
					/* translators: 1: Comment date, 2: Comment time. */
					__( '%1$s at %2$s' ),
					get_comment_date( '', $comment ),
					get_comment_time()
				)
			);

			edit_comment_link( __( '(Edit)' ), ' &nbsp;&nbsp;', '' );
			?>
		</div>

		<?php
		comment_text(
			$comment,
			array_merge(
				$args,
				array(
					'add_below' => $add_below,
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
				)
			)
		);
		?>

		<?php
		comment_reply_link(
			array_merge(
				$args,
				array(
					'add_below' => $add_below,
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply">',
					'after'     => '</div>',
				)
			)
		);
		?>

		<?php if ( 'div' !== $args['style'] ) : ?>
		</div>
		<?php endif; ?>
		<?php
	}

	/**
	 * Outputs a comment in the HTML5 format.
	 *
	 * @since 3.6.0
	 *
	 * @see wp_list_comments()
	 *
	 * @param WP_Comment $comment Comment to display.
	 * @param int        $depth   Depth of the current comment.
	 * @param array      $args    An array of arguments.
	 */
	protected function html5_comment( $comment, $depth, $args ) {
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

		$commenter          = wp_get_current_commenter();
		$show_pending_links = ! empty( $commenter['comment_author'] );

		if ( $commenter['comment_author_email'] ) {
			$moderation_note = __( 'Your comment is awaiting moderation.' );
		} else {
			$moderation_note = __( 'Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.' );
		}
		?>
		<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="media mb-4">
        <?php
        if ( 0 != $args['avatar_size'] ) {
          echo get_avatar( $comment, $args['avatar_size'], 'mystery', '', array('class' => 'img-fluid d-flex mr-4 rounded') );
        }
        ?>
        <footer>
						<?php
						$comment_author = get_comment_author_link( $comment );

						if ( '0' == $comment->comment_approved && ! $show_pending_links ) {
							$comment_author = get_comment_author( $comment );
						}

						printf(
							__( '%s' ),
							sprintf( '<h5>%s</h5>', $comment_author )
						);
						?>

					<div class="comment-metadata">
						<?php
						printf(
							'<a href="%s" class="text-muted"><time datetime="%s">%s</time></a>',
							esc_url( get_comment_link( $comment, $args ) ),
							get_comment_time( '' ),
							sprintf(
								/* translators: 1: Comment date, 2: Comment time. */
								__( '%1$s at %2$s' ),
								get_comment_date( 'j F Y', $comment ),
								get_comment_time('')
							)
						);

						edit_comment_link( __( 'Edit' ), ' <span class="edit-link">', '</span>' );
						?>
					</div><!-- .comment-metadata -->

					<?php if ( '0' == $comment->comment_approved ) : ?>
					<em class="comment-awaiting-moderation"><?php echo $moderation_note; ?></em>
					<?php endif; ?>
				<div class="mt-2">
					<?php comment_text(); ?>
				</div><!-- .comment-content -->
				<?php
				if ( '1' == $comment->comment_approved || $show_pending_links ) {
					comment_reply_link(
						array_merge(
							$args,
							array(
								'add_below' => 'div-comment',
								'depth'     => $depth,
								'max_depth' => $args['max_depth'],
								'before'    => '<div class="reply">',
								'after'     => '</div>',
							)
						)
					);
				}
				?>
				</footer><!-- .comment-meta -->


			</article><!-- .comment-body -->
		<?php
	}
}

add_action('init', 'my_custom_init');
function my_custom_init(){
  register_post_type('book', array(
    'labels'             => array(
      'name'               => 'Книги', // Основное название типа записи
      'singular_name'      => 'Книга', // отдельное название записи типа Book
      'add_new'            => 'Добавить новую',
      'add_new_item'       => 'Добавить новую книгу',
      'edit_item'          => 'Редактировать книгу',
      'new_item'           => 'Новая книга',
      'view_item'          => 'Посмотреть книгу',
      'search_items'       => 'Найти книгу',
      'not_found'          => 'Книг не найдено',
      'not_found_in_trash' => 'В корзине книг не найдено',
      'parent_item_colon'  => '',
      'menu_name'          => 'Книги'

    ),
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => true,
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'supports'           => array('title','editor','author','thumbnail','excerpt','comments')
  ) );
}

// Регистрируем тип записи услуги
add_action('init', 'new_post_type');
function new_post_type(){
  register_post_type('service', array(
  'labels' => array(
    'name'=> __("Услуги"),
    'singular_name' => __("Услуга"),
    'add_new' => __("Добавить новую"),
    'add_new_item' => __("Добавить новую услугу"),
    'edit_item' => __("Редактировать услугу"),
    'new_item'  => __("Новая услуга"),
    'view_item' => __("Посмотреть услугу"),
    'search_items' => ("Найти услугу"),
    'not found' => __("Услуг не найдено"),
    'not_found_in_trash' => __("В корзине услуг не найдено"),
    'parent_item_colon' => '',
    'menu_name' => __("Услуги")
  ),
  'public' => true,
  'publicly_queryable' => true,
  'show_ui' => true,
  'show_in_menu' => true,
  'query_var' => true,
  'rewrite' => true,
  'capability_type' => 'post',
  'taxonomies' => array('spheres'),
  'has_archive' => true,
  'hierarchical' => false,
  'menu_position' => 5,
  'supports' =>  array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields')
  ));
}
add_shortcode( 'iframe', 'Generate_iframe' );

function Generate_iframe( $atts ) {
  $atts = shortcode_atts( array(
    'href'   => 'http://wp-kama.ru',
    'height' => '550px',
    'width'  => '600px',
  ), $atts );

  return '<iframe src="'. $atts['href'] .'" width="'. $atts['width'] .'" height="'. $atts['height'] .'"> <p>Your Browser does not support Iframes.</p></iframe>';
}

// использование:
// [iframe href="http://wp-kama.ru" height="480" width="640"]

// хук для регистрации
add_action( 'init', 'create_taxonomy' );
function create_taxonomy(){

  // список параметров: wp-kama.ru/function/get_taxonomy_labels
  register_taxonomy( 'spheres', [ 'service' ], [
    'label'                 => '', // определяется параметром $labels->name
    'labels'                => [
      'name'              => 'spheres',
      'singular_name'     => 'sphere',
      'search_items'      => 'Search spheres',
      'all_items'         => 'All spheres',
      'view_item '        => 'View sphere',
      'parent_item'       => 'Parent sphere',
      'parent_item_colon' => 'Parent sphere:',
      'edit_item'         => 'Edit sphere',
      'update_item'       => 'Update sphere',
      'add_new_item'      => 'Add New sphere',
      'new_item_name'     => 'New Genre sphere',
      'menu_name'         => 'sphere',
      'back_to_items'     => '← Back to sphere',
    ],
    'description'           => 'Spheres', // описание таксономии
    'public'                => true,
    'publicly_queryable'    => null, // равен аргументу public
    'hierarchical'          => false,
    'exclude_from_search' => false,
  ] );
}
?>
