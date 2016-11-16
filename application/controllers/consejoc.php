<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Consejoc extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->auth->is_logged() != TRUE){
			redirect(base_url('inicio'));
		}
		$this->load->model('Consejo_Model');
		$this->load->model('Distribucion_geopolitica_model');	
		$this->load->library('audit');
		$this->load->library('Funciones');

		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	}

	function index($data) {
		$data['consejo'] = $this->Consejo_Model->findConsejoc();
		$this->load->view('menu');		
		$this->load->view('adminConsejo', $data, null, true);
	}

	function inicio(){
			$data['estados'] = $this->Distribucion_geopolitica_model->getEstados();
			$data['consejo'] = $this->Consejo_Model->findConsejoc();
			$this->load->view('menu');	
			$this->load->view('consejoc', $data, null, true);
	}

	function actualizaConsejo(){
		$data['consejo'] = $this->Consejo_Model->findConsejocById($this->input->post('id'));
		$data['estados'] = $this->Distribucion_geopolitica_model->getEstados();	
		$this->load->view('header');		
		$this->load->view('actualizarConsejo', $data, null, true);
	}
	function create() {

		$this->form_validation->set_rules('nombre', 'Nombre del Consejo Comunal', 'required|trim|xss_clean');
		$this->form_validation->set_rules('rif', 'Rif del Consejo Comunal', 'required|trim|xss_clean');
		$this->form_validation->set_rules('sector', 'Sector del Consejo Comunal', 'required|trim|xss_clean');
		
		$this->form_validation->set_message('required', 'Debe introducir el %s');
		$this->form_validation->set_message('min_length', 'El campo %s debe ser de al menos %s carácteres');

		if ($this->form_validation->run() == FALSE) {
			$this->inicio();
		} else {
			$datos['params'] = array('rif' => $this->input->post('rif'),
									 'nombre' => $this->input->post('nombre'),					 
								     'n_sector' => $this->input->post('sector')
		
			);
			
			$registro = $this->Consejo_Model->insertar($datos['params']);

			if ($registro) {
				$data['satisfactorio'] = "El registro se realizo satisfactoriamente. ";      
			}else{
				$data['fallo'] = 'Ha ocurrido un error al intentar realizar el registro.';
			}

			$this->index($data);
			
		}
	}

function update() {
		$this->form_validation->set_rules('nombre', 'Nombre del Consejo Comunal', 'required|trim|xss_clean');
		$this->form_validation->set_rules('rif', 'Rif del Consejo Comunal', 'required|trim|xss_clean');
		$this->form_validation->set_rules('sector', 'Sector del Consejo Comunal', 'required|trim|xss_clean');
		
		$this->form_validation->set_message('required', 'Debe introducir el %s');
		$this->form_validation->set_message('min_length', 'El campo %s debe ser de al menos %s carácteres');

			$datos['params'] = array(
									'id'=>$this->input->post('id'),
									'rif' => $this->input->post('rif'),
									'nombre' => $this->input->post('nombre'),					 
								    'n_sector' => $this->input->post('sector')	
			);	

			
			$actualizo = $this->Consejo_Model->actualizar($datos['params']);


			if ($actualizo) {
				$data['satisfactorio'] = "La actualización se realizo satisfactoriamente. ";      
			}else{
				$data['fallo'] = 'Ha ocurrido un error al intentar actualizar el registro.';
			}

			$this->index($data);
	
	}

	function delete() {
		if ($this->input->post('id')) {
			$id = $this->input->post('id');
			$verifica = $this->Consejo_Model->findConsejoAssociado($id);
			if ($verifica) {
				$deleteRow = $this->Consejo_Model->eliminar($id);

				if ($deleteRow) {
						$data['satisfactorio'] = "El registro se elimino satisfactoriamente. ";      
				}else{
					$data['fallo'] = 'Ha ocurrido un error al intentar eliminar el registro.';
				} 
			}else{
				$data['warning'] = "El registro se no se puede eliminar debido a que posee información relacionada. ";     
			}
			
		}

		$this->index($data);
	}

}