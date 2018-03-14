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
					'success_message' => 'Your Message Has Been Sent'
				);

		private static $required_fields = array('name', 'email', 'phone');

		public static function scripts(){
			//JavaScript
			wp_enqueue_script('simplecrm', SIMPLECRM_URI . 'assets/simplecrm.js', array('jquery'), '1.0', true);	
			
			//css
			wp_enqueue_style('simplecrm', SIMPLECRM_URI . 'assets/simplecrm.css');					
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

			$form = '<form class="simple_crm_form" action="' . admin_url( 'admin-ajax.php' ) . '" data-success_message="' . $atts['success_message'] . '">
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
						<div class="simple_crm_form_response"></div>
						<input type="hidden" name="timestamp" value="'.  $date_data->timestamp . '"/>'
						. wp_nonce_field('simple_crm_form_submit', 'simple_crm_nonce', false, false) . '
						<button type="submit">' . $atts['button_text'] . '</button>
					</form>';

			return $form;
		}

		public static function validate_submission($data){
			$errors = array();

			foreach (self::$required_fields as $field) {
				if(!$data[$field]){
					$errors[] = 'Missing ' . $field . ' field';
				}
			}

			if(!wp_verify_nonce($_POST['simple_crm_nonce'], 'simple_crm_form_submit')){
				$errors[] = 'There was a problem verifying your submission. Please refresh your browser and try again.';
			}

			if(count($errors)){
				return array('validated' => false, 'errors' => $errors);
			}

			return array('validated' => true);

		}

		public static function submit(){

			$validation = self::validate_submission($_POST);

			if(!$validation['validated']){
				wp_send_json_error($validation['errors']);
			}

			$post_type = new WP_Simple_CRM_PostType();

			$post_data = array(
					'post_title' => sanitize_text_field($_POST['name']),
					'post_content' => sanitize_textarea_field($_POST['message']),
					'post_status' => 'publish',
					'post_type' => $post_type->get_post_type(),
					'meta_input' => array(
							'phone' => sanitize_text_field($_POST['phone']),
							'email' => sanitize_text_field($_POST['email']),
							'budget' => sanitize_text_field($_POST['budget']),
							'timestamp' => sanitize_text_field($_POST['timestamp']),
						)
				);

			$post = wp_insert_post($post_data);

			if(is_wp_error($post)){
				wp_send_json_error(array($post->get_error_message()));
			}

			wp_send_json_success(array(
					'post_id' => $post
				));
		}

		public static function shortcode($user_atts, $content=""){
			return self::get_form($user_atts);
		}
	}

	add_shortcode( 'simple_crm_form', array( 'WP_Simple_CRM_Form', 'shortcode' ) );	
	add_action( 'wp_enqueue_scripts', array('WP_Simple_CRM_Form', 'scripts') );	
	add_action( 'wp_ajax_nopriv_simple_cms_form', array('WP_Simple_CRM_Form', 'submit') );
	add_action( 'wp_ajax_simple_cms_form', array('WP_Simple_CRM_Form', 'submit') );	
}