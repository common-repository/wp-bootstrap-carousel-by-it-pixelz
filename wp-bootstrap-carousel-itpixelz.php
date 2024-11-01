<?php
/**
 * @link              http://www.itpixel.com
 * @since             1.0.0
 * @package           wp_bootstrap_carousel
 *
 * @wordpress-plugin
 * Plugin Name:       WP Bootstrap Carousel by IT Pixelz
 * Plugin URI:        http://www.itpixelz.com
 * Description:       Bootstrap responsive carousel slider, just install in clicks and get ready your bootstrap slider for your website.
 * Version:           1.0
 * Author:            Umar Draz
 * Author URI:        http://www.itpixelz.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
*/

function wpbc_plugin_add_settings_link( $links ) {
    $settings_link = '<a href="options-general.php?page=bootstrap-carousel-settings">' . __( 'Settings' ) . '</a>';
    $settings_link_2 = '<a href="post-new.php?post_type=bootstapcarousel">' . __( 'Add New Slide' ) . '</a>';
    array_push( $links, $settings_link, $settings_link_2 );
  	return $links;
}
$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'wpbc_plugin_add_settings_link' );

 
add_action( 'wp_enqueue_scripts', 'register_wpbc_bootstrap_carousel_styles' );
function register_wpbc_bootstrap_carousel_styles() {
		wp_register_style( 'wpbc_bootstrap_carousel', plugins_url( 'wp-bootstrap-carousel-by-it-pixelz/css/style.css' ) );
		wp_enqueue_style( 'wpbc_bootstrap_carousel' );
	}

add_action('init', 'wpbc_bootstrap_carousel_initiate');

function wpbc_bootstrap_carousel_initiate(){
	$labels              = array(
	'name'               => _x('Carousel Sliders', 'post type general name', ''),
	'singular_name'      => _x('Carousel Slider', 'post type singular name', ''),
	'add_new'            => _x('Add New', 'print', ''),
	'add_new_item'       => __('Add New Slider', ''),
	'edit_item'          => __('Edit Slider', ''),
	'new_item'           => __('New Slider', ''),
	'all_items'          => __('All Sliders', ''),
	'view_item'          => __('View Slider', ''),
	'search_items'       => __('Search Sliders', ''),
	'not_found'          =>  __('No Sliders found', ''),
	'not_found_in_trash' => __('No Sliders found in Trash', ''), 
	'parent_item_colon'  => '',
	'menu_name'          => __('Sliders', '')
	);
	
	$args = array(
	'labels'              => $labels,
	'public'              => false,
	'publicly_queryable'  => true,
	'show_ui'             => true, 
	'show_in_menu'        => true, 
	'query_var'           => true,
	'capability_type'     => 'post',
	'has_archive'         => true, 
	'hierarchical'        => false,
	'menu_position'       => null,
	'exclude_from_search' => true,
	'publicly_queryable'  => true,
	'supports'            => array( 'title', 'editor', 'thumbnail' )
	); 
	register_post_type('bootstapcarousel', $args);
}

