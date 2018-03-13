<?php 
if(!class_exists('WP_Simple_CRM_Form')){
	class WP_Simple_CRM_Form{

		private static $time_api_url = 'http://www.convert-unix-time.com/api?timestamp=now&timezone=';

		private static $defaults = array(
					'name_label' => 'Name',
					'phone_label' => 'Phone Number',
					'email_label' => 'Email Address',
					'budget_label' => 'Desired Budget',
					'message_label' => 'Message',
					'button_text' => 'Send',
					'message_rows' => 5,
					'message_cols' => 5,
				);

		public static function scripts(){
			//JavaScript
			wp_enqueue_script('simplecrm', SIMPLECRM_URI . 'assets/simplecrm.js', array('jquery'), '1.0', true);			
		}

		public static function get_attributes($user_atts){
			return shortcode_atts(self::$defaults, $user_atts, 'simple_crm_form' );
		}

		public static function get_date_data(){
			$timezone_string = get_option('timezone_string');
			$timezone = explode('/', $timezone_string);
			$url = self::$time_api_url . $timezone[1];

			$response = wp_remote_get($url);
			$date = json_decode($response['body']);
			return $date;
		}

		public static function get_form($user_atts){
			$atts = self::get_attributes($user_atts);

			$date_data = self::get_date_data();

			$form = '<form class="simple_crm_form">
						<label>' . $atts['name_label'] . '</label>
						<input required type="text" name="name" />
						<label>' . $atts['phone_label'] . '</label>
						<input type="text" name="phone" />
						<label>' . $atts['email_label'] . '</label>
						<input required type="email" name="email" />
						<label>' . $atts['budget_label'] . '</label>
						<input type="text" name="budget" />
						<label>' . $atts['message_label'] . '</label>
						<textarea rows=' . $atts['message_rows'] . ' cols=' . $atts['message_cols'] . ' name="message" /></textarea>
						<hr/>
						<input type="hidden" name="timestamp" value="'.  $date_data->timestamp . '"/>
						<button type="submit">' . $atts['button_text'] . '</button>
					</form>';

			return $form;
		}

		public static function shortcode($user_atts, $content=""){
			return self::get_form($user_atts);
		}
	}

	add_shortcode( 'simple_crm_form', array( 'WP_Simple_CRM_Form', 'shortcode' ) );	
	add_action( 'wp_enqueue_scripts', array('WP_Simple_CRM_Form', 'scripts') );	
}