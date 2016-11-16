<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    //recibe datos del controlador para agregar cuenta usuario
    function insertar($params) {
    	$this->db->insert('usuario', $this->db->escape($params));
    	
    }

    function actualizar($params) {
    	$data = $this->db->where('id', $params['id'])->update('usuario', $params);
    	return $data;
    }

    function eliminar($params) {
    	return $this->db->where('id',$params->id)->delete('usuario');
    }


