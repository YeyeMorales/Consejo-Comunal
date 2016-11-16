<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
 
class Captcha{
	protected $CI;

	public function __construct(){
		$this->CI = & get_instance();
		$this->CI->load->model('Captcha_model','',TRUE);
	}

	public function newCaptcha($ip){
		$vals = array(
				'img_path'   => './captcha/',
				'img_url'    => base_url().'captcha/',
				'font_path'  => './system/fonts/texb.ttf',
				'img_width'  => '150',
				'img_height' => '30',
				'expiration' => '120'
		);
			
		$cap = create_captcha($vals);
			
		// se agrega el captcha a la base de datos
		$captcha_info = array (
				'captcha_time' => $cap['time'],
				'ip_address' => $ip,
				'word' => $cap['word']
		);
			
		$this->CI->Captcha_model->insertCaptcha($captcha_info);

		return $cap;
	}

	public function checkCaptcha($captcha, $ip){
		$expiration = time()-7200; // Limite de dos horas
		$binds = array ($captcha, $ip, $expiration);

		return $this->CI->Captcha_model->captchaExist($binds);
	}
}