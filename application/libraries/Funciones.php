<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Funciones {

	public function calcular_tiemporecorrido($tiempofin, $tiempoinicio){
		$separo[1] = explode(':', $tiempofin);
		$separo[2] = explode(':', $tiempoinicio);

		$total_minutos_transcurridos[1] = ($separo[1][0]*60)+$separo[1][1];
		$total_minutos_transcurridos[2] = ($separo[2][0]*60)+$separo[2][1];
		$total_minutos_transcurridos = $total_minutos_transcurridos[1]-$total_minutos_transcurridos[2];

		if ($total_minutos_transcurridos <= 59) return ('00:'.$total_minutos_transcurridos);
		elseif ($total_minutos_transcurridos > 59) {
			$hora_transcurrida = round($total_minutos_transcurridos / 60);
			if ($hora_transcurrida <= 9) $hora_transcurrida='0'.$hora_transcurrida;
			$minutos_transcurridos = $total_minutos_transcurridos % 60;
			if ($minutos_transcurridos <= 9) $minutos_transcurridos = '0'.$minutos_transcurridos;
			return (($hora_transcurrida).':'.$minutos_transcurridos);
		}

	}

	public function diasemana($fecha) {
		$fechats = strtotime($fecha);
				switch (date('w', $fechats)){
					case 0: 
						$dia = "Domingo";
						return $dia; 
					break;
					case 1: 
						$dia = "Lunes";
						return $dia;
						break;
					case 2: 
						$dia = "Martes";
						return $dia;
						break;
					case 3: 
						$dia = "Miercoles";
						return $dia;
						break;
					case 4: 
						$dia = "Jueves";
						return $dia;
						break;
					case 5: 
						$dia = "Viernes";
						return $dia;
						break;
					case 6: 
						$dia = "Sabado";
						return $dia;
						break;
				}
	}

}
?>