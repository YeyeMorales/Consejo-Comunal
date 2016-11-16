<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Carga extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->auth->is_logged() != TRUE){
			redirect(base_url('inicio'));
		}
		$this->load->model('Jefe_Model');
		$this->load->model('Carga_Model');		

		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	}

	function index($data) {
		$data['carga'] = $this->Carga_Model->findCarga_familiar();
		// print_r($carga);
		// break;
		$this->load->view('menu');	
		if ($data['carga']==0) {
						$data['info'] = "No hay registros. "; 
						$this->load->view('adminCarga', $data, null, true);     
					}else{
						$this->load->view('adminCarga', $data, null, true);
					}			
	}

	function inicio(){
			$data['jefe'] = $this->Jefe_Model->findJefe();		
			$data['comision'] = $this->Jefe_Model->comision();
			$this->load->view('menu');	
			$this->load->view('carga', $data, null, null);
	}

	function create() {
		$data = $this->Jefe_Model->findJefeCarga();	

			$datos['params'] = array('nombre' => $this->input->post('nombres'),
									 'apellido' => $this->input->post('apellidos'),
									 'fecha_nac' => $this->input->post('fecha_nac'),					 
								     'ced' => $this->input->post('cedula'),
								     'telef' => $this->input->post('telefono'),
									 'prof' => $this->input->post('profesion'),					 
								     'oficio' => $this->input->post('oficio'),
								     'calle' => $this->input->post('calle'),
								     'idjefef' => $data,
		
			);

			$registro = $this->Carga_Model->insertar($datos['params']);

			if ($registro) {
				$data['satisfactorio'] = "El registro se realizo satisfactoriamente. ";      
			}else{
				$data['fallo'] = 'Ha ocurrido un error al intentar realizar el registro.';
			}

			$this->cargaMiembro();
			
		}

function update() {
			$data = $this->Jefe_Model->findJefeCarga();	

			$this->form_validation->set_rules('nombre', 'Nombre del Jefe de Familia', 'required|trim|xss_clean');
			$this->form_validation->set_rules('apellido', 'Rif del Jefe de Familia', 'required|trim|xss_clean');
			$this->form_validation->set_rules('fecha_nac', 'Fecha de nacimiento', 'required|trim|xss_clean');
			$this->form_validation->set_rules('ced', 'Cédula del Jefe de Familia', 'trim|xss_clean');
			$this->form_validation->set_rules('telef', 'Teléfono personal', 'trim|xss_clean');
			$this->form_validation->set_rules('prof', 'Profesión', 'trim|xss_clean');
			$this->form_validation->set_rules('oficio', 'Oficio/Ocupación', 'trim|xss_clean');	
			
			$this->form_validation->set_message('required', 'Debe introducir el %s');
			$this->form_validation->set_message('min_length', 'El campo %s debe ser de al menos %s carácteres');

			$datos['params'] = array('id'=>$this->input->post('id'),
									 'idjefef' => $data,
									 'nombre' => $this->input->post('nombres'),
									 'apellido' => $this->input->post('apellidos'),
									 'fecha_nac' => $this->input->post('fecha_nac'),					 
								     'ced' => $this->input->post('cedula'),
								     'telef' => $this->input->post('telefono'),
									 'prof' => $this->input->post('profesion'),					 
								     'oficio' => $this->input->post('oficio'),
								     'calle' => $this->input->post('calle')

			);	

			
			$actualizo = $this->Carga_Model->actualizar($datos['params']);

			if ($actualizo) {
				$data['satisfactorio'] = "La actualización se realizo satisfactoriamente. ";      
			}else{
				$data['fallo'] = 'Ha ocurrido un error al intentar actualizar el registro.';
			}

			$this->updateMiembro();
	
	}

	function cargaMiembro(){

		$idcarga = $this->Carga_Model->findCarga();			
		$datos['params'] = array('comisionid'=>$this->input->post('comisionid'),
								 'cargaid' => $idcarga);
		/*print_r($datos);
		break;*/
			$registro = $this->Carga_Model->insertarMiembros($datos['params']);

			$this->index();
	}

	function updateMiembro(){
		$datos['params'] = array('comisionid'=>$this->input->post('comisionid'),
								 //'idjefe' => $data,
								 'cargaid' => $this->input->post('id'));
		
		// print_r($datos);
		// break;
			$registro = $this->Carga_Model->updateMiembros($datos['params']);
			// print_r($registro);
			// break;
			$this->index();
	}

	function actualizaCarga(){
		$data['carga'] = $this->Carga_Model->findCarga_familiarById($this->input->post('id'));
		$data['comision'] = $this->Jefe_Model->comision();
		$this->load->view('menu');		
		$this->load->view('actualizaCarga', $data, null, true);
	}

	function cargaFilter() {
			$elemento = $this->input->post('cedula');
			// print_r($elemento);
			// break;
					$data['carga'] = $this->Carga_Model->findCargaFilter($elemento);
					$this->load->view('menu');	
					if ($data['carga']==0) {
						$data['info'] = "No hay registros. "; 
						$this->load->view('adminCarga', $data, null, true);     
					}else{
						$this->load->view('adminCarga', $data, null, true);
					}						
					
			}
}