<?php
/**
 * Custom functions
 */

 /**
  * Add custom taxonomies
  *
  * Additional custom taxonomies can be defined here
  * http://codex.wordpress.org/Function_Reference/register_taxonomy
  */
 function add_custom_taxonomies() {
     
 	// Add new "Featured" taxonomy to Posts, Pages
 	register_taxonomy('featured', array('page','post','applications'), array(
 		// Hierarchical taxonomy (like categories)
 		'hierarchical' => true,
 		// This array of options controls the labels displayed in the WordPress Admin UI
 		'labels' => array(
 			'name' => _x( 'Featured Content', 'taxonomy general name' ),
 			'singular_name' => _x( 'Feature Content Type', 'taxonomy singular name' ),
 			'search_items' =>  __( 'Search Featured Content' ),
 			'all_items' => __( 'All Featured Content' ),
 			'parent_item' => __( 'Parent Feature Content' ),
 			'parent_item_colon' => __( 'Parent Feature Content:' ),
 			'edit_item' => __( 'Edit Featured Content' ),
 			'update_item' => __( 'Update Featured Content' ),
 			'add_new_item' => __( 'Add New Featured Content Type' ),
 			'new_item_name' => __( 'New Featured Content Type' ),
 			'menu_name' => __( 'Featured Content' ),
 		),
 		// Control the slugs used for this taxonomy
 		'rewrite' => array(
 			'slug' => '', // This controls the base slug that will display before each term
 			'with_front' => false, // Don't display the category base before "/featured/"
 			'hierarchical' => true // This will allow URL's like "/featured/highlights/something"
 		),
 	));
 	
 }
 add_action( 'init', 'add_custom_taxonomies', 0 );
 
 
 
 /**
  * Redirect topic introduction pages to their topic landing page
  *
 **/
 function redirect_intro() {
     
     if(is_page() OR is_single()) {

       $post       = &get_post($post->ID);
       $intro_page = has_term( 'browse', 'featured', $post );
       
       if($intro_page) {
           $categories         = get_the_category( $post->ID );
           $category_slug      = $categories[0]->slug;
           $redirect           = home_url() . '/' . $category_slug;
       
           wp_redirect( $redirect, 301 ); exit;    
       }  

     }

   
 }
 
add_action( 'wp', 'redirect_intro', 100);

/**
 * De-register stylesheets based on certain conditions
 */
function datagov_deregister_styles() {
  // style handles to de-register
  $styles = array('ccf-standards',
    'ccf-colorpicker', 
    'ccf-jquery-ui', 
    'CCFStandardsCSS', 
    'CCFFormsCSS', 
    'ccf-dashboard', 
    'ccf-admin',
  );

  // script handles to de-register
  $scripts = array('ccf-main',
    'jquery-tools',
    'ccf-datepicker',
  );

  // de-register styles/scripts on all pages except admin pages
  if (!is_admin()) {
    foreach($styles as $style) {
      wp_deregister_style($style);
    }
    foreach($scripts as $script) {
      wp_deregister_script($script);
    }
  }
}

add_action( 'wp_print_styles', 'datagov_deregister_styles', 100 );
