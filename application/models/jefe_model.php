<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Jefe_Model extends CI_Model {

    public function __construct() 
    {
        parent::__construct();
    }

        //recibe datos del controlador para agregar cuenta usuario
    function insertar($params) {
        return $this->db->insert('jefe_familia', $this->db->escape($params)); 
    }
 
    function actualizar($params) {
        $data = $this->db->where('id', $params['id'])->update('jefe_familia', $params);
        return $data;  
    }

    function eliminar($id) {
        return $this->db->where('id',$id)->delete('jefe_familia');
    }

    function findJefe(){   
        $query = $this->db->select('jefe_familia.id, jefe_familia.nombres, jefe_familia.apellidos, jefe_familia.fecha_nac, jefe_familia.cedula, jefe_familia.telefono, jefe_familia.profesion, jefe_familia.oficio');
        $query = $this->db->from("jefe_familia");
        $query = $this->db->order_by("nombres","ASC");
        $query = $this->db->get('');
            if ($query->num_rows() > 0) {
                    foreach ($query->result() as $fila) {
                        $data[] = $fila;
                    }
                    return $data;
            }
    }

    function findJefeById($id){   
        $query = $this->db->select('*')->where('id',$id)->get('jefe_familia');
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $fila) {
                    $data[] = $fila;
                }
                return $data;
            }
    }

    function findJefeAssociado($id){   
        $query = $this->db->select('id')->where('id',$id)->get('jefe_familia');
        foreach ($query->result() as $fila) {
                    $data = $fila;
                }
        return $data;
    }

    function comision(){
       $query = $this->db->select('*');
       $query = $this->db->from('n_comision');
       $query = $this->db->get('');
        if ($query->num_rows() > 0) {
                    foreach ($query->result() as $fila) {
                        $data[] = $fila;
                    }
                    return $data;
            }
    } 

    function findJefeCarga(){   
        $query = $this->db->select('id');
        $query = $this->db->from("jefe_familia");
        $query = $this->db->order_by("id","desc");
        $query = $this->db->limit('1');
        $query = $this->db->get();
        $restulpersona = $query->result();
        return $restulpersona[0]->id;
    }

     function insertarJefeMiembro($params) {
        return $this->db->insert('miembros', $this->db->escape($params)); 
    }

    function updateMiembroJefe($params) {
        $data = $this->db->where('idjefe', $params['idjefe'])->update('miembros', $params);
        return $data;  
    }

    function findJefeFilter($elemento) {   
        $this->db->select('*');
        $this->db->from('jefe_familia');
        $this->db->where('cedula',$elemento);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $fila) {
                $data[] = $fila;
            }
            return $data;
        }
    }
    
}