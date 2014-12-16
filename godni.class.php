<?php
class godni {
	protected $metadni='godni'; //nombre de la variable en la tabla meta user
	protected $godni_html_register = '<p><label for="godni_text">DNI (9 d&iacute;gitos)<br />
								<input type="text" name="godni_text" id="godni_text" /><br />Ejm: Si 42223456-2 => <b>422234562</b></label><br /><br /></p>';
	
	protected $godni_html_profile = '<table class="form-table"><tr>
								<th><label for="godni_text">DNI</label></th>
								<td><input type="text" name="godni_text" id="godni_text" value="%s" size="55" /></td>
								</tr>
							</table>';
	protected $msg;
	
	function active() {
		update_option('godni_register',0);
		update_option('godni_profile',1);
		update_option('godni_column',0);
	}
	
	function add_menu() {
		add_submenu_page('users.php', __('Setting GoDNI'), __('Setting GoDNI'), 'edit_pages', 'godni',array(&$this,'add_settings'));
		return true;
	}
	
	function add_settings() {
		if (!current_user_can('manage_options')) 
			wp_die( __('You do not have sufficient permissions to access this page.','godni'));
			
		if(isset($_POST['godni-submit'])) {
			update_option('godni_register',$_POST['godni_register']);
			update_option('godni_profile',$_POST['godni_profile']);
			update_option('godni_column',$_POST['godni_column']);
		}
		
		/*	Reset Settings	*/
		if(isset($_POST['godni-reset']) && isset($_POST['godni-checkreset']) && $_POST['godni-checkreset']==1) {
			delete_option('godni_register');
			delete_option('godni_profile');
			delete_option('godni_column');
			
			$this->active();
			
			sleep(1);
		}

		$godni_register = get_option('godni_register');
		$godni_profile = get_option('godni_profile');
		$godni_column = get_option('godni_column');
		 
		include_once WP_PLUGIN_DIR.'/GoDNI/godni-settings.php';
		
	}
	
	function add_settings_link( $links ) {
		$settings_link = '<a href="users.php?page=godni">Settings</a>';
		array_push( $links, $settings_link );
		return $links;
	}
	
	/*****************************
		REGISTER FORM
	*****************************/
	function set_register_form() {
		echo $this->godni_html_register;
	}
	
	function save_register_form($user_id, $password = "", $meta = array()) {
		if(isset($_POST['godni_text']))
			add_user_meta($user_id, $this->metadni, $_POST['godni_text']);
	}
	
	function error_register_form( $login, $email, $errors ) {
		global $wpdb;
		
		$godni = $wpdb->escape($_POST['godni_text']);
		if(!$this->is_dni($godni)) $errors->add('DNI','<b>ERROR:</b> '.$this->msg);
	}
	
	/**************************
		PROFILE FORM
	**************************/
	function set_profile_form($user) {
		$godni = get_user_meta($user->ID, $this->metadni, true);

		echo str_replace('%s',$godni,$this->godni_html_profile);
	}
	
	/*function save_profile_form($user_id) {
		if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }
		
		if($this->is_dni($godni)) update_user_meta($user_id, $this->metadni, $_POST['godni_text']);
	}*/
	
	function error_profile_form(&$errors, $update, &$user ) {
		global $wpdb;
		$godni = $wpdb->escape($_POST['godni_text']);
			
		if($this->is_dni($godni))
			update_user_meta($user->ID, $this->metadni, $godni);
		else
			$errors->add('DNI',$this->msg);
	}
	
	/**************************************
		ADD COLUMN LIST USER
	***************************************/
	function add_column_listusers($columns) {
		$columns['godni'] = 'GoDNI';
		return $columns;
	}
 
	function add_value_listusers($value, $column_name, $user_id) {
		$godni = get_user_meta( $user_id, $this->metadni, true );
			if ( 'godni' == $column_name )
				return $godni;
	
			return $value;
		}

	/**********************
		VALIDATION
	***********************/
	function is_dni($godni) {
		global $wpdb;
		$error=0;
		
		if(isset($godni) && !empty($godni) && strlen($godni)==9) {
			$i=$suma=0;
			$multiplos = array(3,2,7,6,5,4,3,2);
			
			$array_number = array(6, 7, 8, 9, 0, 1, 1, 2, 3, 4, 5);
			$array_letters = array('K', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
			
			$numdni = str_split(substr($godni,0,-1)); // 8 digits
			$dcontrol = substr($godni,-1); //1 digito
		
			foreach($numdni as $digito) {
				$suma+=$digito*$multiplos[$i];
				$i++;
			}
			
			$key = 11 - ($suma%11);
			$key = $key==11?0:$key;

			if(is_numeric($dcontrol)) {
				if($array_number[$key] != $dcontrol) {
					$error++;
					$this->msg='Su DNI no es v&aacute;lido. Por favor, ingrese uno correcto';
				}
			} else {
				$dcontrol = strtoupper($dcontrol);
				if($array_letters[$key] != $dcontrol) {
					$error++;
					$this->msg='Su DNI no es v&aacute;lido. Por favor, ingrese uno correcto';
				}
			}
			
			/******************************
				IF DUPLICATE DNI
			*******************************/
			$dni_count = $wpdb->get_var( 'SELECT COUNT(*) FROM '.$wpdb->usermeta.' WHERE meta_key="'.$this->metadni.'" && meta_value="'.$godni.'"' );
		
			if($dni_count > 0) {
				$error++;
				$this->msg='Su DNI <b>'.$godni.'</b> ya est&aacute; en uso';
			}
		
		} else {
			$error++;
			$this->msg='DNI no v&aacute;lido. Recuerde que s&oacute;lo n&uacute;meros y de 9 d&iacute;gitos';
		}
		
		if($error==0)
			return 1;
		else
			return 0;
	}
}
?>