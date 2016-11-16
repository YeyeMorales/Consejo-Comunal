<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Jefe extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->auth->is_logged() != TRUE){
			redirect(base_url('inicio'));
		}
		$this->load->model('Jefe_Model');
		$this->load->library('audit');
		$this->load->library('Funciones');

		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	}

	function index($data) {
		$data['jefe'] = $this->Jefe_Model->findJefe();
		$this->load->view('menu');	
		if ($data['jefe']==0) {
				$data['info'] = "No hay registros. "; 
				$this->load->view('adminJefe', $data, null, true);     
			}else{
				$this->load->view('adminJefe', $data, null, true);
			}	
	}

	function inicio(){
			$data['comision'] = $this->Jefe_Model->comision();
			$this->load->view('menu');	
			$this->load->view('jefe', $data, null, null);
	}

	function actualizaJefe(){
		$data['jefe_familia'] = $this->Jefe_Model->findJefeById($this->input->post('id'));
		$data['comision'] = $this->Jefe_Model->comision();
		$this->load->view('menu');		
		$this->load->view('actualizarJefe', $data, null, true);
	}
	
	function create() {

		$this->form_validation->set_rules('nombres', 'Nombre del Jefe de Familia', 'required|trim|xss_clean');
		$this->form_validation->set_rules('apellidos', 'Rif del Jefe de Familia', 'required|trim|xss_clean');
		$this->form_validation->set_rules('fecha_nac', 'Fecha de nacimiento', 'required|trim|xss_clean');
		$this->form_validation->set_rules('cedula', 'Cédula del Jefe de Familia', 'required|trim|xss_clean');
		$this->form_validation->set_rules('telefono', 'Teléfono personal', 'required|trim|xss_clean');
		$this->form_validation->set_rules('profesion', 'Profesión', 'trim|xss_clean');
		$this->form_validation->set_rules('oficio', 'Oficio/Ocupación', 'trim|xss_clean');	
		
		$this->form_validation->set_message('required', 'Debe introducir el %s');
		$this->form_validation->set_message('min_length', 'El campo %s debe ser de al menos %s carácteres');

		if ($this->form_validation->run() == FALSE) {
			$this->inicio();
		} else {
			$datos['params'] = array('nombres' => $this->input->post('nombres'),
									 'apellidos' => $this->input->post('apellidos'),
									 'fecha_nac' => $this->input->post('fecha_nac'),					 
								     'cedula' => $this->input->post('cedula'),
								     'telefono' => $this->input->post('telefono'),
									 'profesion' => $this->input->post('profesion'),					 
								     'oficio' => $this->input->post('oficio')
		
			);
			
			$registro = $this->Jefe_Model->insertar($datos['params']);

			if ($registro) {
				$data['satisfactorio'] = "El registro se realizo satisfactoriamente. ";      
			}else{
				$data['fallo'] = 'Ha ocurrido un error al intentar realizar el registro.';
			}

			$this->cargaMiembroJefe();
			
		}
	}

function update() {
			$this->form_validation->set_rules('nombres', 'Nombre del Jefe de Familia', 'required|trim|xss_clean');
			$this->form_validation->set_rules('apellidos', 'Rif del Jefe de Familia', 'required|trim|xss_clean');
			$this->form_validation->set_rules('fecha_nac', 'Fecha de nacimiento', 'required|trim|xss_clean');
			$this->form_validation->set_rules('cedula', 'Cédula del Jefe de Familia', 'required|trim|xss_clean');
			$this->form_validation->set_rules('telefono', 'Teléfono personal', 'required|trim|xss_clean');
			$this->form_validation->set_rules('profesion', 'Profesión', 'trim|xss_clean');
			$this->form_validation->set_rules('oficio', 'Oficio/Ocupación', 'trim|xss_clean');	
			
			$this->form_validation->set_message('required', 'Debe introducir el %s');
			$this->form_validation->set_message('min_length', 'El campo %s debe ser de al menos %s carácteres');

			$datos['params'] = array('id'=>$this->input->post('id'),
									 'nombres' => $this->input->post('nombres'),
									 'apellidos' => $this->input->post('apellidos'),
									 'fecha_nac' => $this->input->post('fecha_nac'),					 
								     'cedula' => $this->input->post('cedula'),
								     'telefono' => $this->input->post('telefono'),
									 'profesion' => $this->input->post('profesion'),					 
								     'oficio' => $this->input->post('oficio')	
			);	

			
			$actualizo = $this->Jefe_Model->actualizar($datos['params']);

			if ($actualizo) {
				$data['satisfactorio'] = "La actualización se realizo satisfactoriamente. ";      
			}else{
				$data['fallo'] = 'Ha ocurrido un error al intentar actualizar el registro.';
			}

			$this->updateMiembroJefe();
	
	}

	function cargaFamiliar(){
			$data['comision'] = $this->Jefe_Model->comision();
			$data['jefe'] = $this->Jefe_Model->findJefeCarga();
			$this->load->view('menu');	
			$this->load->view('carga', $data, null, null);
	}

	function cargaMiembroJefe(){
		$data = $this->Jefe_Model->findJefeCarga();	
		//print_r($data);
		//break;

		$datos['params'] = array('comisionid'=>$this->input->post('comisionid'),
								 'idjefe' => $data);

			$registro = $this->Jefe_Model->insertarJefeMiembro($datos['params']);

			$this->index();
	}

	function updateMiembroJefe(){
		
		$datos['params'] = array('comisionid'=>$this->input->post('comisionid'),
								 'idjefe' => $this->input->post('id'));

			// print_r($datos);
			// break;
			$registro = $this->Jefe_Model->updateMiembroJefe($datos['params']);

			$this->index();
	}

	function jefeFilter() {
			$elemento = $this->input->post('cedula');

					$data['jefe'] = $this->Jefe_Model->findJefeFilter($elemento);
					$this->load->view('menu');	
					if ($data['jefe']==0) {
						$data['info'] = "No hay registros. "; 
						$this->load->view('adminJefe', $data, null, true);     
					}else{
						$this->load->view('adminJefe', $data, null, true);
					}						
					
			}

}