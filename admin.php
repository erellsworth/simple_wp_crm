<?php
if(!class_exists('WP_Simple_CRM_Admin')){

	class WP_Simple_CRM_Admin{
		public static function table_header($defaults){
		    $defaults['phone']  = 'Phone';
		    $defaults['email']  = 'Email';
		    $defaults['time']  = 'Time';
		    $defaults['budget']  = 'Budget';
		    return $defaults;
		}

		public static function table_columns($column_name, $post_id){
			$outputs = array(
					'phone' => get_post_meta( $post_id, 'phone', true ),
					'email' => get_post_meta( $post_id, 'email', true ),
					'budget' => get_post_meta( $post_id, 'budget', true ),
					'time' => 'none'
				);
			
			$time = get_post_meta( $post_id, 'timestamp', true );

			if($time){
				$outputs['time'] = date(get_option('date_format'), $time) . '<br/>' . date(get_option('time_format'), $time);
			}

			echo $outputs[$column_name];
		}
	}

	add_filter('manage_customer_posts_columns', array('WP_Simple_CRM_Admin', 'table_header'));	

	add_action( 'manage_customer_posts_custom_column', array('WP_Simple_CRM_Admin', 'table_columns'), 10, 2 );
}