<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	function __construct(){
		parent::__construct();
		
		$this->load->model('Usuario_Model');
		
	}

	function index() {
		if (!$this->auth->is_logged() == FALSE) {
					$this->ingreso();
		}else{
			$this->form_validation->set_rules('usuario', 'Usuario', 'trim|xss_clean');
			$this->form_validation->set_rules('contrasena', 'Contraseña', 'trim|xss_clean|sha1');
			$this->form_validation->set_message('required', 'Debe introducir el campo  <b> %s </b>');
			
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('login');
				
			}else{
				$datos['params'] = array(	'usuario' => $this->input->post('usuario'),
											'contrasena' => $this->input->post('contrasena')
											);
				
				$respuesta = $this->auth->login($datos['params']);

				if (!isset($respuesta['error'])) {
						$this->ingreso();
				} else {
					if ($respuesta['error'] ==  'LOG_IN'){
						$data['title']='Salida del sistema';
						$data['msg'] = 'Su sesión ha sido desconectada, por cierre de session de manera indebida o por que posee un sesión activa.
						Por favor, espere 5 min antes de volver a intentar el acceso. ';
						$this->load->view('mensaje', $data);
					}elseif($respuesta['error'] ==  'LOCK'){
						$data['title']='Salida del sistema';
						$data['msg'] = 'Su sesión ha sido desconectada, ud se encuentra temporalmente suspendido.
						Por favor, Contacte al administrador del sistema. ';
						$this->load->view('mensaje', $data);
					}else{
						redirect('inicio');
					}						
				}					
			}

		}

	}

	function prueba(){
		$this->load->view('prueba');
	}

	function prueba2(){
		$this->load->view('prueba2');
	}

	function prueba3(){
		$this->load->view('index');
	}

	function creditos(){
		$this->load->view('creditos');
	}

	function manual(){
		$this->load->view('manual');
	}


	function ingreso(){
		switch ($this->session->userdata('nombre_usuario')) {
					case '1':
						$data['usuarios'] = $this->Usuario_Model->findUsuarios();
						$this->load->view('inicio');
						break;
					default:
						redirect('index');
						break;
			}
						
	}

	function cerrar_sesion() {
		$this->auth->cerrar_sesion();
		redirect("inicio");
	}

}
