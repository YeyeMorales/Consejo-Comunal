<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth_Model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    function conectSeguridad(){
        return $this->load->database('seguridad', TRUE);
    }

    function activeUser($id_user){
        $tabla_audit = $this->conectSeguridad()->query("select * from nametableaudit_activa();");
        
        foreach ($tabla_audit->result() as $row){
            $tabla_auditoria = $row->nombre_tabla;
        }

        $sql = 'SELECT id, user_id, nombre_usuario, fecha, ip FROM '.$tabla_auditoria.'  WHERE user_id = '.$id_user.' order by fecha DESC limit(1);';
        
        return $this->conectSeguridad()->query($sql);   
    }

    function getUser($user){
        $query = $this->db->select('id, nombre_usuario')->where('nombre_usuario', $user)->get('usuario');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $fila) {
                $data = $fila;
            }
            return $data;
        }
    }

    public function checkPass($user, $pass){

    	$query = $this->db->get_where('usuario', array('nombre_usuario' => $user, 'contrasena' => $pass));
        if ($query->num_rows() > 0) {
    		foreach ($query->result() as $fila) {
    			$data = $fila;
    		}
    		return $data;
    	}else{
    		return FALSE;
    	}
    }

    function entrada($params) {
        $this->db->insert('sesion', $params);
    }

    function create_log($params) {
        $this->conectSeguridad()->insert('login_attempts', $params);
    }

    function getLoginAttemps($id_user){
        $query = $this->conectSeguridad()->select('id_user, login, lock, attempt')->where('id_user', $id_user)->get('login_attempts');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $fila) {
                $data = $query->result();
            }
            return $data;
        }
    }

    function increaseAttemps($id_user, $params){
        return $this->conectSeguridad()->where('id_user', $id_user)->update('login_attempts', $params);
    }

    function getUsersInAttempps(){
        $query = $this->conectSeguridad()->select('id_user, login, lock, attempt')->get('login_attempts');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $fila) {
                $data = $query->result();
            }
            return $data;
        }
    }
    function deleteAttemptsById($id_user){
        return $this->conectSeguridad()->where('id_user',$id_user)->delete('login_attempts');
    }

    function clearAttempts(){
        return $this->conectSeguridad()->delete('login_attempts'); 
    }
    
 }