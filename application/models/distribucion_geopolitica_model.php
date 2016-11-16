<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Distribucion_geopolitica_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    function getEstados() {
        $this->db->order_by('nombre_estado', 'asc');
        return $this->db->get('n_estados')->result();
    }

    function getmunicipios($id) {
        $this->db->order_by('nombre_municipio', 'asc');
        $this->db->where( array('n_estado_id' => $id) );
        return $this->db->select('n_municipios.id, n_municipios.nombre_municipio')
        ->from('n_estados')
        ->join('n_municipios', 'n_municipios.n_estado_id = n_estados.id')
        ->get()->result();
    }

    function getparroquias($id) {
        $this->db->order_by('nombre_parroquia', 'asc');
        $this->db->where( array('n_municipios.id' => $id) );
        return $this->db->select('n_parroquias.id, n_parroquias.nombre_parroquia')
        ->from('n_municipios')
        ->join('n_parroquias', 'n_parroquias.n_municipio_id = n_municipios.id')
        ->get()->result();
    }

    function getsectores($id) {
        $this->db->order_by('id', 'asc');
        $this->db->where( array('n_parroquias.id' => $id) );
        return $this->db->select('n_sectores.id, n_sectores.nombre_sector')
        ->from('n_parroquias')
        ->join('n_sectores', 'n_sectores.n_parroquias_id = n_parroquias.id')
        ->get()->result();
    }
}