<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    //recibe datos del controlador para agregar cuenta usuario
    function insertar($params) {
    	return  $this->db->insert('usuario', $this->db->escape($params));
    	
    }

    function actualizar($params) {
    	return $this->db->where('id', $params['id'])->update('usuario', $params);
    }

    function eliminar($id) {
        return $this->db->where('id',$id)->delete('usuario');
    }

    function checkUsername($usuario){
        $query = $this->db->select('usuario')->where('nombre_usuario', $usuario)->get('usuario');
        return $query->num_rows();
    }

    function findUsuarios(){   
        $query = $this->db->select('usuario.id, usuario.nombre_usuario, usuario.cedula, usuario.email');

        $query = $this->db->from("usuario");

        $query = $this->db->order_by("nombre_usuario","ASC");

        $query = $this->db->get("");

        if ($query->num_rows() > 0) {
                foreach ($query->result() as $fila) {
                    $data[] = $fila;
                }
                return $data;
            }
    }

    function findUsuarioById($id){   
        $query = $this->db->select('id, nombre_usuario, cedula, email')->where('id',$id)->get('usuario');
        if ($query->num_rows() > 0) {
                foreach ($query->result() as $fila) {
                    $data[] = $fila;
                }
                return $data;
            }
    }

    function changePassword($registro){
        $id  = $this->session->userdata('id_usuario');
        $query=$this->db->select('usuario');
        $this->db->where('id', $id);
        $this->db->update('usuario', $registro);
        return $query;

    }

}


