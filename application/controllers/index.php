<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		if($this->auth->is_logged() != TRUE){
			redirect(base_url('inicio'));
		}
		$this->load->library('audit');
		$this->load->library('Funciones');

		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	}

	function index() {
		$this->load->view('menu');		
		$this->load->view('inicio1');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */