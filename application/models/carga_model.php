<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Carga_Model extends CI_Model {

    public function __construct() 
    {
        parent::__construct();
    }

        //recibe datos del controlador para agregar el consejo comunal
    function insertar($params) {
        return $this->db->insert('carga_familiar', $this->db->escape($params)); 
    }
 
    function actualizar($params) {
        $data = $this->db->where('id', $params['id'])->update('carga_familiar', $params);
        return $data;  
    }

    function eliminar($id) {
        return $this->db->where('id',$id)->delete('carga_familiar');
    }

    function findCarga_familiar($id){   
        $query = $this->db->select('carga_familiar.id, carga_familiar.nombre, carga_familiar.apellido, carga_familiar.ced, carga_familiar.calle, carga_familiar.telef');
        $query = $this->db->from("carga_familiar");
        $query = $this->db->order_by("nombre","ASC");

        $query = $this->db->get('');
            if ($query->num_rows() > 0) {
                    foreach ($query->result() as $fila) {
                        $data[] = $fila;
                    }
                    return $data;
            }
    }

    function findCarga_familiarById($id){   
        $query = $this->db->select('*')->where('id',$id)->get('carga_familiar');
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $fila) {
                    $data[] = $fila;
                }
                return $data;
            }
    }

    function findCarga_familiarAssociado($id){   
        $query = $this->db->select('id')->where('id',$id)->get('carga_familiar');
        foreach ($query->result() as $fila) {
                    $data = $fila;
                }
        return $data;
    } 

    function findCarga(){   
        $query = $this->db->select('id');
        $query = $this->db->from("carga_familiar");
        $query = $this->db->order_by("id","desc");
        $query = $this->db->limit('1');
        $query = $this->db->get();
        $restulpersona = $query->result();
        return $restulpersona[0]->id;
    }

    function insertarMiembros($params) {
        return $this->db->insert('miembros', $this->db->escape($params)); 
    }

     function updateMiembros($params) {
         $data = $this->db->where('cargaid', $params['cargaid'])->update('miembros', $params);
        return $data;
    }
 

     function findCargaFilter($elemento) {   
        $this->db->select('*');
        $this->db->from('carga_familiar');
        $this->db->where('ced',$elemento);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $fila) {
                $data[] = $fila;
            }
            return $data;
        }
    }

    function cargaMiembrosUno(){
        $query = $this->db->select('nombre_comision, idcomision, nombre, apellido, ced, telef, prof');
        $query = $this->db->from('carga_familiar');
        $query = $this->db->join('miembros', 'carga_familiar.id = miembros.cargaid', 'inner');
        $query = $this->db->join('n_comision', 'n_comision.idcomision = miembros.comisionid', 'inner');
        $query = $this->db->where('idcomision','1');
            $query = $this->db->get('');
             if ($query->num_rows() > 0) {
                foreach ($query->result() as $fila) {
                    $data[] = $fila;
                }
                return $data;
            }  
    }

    function cargaMiembrosDos(){
        $query = $this->db->select('nombre_comision, idcomision, nombre, apellido, ced, telef, prof');
        $query = $this->db->from('carga_familiar');
        $query = $this->db->join('miembros', 'carga_familiar.id = miembros.cargaid', 'inner');
        $query = $this->db->join('n_comision', 'n_comision.idcomision = miembros.comisionid', 'inner');
        $query = $this->db->where('idcomision','2');
            $query = $this->db->get('');
             if ($query->num_rows() > 0) {
                foreach ($query->result() as $fila) {
                    $data[] = $fila;
                }
                return $data;
            }  
    }

    function cargaMiembrosTres(){
        $query = $this->db->select('nombre_comision, idcomision, nombre, apellido, ced, telef, prof');
        $query = $this->db->from('carga_familiar');
        $query = $this->db->join('miembros', 'carga_familiar.id = miembros.cargaid', 'inner');
        $query = $this->db->join('n_comision', 'n_comision.idcomision = miembros.comisionid', 'inner');
        $query = $this->db->where('idcomision','3');
            $query = $this->db->get('');
             if ($query->num_rows() > 0) {
                foreach ($query->result() as $fila) {
                    $data[] = $fila;
                }
                return $data;
            }  
    }

    function cargaMiembrosCuatro(){
        $query = $this->db->select('nombre_comision, idcomision, nombre, apellido, ced, telef, prof');
        $query = $this->db->from('carga_familiar');
        $query = $this->db->join('miembros', 'carga_familiar.id = miembros.cargaid', 'inner');
        $query = $this->db->join('n_comision', 'n_comision.idcomision = miembros.comisionid', 'inner');
        $query = $this->db->where('idcomision','4');
            $query = $this->db->get('');
             if ($query->num_rows() > 0) {
                foreach ($query->result() as $fila) {
                    $data[] = $fila;
                }
                return $data;
            }  
    }

    function cargaMiembrosCinco(){
        $query = $this->db->select('nombre_comision, idcomision, nombre, apellido, ced, telef, prof');
        $query = $this->db->from('carga_familiar');
        $query = $this->db->join('miembros', 'carga_familiar.id = miembros.cargaid', 'inner');
        $query = $this->db->join('n_comision', 'n_comision.idcomision = miembros.comisionid', 'inner');
        $query = $this->db->where('idcomision','5');
            $query = $this->db->get('');
             if ($query->num_rows() > 0) {
                foreach ($query->result() as $fila) {
                    $data[] = $fila;
                }
                return $data;
            }  
    }

    function cargaMiembrosJefe(){
        $query = $this->db->select('nombre_comision, idcomision, nombres, apellidos, cedula, telefono, profesion, oficio');
        $query = $this->db->from('jefe_familia');
        $query = $this->db->join('miembros', 'jefe_familia.id = miembros.idjefe', 'inner');
        $query = $this->db->join('n_comision', 'n_comision.idcomision = miembros.comisionid', 'inner');
        $query = $this->db->where('idcomision','1');
            $query = $this->db->get('');
             foreach ($query->result() as $fila) {
                    $data = $fila;
                }
        return $data;
    }
}