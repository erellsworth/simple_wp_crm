<?php
if(!class_exists('WP_Simple_CRM_PostType')){
	class WP_Simple_CRM_PostType{
		private $post_type, $labels;
		
	    function __construct() {
	    	$this->post_type = apply_filters('simple_crm_post_type', 'customer');
	    	$this->labels = array(
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
	    }

	    public function register(){

			$args = array(
				'label'                 => __( 'Customer', 'simple_crm' ),
				'description'           => __( 'Customer contacts', 'simple_crm' ),
				'labels'                => $this->labels,
				'supports'              => array( 'title', 'editor' ),
				'taxonomies'            => array( 'category', 'post_tag' ),
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
	}
	
	$WP_Simple_CRM_PostType = new WP_Simple_CRM_PostType();


	add_action('init', array($WP_Simple_CRM_PostType, 'register'));	
}