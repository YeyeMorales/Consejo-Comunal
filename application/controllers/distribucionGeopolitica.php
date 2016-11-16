<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class DistribucionGeopolitica extends CI_Controller {


	function __construct() {
		parent::__construct();
		$this->load->model('Distribucion_geopolitica_model');
	}

	/**
	*@brief getEstados
	*@param
	*@return
	*/
	public function getEstados(){
		return true;
	}

	function getmunicipios($id) {
		$municipios = $this->Distribucion_geopolitica_model->getmunicipios($id);
		if( empty ( $municipios ) )
			return '{ "nombre_municipio": "No Existe" }';
		$arr_municipio = array();
		foreach ($municipios as $municipio) {
			$arr_municipio[] = '{"id":' . $municipio->id . ',"nombre_municipio":"' . ucfirst(strtolower($municipio->nombre_municipio)) . '"}';
		}
		echo '[ ' . implode(",",$arr_municipio) . ']';
		return;
	}


	function getparroquias($id) {
		$parroquias = $this->Distribucion_geopolitica_model->getparroquias($id);
		if( empty ( $parroquias ) )
			return '{ "nombre_parroquia": "No Existe" }';
		$arr_parroquia = array();
		foreach ($parroquias as $parroquia) {
			$arr_parroquia[] = '{"id":' . $parroquia->id . ',"nombre_parroquia":"' . ucfirst(strtolower($parroquia->nombre_parroquia)) . '"}';
		}
		echo '[ ' . implode(",",$arr_parroquia) . ']';
		return;
	}

	function getsectores($id) {
		$sectores = $this->Distribucion_geopolitica_model->getsectores($id);
		if( empty ( $sectores ) )
			return '{ "nombre_parroquia": "No Existe" }';
		$arr_sector = array();
		foreach ($sectores as $sector) {
			$arr_sector[] = '{"id":' . $sector->id . ',"nombre_sector":"' . ucfirst(strtolower($sector->nombre_sector)) . '"}';
		}
		echo '[ ' . implode(",",$arr_sector) . ']';
		return;
	}

}