function wpbc_bootstrap_carousel_category_initiate() {

	$labels = array(
		'name'                       => _x( 'Categories', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Category', 'text_domain' ),
		'all_items'                  => __( 'All categories', 'text_domain' ),
		'parent_item'                => __( 'Parent category', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent category:', 'text_domain' ),
		'new_item_name'              => __( 'New category', 'text_domain' ),
		'add_new_item'               => __( 'Add New category', 'text_domain' ),
		'edit_item'                  => __( 'Edit category', 'text_domain' ),
		'update_item'                => __( 'Update category', 'text_domain' ),
		'view_item'                  => __( 'View category', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate categories with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove category', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular categories', 'text_domain' ),
		'search_items'               => __( 'Search category', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'bootcarouselcat', array( 'bootstapcarousel' ), $args );

}

add_action( 'init', 'wpbc_bootstrap_carousel_category_initiate', 0 );

add_action('admin_menu', 'wpbc_my_plugin_menu');

function wpbc_my_plugin_menu() {
	add_options_page('Carousel Settings', 'Carousel Settings', 'manage_options', 'bootstrap-carousel-settings', 'wpbc_carousel_settings_page');
	
}
function wpbc_carousel_settings_page(){
	include "admin-page.php";
}

add_action( 'admin_init', 'wpbc_carousel_options_init' );
function wpbc_carousel_options_init(){
	register_setting( 'wpbc_carousel_options', 'wpbc_carousel_options' );
}

function wpbc_how_boot_carousel_function( $atts ) {
	
 
	
	
	$options = get_option( 'wpbc_carousel_options' );
	add_action( 'wp_enqueue_scripts', 'wpbc_carousel_scripts' );
	
	
	if( ! function_exists('wpbc_carousel_scripts')){
	function wpbc_carousel_scripts() {
		wp_enqueue_style( 'stylesheet',  '/wp-bootstrap-carousel-by-it-pixelz/css/style.css');
	}
	}
 

	?>
	
	<?php 
	$wpdc_rand_id = rand(5,100);
	?>
	<div id="wpbc_carousel-<?php echo $wpdc_rand_id; ?>" class="carousel slide wpbc_carousel" data-ride="carousel">
  <!-- Indicators -->
  <?php if( $options['nav_slider'] == "Yes" ){?>
  
        <ol class="carousel-indicators">
            <?php
            global $post; $i = 0;
$argsz = array(); 
			$argsz['posts_per_page'] = $options['number_slides'];
			$argsz['post_type'] = 'bootstapcarousel';
			if( isset($atts['category']) && $atts['category'] != "all" ){
				
				$argsz['tax_query'] = array(
										array(
											'taxonomy' => 'bootcarouselcat',
											'field'    => 'slug',
											'terms'    =>  array( $atts['category'] )
										)
									);
				 
			}            
			$sliders = get_posts( $argsz );
            foreach( $sliders as $slider ) { setup_postdata($slider); ?>
            <li data-target="#wpbc_carousel-<?php echo $wpdc_rand_id; ?>" data-slide-to="<?php echo $i;?>" class="<?php if($i == 0){?> active <?php }?>"></li>
            <?php $i++;  }?>
        </ol>
        <?php }?>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
  
  
			<?php
			 
              
			$slider_query = new WP_Query( $argsz );

	/* The Loop */
	if ( $slider_query->have_posts() ) {
	 
	$i = 1;
	while ( $slider_query->have_posts() ) {
	$slider_query->the_post();
	?>
		<div class="item <?php if($i == 1){?> active <?php }?>">
                <?php the_post_thumbnail( 'full' );?>
				<?php if( $options['caption_carousel'] == "Yes" ){?>
                <div class="carousel-caption">
                	<h3 style="color:<?php echo $options['heading_color']; ?>"><?php the_title();?></h3>
                    <?php the_content();?>
                </div>
				<?php } ?>
            </div>
		<?php
		$i++;
	}
		 
	} else {
		/* no sliders found */
		?>
		<div class="item active">
                <img style="background:white !important;height:300px !important; width:100% !important;" />
				<?php if( $options['caption_carousel'] == "Yes" ){ ?>
                <div class="carousel-caption">
                	<h3 style="color:<?php echo $options['heading_color']; ?>">Please upload sliders!</h3>
                    
                </div>
				<?php } ?>
            </div>
		<?php
		 
	}
	/* Restore original Post Data */
	wp_reset_postdata();
		 ?>
  </div>
  <!-- Controls -->
        <?php if( $options['arrow_carousel'] == "Yes" ){?>
        <a class="left carousel-control" href="#wpbc_carousel-<?php echo $wpdc_rand_id; ?>" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#wpbc_carousel-<?php echo $wpdc_rand_id; ?>" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
        <?php } ?>	
</div>
    <?php
}
add_shortcode('show_bootstrap_carousel', 'wpbc_how_boot_carousel_function');
 
class wpbc_bootstrap_carousel_widget extends WP_Widget {

	 
	function __construct() {
		parent::__construct(
			'wpbc_how_boot_carousel_widget', // Base ID
			__( 'WP Bootstrap Carousel', 'text_domain' ), // Name
			array( 'description' => __( 'Show Bootstrap Carousel', 'text_domain' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		 
		 
		echo do_shortcode('[show_bootstrap_carousel]');
		 
	}
 

} 
function wpbc_bootstrap_carousel_register_widget() {
    register_widget( 'wpbc_bootstrap_carousel_widget' );
}
add_action( 'widgets_init', 'wpbc_bootstrap_carousel_register_widget' );
?>