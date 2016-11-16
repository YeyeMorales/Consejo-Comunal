<?php

/**
 * Provee la implementacion para el registro de auditorias del sistema.
 */
class Audit {

    /**
     * Contiene la instancia de CI
     * @var $CI CodeIgniter
     */
    public $CI = NULL;

    /**
     * Contiene el resultado de la operacion ([Default] ACCESS, SUCCESS, FAILURE).
     * @var $result String
     */
    public $result;

    /**
     * Contiene los datos utlizados en la operaion. 
     * @var $result Mixed
     */
    public $data;
    
    public $accion;

    public function __construct() {
       	$this->CI = & get_instance();
        $this->result = 'ACCESS';
        $this->accion = 'ACCEDIÓ';
        $this->data = NULL;
        $this->CI->load->model('auditoria_model');
    }

    public function getAccion() {
    	return $this->accion;
    }
    
    public function setAccion($arg) {

        switch ($arg) {
            case 1: $this->accion = 'INSERTO'; break;
            case 2: $this->accion = 'ACTUALIZÓ'; break;
            case 3: $this->accion = 'ELIMINÓ'; break;
            default: false; break;
        }

        return $this->accion;
    }
    
    public function getResult() {
        return $this->result;
    }

    public function setResult($result) {
        if($result === TRUE)
            $this->result = 'SUCCESS';
        elseif($result === FALSE)
            $this->result = 'FAILURE';

        return $this->result;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($arg) {
        
        $container = array();

        if(is_array($arg)){

            foreach ($arg as $key => $value) {
                $container[] = '{'.$key.' = '.$value.'}';
            }
            $this->data = implode(";", $container);
            return $this->data;

        }else{

            $this->data = "No hay data asociada";
            return $this->data;
        }
    }


    function register() {
    	$id_usuario = $this->CI->session->userdata('grupoid');

        switch ($id_usuario) {
            case 1: $rol= "ADMIN"; break;
            case 2: $rol= "AUDITOR"; break;
            case 2: $rol= "OPERADOR-ADMIN"; break;
            case 4: $rol= "OPERADOR"; break;
            default: $rol= "AUN NO ES USUARIO"; break;
        }

    	
    	if ($this->CI->session->userdata('ipAddress')){
    		$ipAddress = $this->CI->session->userdata('ipAddress');
    	}else{
    		$ipAddress = $_SERVER['REMOTE_ADDR'];
    	}

        $data = array(
        	'user_id' => $this->CI->session->userdata('id_usuario'),
        	'usuario' => $this->CI->session->userdata('usuario'),
            'rol_usuario' => $rol,
            'url' => base_url($this->CI->input->server('REQUEST_URI')),
            'fecha' => date("Y-n-j H:i:s"),
            'ip' => $ipAddress,
        	'accion' => $this->getAccion(),
            'data' => $this->getData(),
            'result' => $this->getResult()
        );

        $this->CI->auditoria_model->add($data);
    }

}
