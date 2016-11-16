<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
 
class Auth{
	protected $CI;
	
/*
*	creamos una instancia del super objeto de codeigniter
*	en el constructor para poder tenerlo disponible las veces
*	que necesitemos sin repetir la misma línea
*/
	public function __construct(){
		$this->CI = & get_instance();
		$this->CI->load->config('galbaAuth', TRUE);
		$this->CI->load->model('Auth_Model');
	}

/*
*	Limpiamos la cache
*/
	public function removeCache(){
    	$this->CI->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
    	$this->CI->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
    	$this->CI->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
    	$this->CI->output->set_header('Pragma: no-cache');
    }
	
/*
*	creamos una token para nuestros formularios
*/
	public function token(){
        $token = md5(uniqid(rand(),true));
        $this->CI->session->set_userdata('token',$token);
        return $token;
    }

	public function login($params){
		$data = array();
	    if (empty($params['usuario']) || empty($params['contrasena'])){
			return FALSE;
		}

		$query = $this->CI->Auth_Model->checkPass($params['usuario'], $params['contrasena']); 

		if (!$this->isLock($params['usuario'])==TRUE) { 
			if (!$query == FALSE) { 
				if (!$this->isLogin($params['usuario'])==TRUE) {
					$this->CI->session->sess_destroy();
			    	$this->CI->session->sess_create();
			    	$this->session_user($query);
			    	return TRUE; 
				}else{
					$this->removeCache();
					$data['error']= 'LOG_IN';
				}		
			}else{
				if ($this->isMaxLoginAttemp($params['usuario'])== 'MaxLoginAttempExceeded'){
					return FALSE;
				}else{
					$this->CI->session->set_flashdata('usuario_incorrecto','El usuario o la contraseña ingresada son incorrectos.');
					return FALSE;
				}	
			}
		}else{
			$this->removeCache();
			$data['error']= 'LOCK';
		}
		return $data;
	}

	public function getUsersInAtempps(){
		return $this->CI->Auth_Model->getUsersInAttempps();
	}

	public function session_user($query){ 
	    $this->CI->session->set_userdata(array(
            'nombre_usuario'        => $query->nombre_usuario,
            'grupoid'               => $query->n_grupoid,
            'id_usuario'            => $query->id,
		));
		//$this->create_log($query->id, $login = 'TRUE');
		$this->entrada($query);
	}

	function isLock($user){
		return FALSE;
		/*
		$user = $this->CI->Auth_Model->getUser($user);
		if ($user) {
			if ($user->n_rol_id <> 3) {
				$loginLock = $this->CI->Auth_Model->getLoginAttemps($user->id);
				if ($loginLock) {
					if ($loginLock[0]->lock == 't') {
						return TRUE;
					}else{
						return FALSE;
					}
				}
			}
		}*/
	}

	function isLogin($user){
		return FALSE;
		/*$user = $this->CI->Auth_Model->getUser($user);

		if ($user) {
			if ($user->n_rol_id <> 3) {
				$logLogin = $this->CI->Auth_Model->getLoginAttemps($user->id);
				if ($logLogin) {
					if ($logLogin[0]->login == 't') {
						return $this->isUserActive($user->id);
					}else{
						return FALSE;
					}
				}
			}
		}	*/
	}

	function isUserActive($id_user){
		$query = $this->CI->Auth_Model->activeUser($id_user);

		if ($query->num_rows() > 0) {
			$check = strtotime(date("Y-m-d H:i:s"))-strtotime($query->row()->fecha);

			if ($check > $this->CI->config->item('downtime', 'galbaAuth')) {
				$this->deleteAttemptsById($id_user);
				return FALSE;
			}else{
				return TRUE;
			}
		}else{
			$this->deleteAttemptsById($id_user);
			return FALSE;
		}

	}	

	function isMaxLoginAttemp($user){
		if ($this->CI->config->item('login_attempt_limit', 'galbaAuth')) {
			$user = $this->CI->Auth_Model->getUser($user);			
			if ($user) {
				if ($user->n_rol_id <> 3) {
					$loginExecceed = $this->CI->Auth_Model->getLoginAttemps($user->id);
					if ($loginExecceed) {
						if ($loginExecceed[0]->attempt >= $this->CI->config->item('login_attempt_limit', 'galbaAuth')) {
							$this->CI->session->set_flashdata('usuario_incorrecto','Por su seguridad su cuenta ha sido bloqueada, por Favor contacte su Administrador');
							$values['params'] = array('lock'=>'TRUE');
							$update = $this->CI->Auth_Model->increaseAttemps($loginExecceed[0]->id_user, $values['params']);
							return 'MaxLoginAttempExceeded';
						}else{
							$attempt = (int)$loginExecceed[0]->attempt + 1;
							$values['params'] = array('attempt'=>$attempt);
							$update = $this->CI->Auth_Model->increaseAttemps($loginExecceed[0]->id_user, $values['params']);
							$this->CI->session->set_flashdata('inf_usuario','Estimado usuario usted dispone de 3 intentos para ingresar al sistema.');
				
							return 'FALSE';
						}
					}else{
						$this->create_log($user->id, $login = 'FALSE');
						return 'FALSE';
					}
				}
			}
		}		
	}

/*
*	Registramos la entrada
*/
    function entrada($query){
    	$arrayCampos = array(
           'id' => $this->CI->session->userdata('session_id'),
           'f_entrada' => date("Y-n-j H:i"), 
           'ip' => $this->CI->session->userdata('ip_address'),
           'navegador' => $this->CI->session->userdata('user_agent'),
           'nombre_usuario'=>$query->nombre_usuario
	    );

		$this->CI->Auth_Model->entrada($arrayCampos);
    }

    function create_log($id_user, $login) {
    	$this->deleteAttemptsById($id_user);
		$arrayCampos = array('id_user' => $id_user, 
					'login'=>$login, 
					'lock' => $lock= 'FALSE',
					'date_lock' => date("Y-n-j"),
					'attempt' => $var='1', 
					'ip' => $this->CI->session->userdata('ipAddress'));
		$this->CI->Auth_Model->create_log($arrayCampos);
	}
/*
*	función para comprobar si el usuario está logueado
*/
	public function is_logged(){		
		return $this->CI->session->userdata('nombre_usuario') !== FALSE ? TRUE : FALSE;		
	}

	public function is_enabled(){		
		return $this->CI->session->userdata('enabled') !== 'f' ? TRUE : FALSE;		
	}

	public function rolUser(){
		switch ($this->CI->session->userdata('n_rol_id')) {
			case '1':
				return 'IS_ADMIN';
				break;

			case '2':
				return 'IS_OPERADOR';
				break;
		
			default:
				# code...
				break;
		}
        return ; 
    }

/*
*	Registramos la salida
*/
    function salida(){
    	$arrayCampos = array(
			'f_salida' => date("Y-n-j H:i"),
			'ultima_actividad' => $this->CI->session->userdata('last_activity'));
		$this->CI->db->where('id', $this->CI->session->userdata('session_id'));
		$this->CI->db->update('sesion', $arrayCampos);
    }

/*
*	Cierre de sesion
*/
	private function deleteAttemptsById($id_user){
		$this->CI->Auth_Model->deleteAttemptsById($id_user);
	}

    public function cerrar_sesion(){
    	$this->salida();
		//$this->deleteAttemptsById($this->CI->session->userdata('id_usuario'));
		
		$query=$this->CI->session->sess_destroy();
		delete_cookie("ci_session");
		
		$this->removeCache();
		//return $query;
	}
}