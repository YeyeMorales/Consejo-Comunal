<?php
/**
En esta clase se encuentran metodos que facilitan la vida para trabajar de forma integrada con el framework
php CodeIgniter y el framework jqGrid.
*/
/**
*
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
 <http://www.gnu.org/licenses/>.

*********************************************************************************
Este programa es software libre: usted puede redistribuirlo y / o modificar
* Bajo los términos de la GNU General Public License publicada por
* la Free Software Foundation, bien de la versión 3 de la Licencia, o
* cualquier versión posterior.
*
* Este programa se distribuye con la esperanza de que sea útil,
* pero SIN NINGUNA GARANTÍA, incluso sin la garantía implícita de
* COMERCIALIZACIÓN o IDONEIDAD PARA UN PROPÓSITO PARTICULAR. Consulte la
* Licencia Pública General GNU para más detalles.
<http://www.gnu.org/licenses/>.
 *
* @author Manuel Alejandro Marquez Ortiz <punketo28@gmail.com>
 * A.K.A. @punketo28
* @date 2011/01/07
*/

class Atajo
{

  function __construct()
  {
      $this->CI = & get_instance();
      $this->CI->load->model('auditoria_model');
      
  }

  /*Metodo copiado de los demos de jqGrid con algunas adaptaciones para validar que un dato introducido por
   el usuario sea integer, float o string si asi es requerido por la aplicacion.
  */
  function datoCompatibleSql($campo, $value) {
  // we need here more advanced checking using the type of the field - i.e. integer, string, float
  switch ($campo) {
    case 'id':
      return intval($value);//intval() Obtiene el valor entero de una variable
      break;
    case 'amount':
    case 'tax':
    case 'total':
      return floatval($value);//floatval() Obtiene el valor flotante de una variable
      break;
    default :
      //addslashes() Añade barras invertidas a los caracteres ('),("),(\),(nul) que esten dentro de la cadena.
      return addslashes($value);
  }
}
  //Metodo que me construye el Grid junto con el modulo de busqueda avanzada de jqGrid.
  function construyeData($sidx, $sord, $start, $limit, $searchFlag, $filters, $seleccion, $table, $opcion){
  	if($opcion == 1){
  		$this->CI->db = $this->CI->load->database('seguridad', TRUE);
  	}else{
  		$this->CI->db = $this->CI->db;
  	}
  	$qopers = array(//Aqui se crea un array cuyos elementos son las opciones del array sopt.
          'ne'=>" != ",
          'lt'=>" < ",
          'le'=>" <= ",
          'gt'=>" > ",
          'ge'=>" >= ",
          'bw'=>" LIKE ",
          'bn'=>" NOT LIKE ",
          'ew'=>" LIKE ",
          'en'=>" NOT LIKE ",
          'cn'=>" LIKE " ,
          'nc'=>" NOT LIKE " );

     $this->CI->db->select($seleccion);
      if ($searchFlag == 'true'){
        if($filters){
         $filtros = json_decode($filters,true);
         if(is_array($filtros)){
           $groupop = $filtros['groupOp'];//AND o OR
           $reglas = $filtros['rules'];// field | op | data
           if ($groupop == 'AND'){
             foreach($reglas as $key=>$val) {
               $campo = $val['field'];//columna de busqueda
               $operador = $val['op'];//Operador de la busqueda (opciones del array sopt)
               $value = strtoupper($val['data']);//La data de busqueda introducida por el usuario. // el strtoupper es para cambiar la data que llega a mayuscula, debido a q la información en db sta en mayuscula
               if($value && $operador){
                 $value = $this->datoCompatibleSql($campo, $value);
                 switch ($operador) {
                   case "eq":
                     $this->CI->db->where($campo, $value);
                     break;
                   case "ne":
                     $this->CI->db->where($campo.$qopers['ne'], $value);
                     break;
                   case "lt":
                     $this->CI->db->where($campo.$qopers['lt'], $value);
                     break;
                   case "le":
                     $this->CI->db->where($campo.$qopers['le'], $value);
                     break;
                   case "gt":
                     $this->CI->db->where($campo.$qopers['gt'], $value);
                     break;
                   case "ge":
                     $this->CI->db->where($campo.$qopers['ge'], $value);
                     break;
                   case "bw":
                     $value = strtolower($value);
                     $this->CI->db->where($campo.$qopers['bw'], $value.'%')->or_where($campo.$qopers['bw'], strtoupper($value).'%')
                     ->or_where($campo.$qopers['bw'], ucfirst($value).'%')->or_where($campo.$qopers['bw'], ucwords($value).'%');
                     break;
                   case "bn":
                     $this->CI->db->where($campo.$qopers['bn'], $value.'%');
                     break;
                   case "in":
                     $valuesArray = explode(",", $value);
                     $this->CI->db->where_in($campo, $valuesArray);
                     break;
                   case "ni":
                     $valuesArray = explode(",", $value);
                     $this->CI->db->where_not_in($campo, $valuesArray);
                     break;
                   case "ew":
                     $value = strtolower($value);
                     $this->CI->db->where($campo.$qopers['ew'], '%'.$value)->or_where($campo.$qopers['ew'], '%'.strtoupper($value))
                     ->or_where($campo.$qopers['ew'], '%'.ucfirst($value))->or_where($campo.$qopers['ew'], '%'.ucwords($value));
                     break;
                   case "en":
                     $this->CI->db->where($campo.$qopers['en'], '%'.$value);
                     break;
                   case "cn":
                     $value = strtolower($value);
                     $this->CI->db->where($campo.$qopers['cn'], '%'.$value)->or_where($campo.$qopers['cn'], '%'.strtoupper($value))
                     ->or_where($campo.$qopers['cn'], '%'.ucfirst($value))->or_where($campo.$qopers['cn'], '%'.ucwords($value))
                     ->or_where($campo.$qopers['cn'], $value.'%')->or_where($campo.$qopers['cn'], strtoupper($value).'%')
                     ->or_where($campo.$qopers['cn'], ucfirst($value).'%')->or_where($campo.$qopers['cn'], ucwords($value).'%')
                     ->or_where($campo.$qopers['cn'], '%'.$value.'%')->or_where($campo.$qopers['cn'], '%'.strtoupper($value).'%')
                     ->or_where($campo.$qopers['cn'], '%'.ucfirst($value).'%')->or_where($campo.$qopers['cn'], '%'.ucwords($value).'%');
                     break;
                   case "nc":
                     $this->CI->db->where($campo.$qopers['nc'], '%'.$value.'%');
                     break;
                }
               }
             }
           }
           else if ($groupop == 'OR'){
             $i = 0;
             foreach($reglas as $key=>$val) {
               $campo = $val['field'];//columna de busqueda
               $operador = $val['op'];//Operador de la busqueda (opciones del array sopt)
               $value = strtoupper($val['data']);//La data de busqueda introducida por el usuario. // el strtoupper es para cambiar la data que llega a mayuscula, debido a q la información en db sta en mayuscula

               if($value && $operador) {//si se recibio el operador y la data entonces.. (esto se hace para validar que el usuario no halla enviado estos campos en blancos)
                 $i++;
                 $value = $this->datoCompatibleSql($campo, $value);

                 switch ($operador) {
                   case "eq":
                     if ($i == 1)
                       $this->CI->db->where($campo, $value);
                     else
                       $this->CI->db->or_where($campo, $value);
                     break;
                   case "ne":
                     if ($i == 1)
                       $this->CI->db->where($campo.$qopers['ne'], $value);
                     else
                       $this->CI->db->or_where($campo.$qopers['ne'], $value);
                     break;
                   case "lt":
                      if ($i == 1)
                       $this->CI->db->where($campo.$qopers['lt'], $value);
                      else
                       $this->CI->db->or_where($campo.$qopers['lt'], $value);
                     break;
                   case "le":
                     if ($i == 1)
                       $this->CI->db->where($campo.$qopers['le'], $value);
                     else
                       $this->CI->db->or_where($campo.$qopers['le'], $value);
                     break;
                   case "gt":
                     if ($i == 1)
                       $this->CI->db->where($campo.$qopers['gt'], $value);
                     else
                       $this->CI->db->or_where($campo.$qopers['gt'], $value);
                     break;
                   case "ge":
                     if ($i == 1)
                       $this->CI->db->where($campo.$qopers['ge'], $value);
                     else
                       $this->CI->db->or_where($campo.$qopers['ge'], $value);
                     break;
                   case "bw":
                     if ($i == 1){
                      $value = strtolower($value);
                      $this->CI->db->where($campo.$qopers['bw'], $value.'%')->or_where($campo.$qopers['bw'], strtoupper($value).'%')
                      ->or_where($campo.$qopers['bw'], ucfirst($value).'%')->or_where($campo.$qopers['bw'], ucwords($value).'%');
                     }
                     else
                       $value = strtolower($value);
                       $this->CI->db->or_where($campo.$qopers['bw'], $value.'%')->or_where($campo.$qopers['bw'], strtoupper($value).'%')
                       ->or_where($campo.$qopers['bw'], ucfirst($value).'%')->or_where($campo.$qopers['bw'], ucwords($value).'%');
                     break;
                   case "bn":
                     if ($i == 1)
                       $this->CI->db->where($campo.$qopers['bn'], $value.'%');
                     else
                       $this->CI->db->or_where($campo.$qopers['bn'], $value.'%');
                     break;
                   case "in":
                     if ($i == 1){
                       $valuesArray = explode(",", $value);
                       $this->CI->db->where_in($campo, $valuesArray);
                     }
                     else{
                       $valuesArray = explode(",", $value);
                       $this->CI->db->or_where_in($campo, $valuesArray);
                     }
                     break;
                   case "ni":
                     if ($i == 1){
                      $valuesArray = explode(",", $value);
                      $this->CI->db->where_not_in($campo, $valuesArray);
                     }
                     else{
                       $valuesArray = explode(",", $value);
                       $this->CI->db->or_where_not_in($campo, $valuesArray);
                     }
                     break;
                   case "ew":
                     if ($i == 1){
                       $value = strtolower($value);
                       $this->CI->db->where($campo.$qopers['ew'], '%'.$value)->or_where($campo.$qopers['ew'], '%'.strtoupper($value))
                       ->or_where($campo.$qopers['ew'], '%'.ucfirst($value))->or_where($campo.$qopers['ew'], '%'.ucwords($value));
                     }
                     else
                       $value = strtolower($value);
                       $this->CI->db->or_where($campo.$qopers['ew'], '%'.$value)->or_where($campo.$qopers['ew'], '%'.strtoupper($value))
                       ->or_where($campo.$qopers['ew'], '%'.ucfirst($value))->or_where($campo.$qopers['ew'], '%'.ucwords($value));
                     break;
                   case "en":
                     if ($i == 1)
                       $this->CI->db->where($campo.$qopers['en'], '%'.$value);
                     else
                       $this->CI->db->or_where($campo.$qopers['en'], '%'.$value);
                     break;
                   case "cn":
                     $value = strtolower($value);
                     if ($i == 1)
                       $this->CI->db->where($campo.$qopers['cn'], '%'.$value)->or_where($campo.$qopers['cn'], '%'.strtoupper($value))
                       ->or_where($campo.$qopers['cn'], '%'.ucfirst($value))->or_where($campo.$qopers['cn'], '%'.ucwords($value))
                       ->or_where($campo.$qopers['cn'], $value.'%')->or_where($campo.$qopers['cn'], strtoupper($value).'%')
                       ->or_where($campo.$qopers['cn'], ucfirst($value).'%')->or_where($campo.$qopers['cn'], ucwords($value).'%')
                       ->or_where($campo.$qopers['cn'], '%'.$value.'%')->or_where($campo.$qopers['cn'], '%'.strtoupper($value).'%')
                       ->or_where($campo.$qopers['cn'], '%'.ucfirst($value).'%')->or_where($campo.$qopers['cn'], '%'.ucwords($value).'%');
                     else
                       $this->CI->db->or_where($campo.$qopers['cn'], '%'.$value)->or_where($campo.$qopers['cn'], '%'.strtoupper($value))
                       ->or_where($campo.$qopers['cn'], '%'.ucfirst($value))->or_where($campo.$qopers['cn'], '%'.ucwords($value))
                       ->or_where($campo.$qopers['cn'], $value.'%')->or_where($campo.$qopers['cn'], strtoupper($value).'%')
                       ->or_where($campo.$qopers['cn'], ucfirst($value).'%')->or_where($campo.$qopers['cn'], ucwords($value).'%')
                       ->or_where($campo.$qopers['cn'], '%'.$value.'%')->or_where($campo.$qopers['cn'], '%'.strtoupper($value).'%')
                       ->or_where($campo.$qopers['cn'], '%'.ucfirst($value).'%')->or_where($campo.$qopers['cn'], '%'.ucwords($value).'%');
                     break;
                   case "nc":
                     if ($i == 1)
                       $this->CI->db->where($campo.$qopers['nc'], '%'.$value.'%');
                     else
                       $this->CI->db->or_where($campo.$qopers['nc'], '%'.$value.'%');
                     break;
                }
              }
            }
           }
         }
        }
      }
     $this->CI->db->order_by($sidx, $sord)->limit($limit, $start);
     $query = $this->CI->db->get($table);
     if($query->num_rows() > 0){
     foreach ($query->result() as $fila) {
       $data[] = $fila;
     }
     return $data;
   }
  }

////// cierre de funcion
}
?>
