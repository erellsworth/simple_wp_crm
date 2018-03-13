<?php 
if(!class_exists('WP_Simple_CRM_Form')){
	class WP_Simple_CRM_Form{

		private static $defaults = array(
					'name_label' => 'Name',
					'phone_label' => 'Phone Number',
					'email_label' => 'Email Address',
					'budget_label' => 'Desired Budget',
					'message_label' => 'Message',
					'message_rows' => 5,
					'message_cols' => 5,
				);

		public static function get_attributes($user_atts){
			return shortcode_atts(self::$defaults, $user_atts, 'simple_crm_form' );
		}

		public static function form($user_atts){
			$atts = self::get_attributes($user_atts);
			
			return '<h3>' . $atts['name_label'] . '</h3>';
		}

		public static function shortcode($user_atts, $content=""){

			return self::form($user_atts);
		}
	}

	add_shortcode( 'simple_crm_form', array( 'WP_Simple_CRM_Form', 'shortcode' ) );	
}