<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	function __construct(){
		parent::__construct();

	//	$this->basicauth->removeCache();
		$this->load->model('Usuario_Model');
		//$this->load->model('Grupos_Model');
		$this->load->library('audit');

		if($this->auth->is_logged() != TRUE){
			redirect(base_url('inicio'));
		}
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	}

	function index($data) {
		$data['usuarios'] = $this->Usuario_Model->findUsuarios();
		$this->load->view('menu');		
		$this->load->view('adminUsuarios', $data, null, true);			
	}

	function inicioUsuarios(){
		
		if ($this->input->post('id')) {
			//$data['grupos'] = $this->Grupos_Model->findGroups();
			$data['usuarios'] = $this->Usuario_Model->findUsuarioById($this->input->post('id'));
			$this->load->view('menu');				
			$this->load->view('actualizarUsuario', $data, null, true);
		}else{
			//$data['grupos'] = $this->Grupos_Model->findGroups();
			$this->load->view('menu');		
			$this->load->view('usuarios', $data, null, true);
		}
		
	}

	function checkUsername($usuario){
		if ($usuario != ""){
			$ver_account = $this->Usuario_Model->checkUsername($usuario);
			if($ver_account > 0){
				$this->form_validation->set_message('checkUsername', 'el usuario se encuentra registrado en el sistema');
				return FALSE;
			}else{
				return TRUE;
			}
		}
	}

	function create() {

		$this->form_validation->set_rules('nombre_usuario', 'Nombre de usuario', 'required|callback_checkUsername|trim|xss_clean');
		$this->form_validation->set_rules('cedula', 'cedula', 'required|trim|xss_clean');
		$this->form_validation->set_rules('contrasena', 'contrasena', 'required|trim|sha1|xss_clean');
		$this->form_validation->set_rules('contrasena_2', 'contrasena', 'required|matches[contrasena]|trim|sha1|xss_clean');
		$this->form_validation->set_rules('email', 'email', 'required|trim|xss_clean');
		$this->form_validation->set_rules('email2', 'email2', 'required|matches[email]|trim|xss_clean');


		$this->form_validation->set_message('required', 'Debe introducir el campo %s');
		$this->form_validation->set_message('min_length', 'El campo %s debe ser de al menos %s carácteres');
		$this->form_validation->set_message('matches', 'Los campos %s y %s no coinciden');

		if ($this->form_validation->run() == FALSE) {
			$this->inicioUsuarios();
		} else {
			$datos = array();
			$datos['params'] = array('nombre_usuario' => $this->input->post('nombre_usuario'),
									 'cedula' => $this->input->post('cedula'),
									 'contrasena' => $this->input->post('contrasena_2'),
									 'email' => $this->input->post('email2'), 
		
			);	
			$registro = $this->Usuario_Model->insertar($datos['params']);

			if ($registro) {
				$data['satisfactorio'] = "El registro se realizo satisfactoriamente. ";      
			}else{
				$data['fallo'] = 'Ha ocurrido un error al intentar realizar el registro.';
			}

			$this->index($data);
			
		}

	}

	function update() {

		$this->form_validation->set_rules('nombre_usuario', 'Nombre de usuario', 'required|trim|xss_clean');
		$this->form_validation->set_rules('cedula', 'Cédula', 'required|trim|xss_clean');
		$this->form_validation->set_rules('email', 'Correo Electrónico', 'required|trim|xss_clean');

		$this->form_validation->set_message('required', 'Debe introducir el campo %s');
		$this->form_validation->set_message('min_length', 'El campo %s debe ser de al menos %s carácteres');
		$this->form_validation->set_message('matches', 'Los campos %s y %s no coinciden');

		if ($this->form_validation->run() == FALSE) {
			$this->inicioUsuarios();
		} else {
			$datos['params'] = array('id'=>$this->input->post('id'),
									 'nombre_usuario' => $this->input->post('nombre_usuario'),
									 'cedula' => $this->input->post('cedula'),
									 'email' => $this->input->post('email'), 
		
			);	
			$actualizo = $this->Usuario_Model->actualizar($datos['params']);
			
			if ($actualizo) {
				$data['satisfactorio'] = "La actualización se realizo satisfactoriamente. ";      
			}else{
				$data['fallo'] = 'Ha ocurrido un error al intentar actualizar el registro.';
			}

			$this->index($data);
			
		}

	}

	function delete() {
		if ($this->input->post('id')) {
			$id = $this->input->post('id');
			//$accion = 3;
			$deleteRow = $this->Usuario_Model->eliminar($id);

		if ($deleteRow) {
				$data['satisfactorio'] = "El registro se elimino satisfactoriamente. ";      
			}else{
				$data['fallo'] = 'Ha ocurrido un error al intentar eliminar el registro.';
			}
		}

		//$this->audit('ID Usuario:' .$id, $deleteRow, $accion);// guarda operacion realizada. 'Auditoria'

		$this->index($data);
	}

	function changepass() {
		$this->form_validation->set_rules('antipw', 'Contraseña Actual', 'required|trim|callback_checkPass|min_length[6]');
		$this->form_validation->set_rules('pwnew1', 'Nueva Contraseña', 'min_length[6]|required|sha1|trim');
		$this->form_validation->set_rules('pwnew2', 'Confirmar contraseña', 'required|matches[pwnew1]|trim|sha1');

		$this->form_validation->set_message('min_length', 'El campo %s debe ser de al menos %s carácteres');
		$this->form_validation->set_message('checkPass','La contraseña es incorrecta');
		$this->form_validation->set_message('matches','Confirmar contraseña no coinciden con Nueva Contraeña');
		$this->form_validation->set_message('required', 'El campo %s es requerido');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('menu');
			$this->load->view('changepass_view');
		} else {
			$datos['registro'] = array('contrasena' => $this->input->post('pwnew1'));
			$changePass = $this->Usuario_Model->changePassword($datos['registro']);

			if ($changePass) {	
				$datos['pwsuccess'] = 'La contraseña fue actualizada satisfactoriamente';
			}else{
				$datos['pwerror'] = 'Ocurrio un error al intentar cambiar la contraseña';
			}
			$this->load->view('menu');
			$this->load->view('changepass_view',$datos);
		}


	}

}