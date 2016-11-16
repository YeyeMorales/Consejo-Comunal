<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Consejo_Model extends CI_Model {

    public function __construct() 
    {
        parent::__construct();
    }

        //recibe datos del controlador para agregar el consejo comunal
    function insertar($params) {
        return $this->db->insert('consejoc', $this->db->escape($params)); 
    }
 
    function actualizar($params) {
        $data = $this->db->where('id', $params['id'])->update('consejoc', $params);
        return $data;  
    }

    function eliminar($id) {
        return $this->db->where('id',$id)->delete('consejoc');
    }

    function findConsejoc(){   
        $query = $this->db->select('consejoc.id, consejoc.nombre, consejoc.rif, n_sectores.nombre_sector');
        $query = $this->db->from("consejoc");
        $query = $this->db->join("n_sectores","n_sectores.id = consejoc.n_sector","inner");
        $query = $this->db->order_by("nombre","ASC");

        $query = $this->db->get('');
            if ($query->num_rows() > 0) {
                    foreach ($query->result() as $fila) {
                        $data[] = $fila;
                    }
                    return $data;
            }
    }

    function findConsejocById($id){   
        $query = $this->db->select('*')->where('id',$id)->get('consejoc');
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $fila) {
                    $data[] = $fila;
                }
                return $data;
            }
    }

    function findConsejoAssociado($id){   
        $query = $this->db->select('id')->where('id',$id)->get('consejoc');
        foreach ($query->result() as $fila) {
                    $data = $fila;
                }
        return $data;
    } 

}