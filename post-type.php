<?php
if(!class_exists('WP_Simple_CRM_PostType')){
	class WP_Simple_CRM_PostType{
		private $post_type, $post_labels, $tag_labels, $cat_labels;
		
	    function __construct() {
	    	$this->post_type = apply_filters('simple_crm_post_type', 'customer');
	    	$this->post_labels = array(
				'name'                  => _x( 'Customers', 'Post Type General Name', 'simple_crm' ),
				'singular_name'         => _x( 'Customer', 'Post Type Singular Name', 'simple_crm' ),
				'menu_name'             => __( 'Customers', 'simple_crm' ),
				'name_admin_bar'        => __( 'Post Type', 'simple_crm' ),
				'archives'              => __( 'Customer Archives', 'simple_crm' ),
				'attributes'            => __( 'Customer Attributes', 'simple_crm' ),
				'parent_item_colon'     => __( 'Parent Customer:', 'simple_crm' ),
				'all_items'             => __( 'All Customers', 'simple_crm' ),
				'add_new_item'          => __( 'Add New Customer', 'simple_crm' ),
				'add_new'               => __( 'Add Customer', 'simple_crm' ),
				'new_item'              => __( 'New Customer', 'simple_crm' ),
				'edit_item'             => __( 'Edit Customer', 'simple_crm' ),
				'update_item'           => __( 'Update Customer', 'simple_crm' ),
				'view_item'             => __( 'View Customer', 'simple_crm' ),
				'view_items'            => __( 'View Customers', 'simple_crm' ),
				'search_items'          => __( 'Search Customers', 'simple_crm' ),
				'not_found'             => __( 'Not found', 'simple_crm' ),
				'not_found_in_trash'    => __( 'Not found in Trash', 'simple_crm' ),
				'featured_image'        => __( 'Featured Image', 'simple_crm' ),
				'set_featured_image'    => __( 'Set featured image', 'simple_crm' ),
				'remove_featured_image' => __( 'Remove featured image', 'simple_crm' ),
				'use_featured_image'    => __( 'Use as featured image', 'simple_crm' ),
				'insert_into_item'      => __( 'Insert into Customer', 'simple_crm' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Customer', 'simple_crm' ),
				'items_list'            => __( 'Customer list', 'simple_crm' ),
				'items_list_navigation' => __( 'Customer list navigation', 'simple_crm' ),
				'filter_items_list'     => __( 'Filter Customer list', 'simple_crm' ),
			);

			$this->tag_labels = array(
				'name'                       => _x( 'Customer Tags', 'Taxonomy General Name', 'simple_crm' ),
				'singular_name'              => _x( 'Customer Tag', 'Taxonomy Singular Name', 'simple_crm' ),
				'menu_name'                  => __( 'Customer Tags', 'simple_crm' ),
				'all_items'                  => __( 'All Customer Tags', 'simple_crm' ),
				'parent_item'                => __( 'Parent Customer Tag', 'simple_crm' ),
				'parent_item_colon'          => __( 'Parent Customer Tag:', 'simple_crm' ),
				'new_item_name'              => __( 'New Customer Tag', 'simple_crm' ),
				'add_new_item'               => __( 'Add New Customer Tag', 'simple_crm' ),
				'edit_item'                  => __( 'Edit Customer Tag', 'simple_crm' ),
				'update_item'                => __( 'Update Customer Tag', 'simple_crm' ),
				'view_item'                  => __( 'View Customer Tag', 'simple_crm' ),
				'separate_items_with_commas' => __( 'Separate customer tags with commas', 'simple_crm' ),
				'add_or_remove_items'        => __( 'Add or remove customer tags', 'simple_crm' ),
				'choose_from_most_used'      => __( 'Choose from the most used', 'simple_crm' ),
				'popular_items'              => __( 'Popular Customer Tags', 'simple_crm' ),
				'search_items'               => __( 'Search Customer Tags', 'simple_crm' ),
				'not_found'                  => __( 'Not Found', 'simple_crm' ),
				'no_terms'                   => __( 'No customer tags', 'simple_crm' ),
				'items_list'                 => __( 'Customer Tag list', 'simple_crm' ),
				'items_list_navigation'      => __( 'Customer Tag navigation', 'simple_crm' ),
			);

		$this->cat_labels = array(
				'name'                       => _x( 'Customer Categories', 'Taxonomy General Name', 'simple_crm' ),
				'singular_name'              => _x( 'Customer Category', 'Taxonomy Singular Name', 'simple_crm' ),
				'menu_name'                  => __( 'Customer Categories', 'simple_crm' ),
				'all_items'                  => __( 'All Customer Categories', 'simple_crm' ),
				'parent_item'                => __( 'Parent Customer Category', 'simple_crm' ),
				'parent_item_colon'          => __( 'Parent Customer Category:', 'simple_crm' ),
				'new_item_name'              => __( 'New Customer Category', 'simple_crm' ),
				'add_new_item'               => __( 'Add New Customer Category', 'simple_crm' ),
				'edit_item'                  => __( 'Edit Customer Category', 'simple_crm' ),
				'update_item'                => __( 'Update Customer Category', 'simple_crm' ),
				'view_item'                  => __( 'View Customer Category', 'simple_crm' ),
				'separate_items_with_commas' => __( 'Separate customer categories with commas', 'simple_crm' ),
				'add_or_remove_items'        => __( 'Add or remove customer categories', 'simple_crm' ),
				'choose_from_most_used'      => __( 'Choose from the most used', 'simple_crm' ),
				'popular_items'              => __( 'Popular Customer Categories', 'simple_crm' ),
				'search_items'               => __( 'Search Customer Categories', 'simple_crm' ),
				'not_found'                  => __( 'Not Found', 'simple_crm' ),
				'no_terms'                   => __( 'No customer categories', 'simple_crm' ),
				'items_list'                 => __( 'Customer Category list', 'simple_crm' ),
				'items_list_navigation'      => __( 'Customer Category navigation', 'simple_crm' ),
			);

	    }

	    public function get_post_type(){
	    	return $this->post_type;
	    }

	    public function register(){

			$args = array(
				'label'                 => __( 'Customer', 'simple_crm' ),
				'description'           => __( 'Customer contacts', 'simple_crm' ),
				'labels'                => $this->post_labels,
				'supports'              => array( 'title', 'editor' ),
				'taxonomies'            => array('customer_cats', 'customer_tags'),
				'hierarchical'          => false,
				'public'                => false,
				'show_ui'               => true,
				'show_in_menu'          => true,
				'menu_position'         => 5,
				'show_in_admin_bar'     => true,
				'show_in_nav_menus'     => true,
				'can_export'            => true,
				'has_archive'           => true,
				'exclude_from_search'   => true,
				'publicly_queryable'    => false,
				'capability_type'       => 'page',
				'show_in_rest'          => false,
			);	

			register_post_type($this->post_type, $args );    	
	    }

	    public function register_tags(){

			$args = array(
				'labels'                     => $this->tag_labels,
				'hierarchical'               => false,
				'public'                     => false,
				'show_ui'                    => true,
				'show_admin_column'          => true,
				'show_in_nav_menus'          => false,
				'show_tagcloud'              => false,
			);
			register_taxonomy( 'customer_tags', array( $this->post_type ), $args );	    	
	    }

	    public function register_cats(){
			$args = array(
				'labels'                     => $this->cat_labels,
				'hierarchical'               => true,
				'public'                     => false,
				'show_ui'                    => true,
				'show_admin_column'          => true,
				'show_in_nav_menus'          => false,
				'show_tagcloud'              => false,
			);
			register_taxonomy( 'customer_cats', array( $this->post_type ), $args );	    	
	    }
	}
	
	$WP_Simple_CRM_PostType = new WP_Simple_CRM_PostType();


	add_action('init', array($WP_Simple_CRM_PostType, 'register'));	
	add_action( 'init', array($WP_Simple_CRM_PostType, 'register_tags'), 0 );
	add_action( 'init', array($WP_Simple_CRM_PostType, 'register_cats'), 0 );	
}
