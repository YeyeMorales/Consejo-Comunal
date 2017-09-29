-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 01-05-2016 a las 03:32:49
-- Versión del servidor: 5.1.37
-- Versión de PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de datos: `simple_bpm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion`
--

CREATE TABLE IF NOT EXISTS `accion` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) NOT NULL,
  `tipo` varchar(60) NOT NULL,
  `extra` text,
  `proceso_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_trigger_proceso1_idx` (`proceso_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campo`
--

CREATE TABLE IF NOT EXISTS `campo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `readonly` tinyint(1) NOT NULL DEFAULT '0',
  `valor_default` text NOT NULL,
  `posicion` int(10) unsigned NOT NULL,
  `tipo` varchar(32) NOT NULL,
  `formulario_id` int(10) unsigned NOT NULL,
  `etiqueta` text NOT NULL,
  `validacion` varchar(128) NOT NULL,
  `ayuda` text NOT NULL,
  `dependiente_tipo` enum('string','regex') DEFAULT 'string',
  `dependiente_campo` varchar(64) DEFAULT NULL,
  `dependiente_valor` varchar(256) DEFAULT NULL,
  `datos` text,
  `documento_id` int(10) unsigned DEFAULT NULL,
  `extra` text,
  `dependiente_relacion` enum('==','!=') DEFAULT '==',
  `fieldset` varchar(100) NULL,
  PRIMARY KEY (`id`),
  KEY `fk_campo_formulario1` (`formulario_id`),
  KEY `fk_campo_documento1_idx` (`documento_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=966 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conexion`
--

CREATE TABLE IF NOT EXISTS `conexion` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tarea_id_origen` int(10) unsigned NOT NULL,
  `tarea_id_destino` int(10) unsigned DEFAULT NULL,
  `tipo` enum('secuencial','evaluacion','paralelo','paralelo_evaluacion','union') NOT NULL,
  `regla` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tarea_origen_destino` (`tarea_id_origen`,`tarea_id_destino`),
  KEY `fk_ruta_tarea` (`tarea_id_origen`),
  KEY `fk_ruta_tarea1` (`tarea_id_destino`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE IF NOT EXISTS `cuenta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) NOT NULL,
  `nombre_largo` varchar(256) NOT NULL,
  `mensaje` text NOT NULL,
  `logo` varchar(128) DEFAULT NULL,
  `api_token` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dato_seguimiento`
--

CREATE TABLE IF NOT EXISTS `dato_seguimiento` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) NOT NULL,
  `valor` text NOT NULL,
  `etapa_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_etapa` (`nombre`,`etapa_id`),
  KEY `fk_dato_seguimiento_etapa1_idx` (`etapa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=325 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE IF NOT EXISTS `documento` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` enum('blanco','certificado') NOT NULL DEFAULT 'blanco',
  `nombre` varchar(128) NOT NULL,
  `contenido` text NOT NULL,
  `servicio` varchar(128) NOT NULL,
  `servicio_url` varchar(256) NOT NULL,
  `logo` varchar(256) NOT NULL,
  `timbre` varchar(256) NOT NULL,
  `firmador_nombre` varchar(128) NOT NULL,
  `firmador_cargo` varchar(128) NOT NULL,
  `firmador_servicio` varchar(128) NOT NULL,
  `firmador_imagen` varchar(256) NOT NULL,
  `validez` int(10) unsigned DEFAULT NULL,
  `hsm_configuracion_id` int(10) unsigned DEFAULT NULL,
  `proceso_id` int(10) unsigned NOT NULL,
  `subtitulo` varchar(128) NOT NULL,
  `titulo` varchar(128) NOT NULL,
  `validez_habiles` tinyint(1) NOT NULL,
  `tamano` enum('letter','legal') DEFAULT 'letter',
  PRIMARY KEY (`id`),
  KEY `fk_documento_proceso1_idx` (`proceso_id`),
  KEY `fk_documento_hsm_configuracion1_idx` (`hsm_configuracion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etapa`
--

CREATE TABLE IF NOT EXISTS `etapa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tarea_id` int(10) unsigned NOT NULL,
  `usuario_id` int(10) unsigned DEFAULT NULL,
  `pendiente` tinyint(1) NOT NULL,
  `etapa_ancestro_split_id` int(10) unsigned DEFAULT NULL,
  `vencimiento_at` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `ended_at` datetime DEFAULT NULL,
  `tramite_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_etapa_tarea1_idx` (`tarea_id`),
  KEY `fk_etapa_usuario1_idx` (`usuario_id`),
  KEY `fk_etapa_tramite1` (`tramite_id`),
  KEY `fk_etapa_etapa1_idx` (`etapa_ancestro_split_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=204 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE IF NOT EXISTS `evento` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `regla` varchar(512) NOT NULL,
  `instante` enum('antes','despues') NOT NULL,
  `tarea_id` int(10) unsigned NOT NULL,
  `accion_id` int(10) unsigned NOT NULL,
  `paso_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_evento_tarea1_idx` (`tarea_id`),
  KEY `fk_evento_accion1_idx` (`accion_id`),
  KEY `fk_evento_paso1_idx` (`paso_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `feriado`
--

CREATE TABLE IF NOT EXISTS `feriado` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fecha_UNIQUE` (`fecha`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `tipo` enum('dato','documento') NOT NULL,
  `llave` varchar(12) NOT NULL,
  `llave_copia` varchar(40) DEFAULT NULL,
  `llave_firma` varchar(12) DEFAULT NULL,
  `validez` int(10) unsigned DEFAULT NULL,
  `tramite_id` int(10) unsigned NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `validez_habiles` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `filename_tipo` (`filename`,`tipo`),
  KEY `fk_file_tramite1_idx` (`tramite_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=72 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulario`
--

CREATE TABLE IF NOT EXISTS `formulario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) NOT NULL,
  `proceso_id` int(10) unsigned NOT NULL,
  `bloque_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_formulario_proceso1_idx` (`proceso_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=292 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_usuarios`
--

CREATE TABLE IF NOT EXISTS `grupo_usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) NOT NULL,
  `cuenta_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `grupo_usuarios_UNIQUE` (`cuenta_id`,`nombre`),
  KEY `fk_grupo_usuarios_cuenta1_idx` (`cuenta_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_usuarios_has_usuario`
--

CREATE TABLE IF NOT EXISTS `grupo_usuarios_has_usuario` (
  `grupo_usuarios_id` int(10) unsigned NOT NULL,
  `usuario_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`grupo_usuarios_id`,`usuario_id`),
  KEY `fk_grupo_usuarios_has_usuario_usuario1_idx` (`usuario_id`),
  KEY `fk_grupo_usuarios_has_usuario_grupo_usuarios1_idx` (`grupo_usuarios_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hsm_configuracion`
--

CREATE TABLE IF NOT EXISTS `hsm_configuracion` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) NOT NULL,
  `cuenta_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`),
  KEY `fk_hsm_configuracion_cuenta1_idx` (`cuenta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration_version`
--

CREATE TABLE IF NOT EXISTS `migration_version` (
  `version` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------



-- --------------------------------------------------------



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paso`
--

CREATE TABLE IF NOT EXISTS `paso` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orden` int(10) unsigned NOT NULL,
  `modo` enum('edicion','visualizacion') NOT NULL,
  `regla` varchar(512) NOT NULL,
  `formulario_id` int(10) unsigned NOT NULL,
  `tarea_id` int(10) unsigned NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_paso_formulario1_idx` (`formulario_id`),
  KEY `fk_paso_tarea1_idx` (`tarea_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proceso`
--

CREATE TABLE IF NOT EXISTS `proceso` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) NOT NULL,
  `width` varchar(8) NOT NULL DEFAULT '100%',
  `height` varchar(8) NOT NULL DEFAULT '800px',
  `cuenta_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_proceso_cuenta1_idx` (`cuenta_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=74 ;

-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte`
--

CREATE TABLE IF NOT EXISTS `reporte` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) NOT NULL,
  `campos` text NOT NULL,
  `proceso_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reporte_proceso1_idx` (`proceso_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea`
--

CREATE TABLE IF NOT EXISTS `tarea` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `identificador` varchar(32) NOT NULL,
  `inicial` tinyint(1) NOT NULL DEFAULT '0',
  `nombre` varchar(128) NOT NULL,
  `posx` int(10) unsigned NOT NULL DEFAULT '0',
  `posy` int(10) unsigned NOT NULL DEFAULT '0',
  `asignacion` enum('ciclica','manual','autoservicio','usuario') NOT NULL DEFAULT 'ciclica',
  `asignacion_usuario` varchar(128) DEFAULT NULL,
  `asignacion_notificar` tinyint(1) NOT NULL DEFAULT '0',
  `proceso_id` int(10) unsigned NOT NULL,
  `almacenar_usuario` tinyint(1) NOT NULL DEFAULT '0',
  `almacenar_usuario_variable` varchar(128) DEFAULT NULL,
  `acceso_modo` enum('grupos_usuarios','publico','registrados','claveunica') NOT NULL DEFAULT 'grupos_usuarios',
  `activacion` enum('si','entre_fechas','no') NOT NULL DEFAULT 'si',
  `activacion_inicio` date DEFAULT NULL,
  `activacion_fin` date DEFAULT NULL,
  `vencimiento` tinyint(1) NOT NULL DEFAULT '0',
  `vencimiento_valor` int(10) unsigned NOT NULL DEFAULT '5',
  `vencimiento_unidad` enum('D','W','M') NOT NULL DEFAULT 'D',
  `vencimiento_habiles` tinyint(1) NOT NULL DEFAULT '0',
  `vencimiento_notificar` tinyint(1) NOT NULL DEFAULT '0',
  `vencimiento_notificar_email` varchar(255) NOT NULL,
  `vencimiento_notificar_dias` int(10) unsigned NOT NULL DEFAULT '1',
  `grupos_usuarios` text,
  `paso_confirmacion` tinyint(1) NOT NULL DEFAULT '1',
  `previsualizacion` text NOT NULL,
  `trazabilidad` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `identificador_proceso` (`identificador`,`proceso_id`),
  KEY `fk_tarea_proceso1` (`proceso_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea_has_grupo_usuarios`
--

CREATE TABLE IF NOT EXISTS `tarea_has_grupo_usuarios` (
  `tarea_id` int(10) unsigned NOT NULL,
  `grupo_usuarios_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`tarea_id`,`grupo_usuarios_id`),
  KEY `fk_tarea_has_grupo_usuarios_grupo_usuarios1_idx` (`grupo_usuarios_id`),
  KEY `fk_tarea_has_grupo_usuarios_tarea1_idx` (`tarea_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tramite`
--

CREATE TABLE IF NOT EXISTS `tramite` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `proceso_id` int(10) unsigned NOT NULL,
  `pendiente` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `ended_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tramite_proceso1_idx` (`proceso_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=139 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(128) NOT NULL,
  `password` varchar(256) DEFAULT NULL,
  `rut` varchar(16) DEFAULT NULL,
  `nombres` varchar(128) DEFAULT NULL,
  `apellido_paterno` varchar(128) DEFAULT NULL,
  `apellido_materno` varchar(128) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `registrado` tinyint(1) NOT NULL DEFAULT '1',
  `vacaciones` tinyint(1) NOT NULL DEFAULT '0',
  `cuenta_id` int(10) unsigned DEFAULT NULL,
  `salt` varchar(32) NOT NULL,
  `open_id` tinyint(1) NOT NULL DEFAULT '0',
  `reset_token` varchar(40) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario_unique` (`usuario`,`open_id`),
  KEY `fk_usuario_cuenta1_idx` (`cuenta_id`),
  KEY `email_idx` (`email`,`open_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=136 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_backend`
--

CREATE TABLE IF NOT EXISTS `usuario_backend` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `apellidos` varchar(128) NOT NULL,
  `rol` enum('super','modelamiento','operacion','seguimiento','gestion','desarrollo','configuracion') DEFAULT NULL,
  `salt` varchar(32) NOT NULL,
  `cuenta_id` int(10) unsigned NOT NULL,
  `reset_token` varchar(40) DEFAULT NULL,
  `usuario` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_backend_cuenta1_idx` (`cuenta_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_manager`
--

CREATE TABLE IF NOT EXISTS `usuario_manager` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(128) NOT NULL,
  `user` varchar(128) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `apellidos` varchar(128) NOT NULL,
  `salt` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `widget`
--

CREATE TABLE IF NOT EXISTS `widget` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(32) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `posicion` int(10) unsigned NOT NULL,
  `config` text,
  `cuenta_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_widget_cuenta1_idx` (`cuenta_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------


-- --------------------------------------------------------


-- --------------------------------------------------------


--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `accion`
--
ALTER TABLE `accion`
  ADD CONSTRAINT `fk_trigger_proceso1` FOREIGN KEY (`proceso_id`) REFERENCES `proceso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `campo`
--
ALTER TABLE `campo`
  ADD CONSTRAINT `campo_ibfk_1` FOREIGN KEY (`formulario_id`) REFERENCES `formulario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_campo_documento1` FOREIGN KEY (`documento_id`) REFERENCES `documento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `conexion`
--
ALTER TABLE `conexion`
  ADD CONSTRAINT `conexion_ibfk_1` FOREIGN KEY (`tarea_id_origen`) REFERENCES `tarea` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `conexion_ibfk_2` FOREIGN KEY (`tarea_id_destino`) REFERENCES `tarea` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `dato_seguimiento`
--
ALTER TABLE `dato_seguimiento`
  ADD CONSTRAINT `fk_dato_seguimiento_etapa1` FOREIGN KEY (`etapa_id`) REFERENCES `etapa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `fk_documento_hsm_configuracion1` FOREIGN KEY (`hsm_configuracion_id`) REFERENCES `hsm_configuracion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_documento_proceso1` FOREIGN KEY (`proceso_id`) REFERENCES `proceso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `etapa`
--
ALTER TABLE `etapa`
  ADD CONSTRAINT `etapa_ibfk_1` FOREIGN KEY (`tramite_id`) REFERENCES `tramite` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_etapa_etapa1` FOREIGN KEY (`etapa_ancestro_split_id`) REFERENCES `etapa` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_etapa_tarea1` FOREIGN KEY (`tarea_id`) REFERENCES `tarea` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_etapa_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `fk_evento_accion1` FOREIGN KEY (`accion_id`) REFERENCES `accion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_evento_paso1` FOREIGN KEY (`paso_id`) REFERENCES `paso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_evento_tarea1` FOREIGN KEY (`tarea_id`) REFERENCES `tarea` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `fk_file_tramite1` FOREIGN KEY (`tramite_id`) REFERENCES `tramite` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `formulario`
--
ALTER TABLE `formulario`
  ADD CONSTRAINT `fk_formulario_proceso1` FOREIGN KEY (`proceso_id`) REFERENCES `proceso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `grupo_usuarios`
--
ALTER TABLE `grupo_usuarios`
  ADD CONSTRAINT `fk_grupo_usuarios_cuenta1` FOREIGN KEY (`cuenta_id`) REFERENCES `cuenta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `grupo_usuarios_has_usuario`
--
ALTER TABLE `grupo_usuarios_has_usuario`
  ADD CONSTRAINT `fk_grupo_usuarios_has_usuario_grupo_usuarios1` FOREIGN KEY (`grupo_usuarios_id`) REFERENCES `grupo_usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_grupo_usuarios_has_usuario_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `hsm_configuracion`
--
ALTER TABLE `hsm_configuracion`
  ADD CONSTRAINT `fk_hsm_configuracion_cuenta1` FOREIGN KEY (`cuenta_id`) REFERENCES `cuenta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `paso`
--
ALTER TABLE `paso`
  ADD CONSTRAINT `fk_paso_formulario1` FOREIGN KEY (`formulario_id`) REFERENCES `formulario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_paso_tarea1` FOREIGN KEY (`tarea_id`) REFERENCES `tarea` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proceso`
--
ALTER TABLE `proceso`
  ADD CONSTRAINT `fk_proceso_cuenta1` FOREIGN KEY (`cuenta_id`) REFERENCES `cuenta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD CONSTRAINT `fk_reporte_proceso1` FOREIGN KEY (`proceso_id`) REFERENCES `proceso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD CONSTRAINT `tarea_ibfk_1` FOREIGN KEY (`proceso_id`) REFERENCES `proceso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tarea_has_grupo_usuarios`
--
ALTER TABLE `tarea_has_grupo_usuarios`
  ADD CONSTRAINT `fk_tarea_has_grupo_usuarios_grupo_usuarios1` FOREIGN KEY (`grupo_usuarios_id`) REFERENCES `grupo_usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tarea_has_grupo_usuarios_tarea1` FOREIGN KEY (`tarea_id`) REFERENCES `tarea` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tramite`
--
ALTER TABLE `tramite`
  ADD CONSTRAINT `fk_tramite_proceso1` FOREIGN KEY (`proceso_id`) REFERENCES `proceso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_cuenta1` FOREIGN KEY (`cuenta_id`) REFERENCES `cuenta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_backend`
--
ALTER TABLE `usuario_backend`
  ADD CONSTRAINT `fk_usuario_backend_cuenta1` FOREIGN KEY (`cuenta_id`) REFERENCES `cuenta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `widget`
--
ALTER TABLE `widget`
  ADD CONSTRAINT `fk_widget_cuenta1` FOREIGN KEY (`cuenta_id`) REFERENCES `cuenta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


INSERT INTO `proceso` (`id`, `nombre`, `width`, `height`, `cuenta_id`) VALUES
(8851, 'BLOQUE', '100%', '800px', 1),
(8852, 'BLOQUE', '100%', '800px', 1),
(8853, 'BLOQUE', '100%', '800px', 1),
(8854, 'BLOQUE', '100%', '800px', 1),
(8855, 'BLOQUE', '100%', '800px', 1);

INSERT INTO `formulario` (`id`, `nombre`, `proceso_id`, `bloque_id`) VALUES
(88245, 'Formulario', 8851, 8836),
(88246, 'Formulario', 8852, 8837),
(88247, 'Formulario', 8853, 8838),
(88248, 'Formulario', 8854, 8839),
(88249, 'Formulario', 8855, 8840);

INSERT INTO `bloque` (`id`, `nombre`) VALUES
(8839, 'Identificación UY'),
(8836, 'DatosDeContacto'),
(8837, 'Domicilio'),
(8838, 'Identificación extranjeros'),
(8840, 'Personas jurídicas');

INSERT INTO `campo` (`id`, `nombre`, `readonly`, `valor_default`, `posicion`, `tipo`, `formulario_id`, `etiqueta`, `validacion`, `ayuda`, `dependiente_tipo`, `dependiente_campo`, `dependiente_valor`, `datos`, `documento_id`, `fieldset`, `extra`, `dependiente_relacion`) VALUES
(88798, 'datos_de_contacto', 0, '', 1, 'fieldset', 88245, 'Datos de contacto', '', '', 'string', '', '', NULL, NULL, '', NULL, '=='),
(88799, 'telefono', 0, '', 2, 'text', 88245, 'Teléfono', 'required|numeric|', '', 'string', '', '', NULL, NULL, 'datos_de_contacto', NULL, '=='),
(88800, 'otro_telefono', 0, '', 3, 'text', 88245, 'Otro teléfono', 'required|numeric|', '', 'string', '', '', NULL, NULL, 'datos_de_contacto', NULL, '=='),
(88801, 'correo_electronico', 0, '', 4, 'text', 88245, 'Correo electrónico', 'required|valid_email|', '', 'string', '', '', NULL, NULL, 'datos_de_contacto', NULL, '=='),
(88802, 'domicilio', 0, '', 0, 'fieldset', 88246, 'Domicilio', '', '', 'string', '', '', NULL, NULL, '', NULL, '=='),
(88803, 'departamento', 0, '', 1, 'select', 88246, 'Departamento', 'required', '', 'string', '', '', '[{"etiqueta":"Artigas","valor":"artigas"},{"etiqueta":"Canelones","valor":"canelones"},{"etiqueta":"Cerro Largo","valor":"cerro_largo"},{"etiqueta":"Colonia","valor":"colonia"},{"etiqueta":"Durazno","valor":"durazno"},{"etiqueta":"Flores","valor":"flores"},{"etiqueta":"Florida","valor":"florida"},{"etiqueta":"Lavalleja","valor":"lavalleja"},{"etiqueta":"Maldonado","valor":"maldonado"},{"etiqueta":"Montevideo","valor":"montevideo"},{"etiqueta":"Paysand\\u00fa","valor":"paysandu"},{"etiqueta":"Rio Negro","valor":"rio_negro"},{"etiqueta":"Rivera","valor":"rivera"},{"etiqueta":"Rocha","valor":"rocha"},{"etiqueta":"Salto","valor":"salto"},{"etiqueta":"San Jos\\u00e9","valor":"san_jose"},{"etiqueta":"Soriano","valor":"soriano"},{"etiqueta":"Tacuaremb\\u00f3","valor":"tacuarembo"},{"etiqueta":"Treinta y Tres","valor":"treinta_y_tres"}]', NULL, 'domicilio', NULL, '=='),
(88804, 'localidad', 0, '', 2, 'text', 88246, 'Localidad', 'required', '', 'string', '', '', NULL, NULL, 'domicilio', NULL, '=='),
(88805, 'calle', 0, '', 3, 'text', 88246, 'Calle', 'required', '', 'string', '', '', NULL, NULL, 'domicilio', NULL, '=='),
(88806, 'numero', 0, '', 4, 'text', 88246, 'Número', 'required', '', 'string', '', '', NULL, NULL, 'domicilio', NULL, '=='),
(88807, 'otros_datos', 0, '', 5, 'text', 88246, 'Otros datos', '', '', 'string', '', '', NULL, NULL, 'domicilio', NULL, '=='),
(88809, 'datos_personales', 0, '', 1, 'fieldset', 88247, 'Datos personales', '', '', 'string', '', '', NULL, NULL, '', NULL, '=='),
(88810, 'tipo_de_documento', 0, '', 2, 'select', 88247, 'Documento de identidad', 'required', '', 'string', '', '', '[{"etiqueta":"C.I.","valor":"ci"},{"etiqueta":"Pasaporte","valor":"pasaporte"}]', NULL, 'datos_personales', NULL, '=='),
(88811, 'numero_de_documento', 0, '', 3, 'text', 88247, 'Número de documento (incluir dígito verificador)', 'required', '', 'string', '', '', NULL, NULL, 'datos_personales', NULL, '=='),
(88812, 'pais', 0, '', 4, 'paises', 88247, 'País emisor', 'required', '', 'string', '', '', NULL, NULL, 'datos_personales', NULL, '=='),
(88813, 'apellidos', 0, '', 5, 'text', 88247, 'Apellidos', 'required', '', 'string', '', '', NULL, NULL, 'datos_personales', NULL, '=='),
(88814, 'nombres', 0, '', 6, 'text', 88247, 'Nombres', 'required', '', 'string', '', '', NULL, NULL, 'datos_personales', NULL, '=='),
(88815, 'datos_personales', 0, '', 1, 'fieldset', 88248, 'Datos personales', '', '', 'string', '', '', NULL, NULL, '', NULL, '=='),
(88816, 'tipo_de_documento', 0, '', 2, 'select', 88248, 'Documento de identidad', 'required', '', 'string', '', '', '[{"etiqueta":"C.I.","valor":"ci"},{"etiqueta":"Pasaporte","valor":"pasaporte"}]', NULL, 'datos_personales', NULL, '=='),
(88817, 'numero_de_documento', 0, '', 3, 'text', 88248, 'Número de documento (incluir dígito verificador)', 'required', '', 'string', '', '', NULL, NULL, 'datos_personales', NULL, '=='),
(88818, 'apellidos', 0, '', 4, 'text', 88248, 'Apellidos', 'required', '', 'string', '', '', NULL, NULL, 'datos_personales', NULL, '=='),
(88819, 'nombres', 0, '', 5, 'text', 88248, 'Nombres', 'required', '', 'string', '', '', NULL, NULL, 'datos_personales', NULL, '=='),
(88820, 'empresa', 0, '', 0, 'fieldset', 88249, 'Empresa', '', '', 'string', '', '', NULL, NULL, '', NULL, '=='),
(88821, 'rut', 0, '', 1, 'text', 88249, 'RUT', 'required|numeric', '', 'string', '', '', NULL, NULL, 'empresa', NULL, '=='),
(88822, 'razon_social', 0, '', 2, 'text', 88249, 'Razón social', 'required', '', 'string', '', '', NULL, NULL, 'empresa', NULL, '=='),
(88823, 'rol', 0, '', 3, 'text', 88249, 'Rol', 'required', '', 'string', '', '', NULL, NULL, 'empresa', NULL, '=='),
(88824, 'validacion', 0, '', 4, 'radio', 88249, 'Validación', 'required', '', 'string', '', '', '[{"etiqueta":"Verificar en registro de DGI\\/DGREC","valor":"verificar_en_registro_de_dgidgrec"},{"etiqueta":"Presentar documentaci\\u00f3n en oficinas del organismo o PAC","valor":"presentar_documentacion_en_oficinas_del_organismo_o_pac"},{"etiqueta":"Adjuntar certificado notarial electr\\u00f3nico (PDF max 45KB)","valor":"adjuntar_certificado_notarial_electronico_pdf_max_45kb"}]', NULL, 'empresa', NULL, '=='),
(88825, 'certificado', 0, '', 5, 'file', 88249, 'Certificado', '', '', 'string', '', '', NULL, NULL, 'empresa', '{"filetypes":["pdf"]}', '=='),
(88826, '56ead35f64d18', 1, '', 6, 'javascript', 88249, '$(document).ready(function(){ \r\n  $(''input[name="certificado"]'').parent().hide();\r\n  $(''span:contains("Certificado (Opcional)")'').hide();\r\n\r\n  setTimeout(function() {\r\n    $(''input:radio'').change(function() {\r\n      if($(''#adjuntar_certificado_notarial_electronico_pdf_max_45kb'').is('':checked'')) {\r\n        $(''input[name="certificado"]'').parent().show();\r\n        $(''span:contains("Certificado (Opcional)")'').show();\r\n      }\r\n      else {\r\n        $(''input[name="certificado"]'').parent().hide();\r\n        $(''span:contains("Certificado (Opcional)")'').hide();\r\n      }\r\n    });\r\n  }, 400);\r\n});', '', '', 'string', '', '', NULL, NULL, NULL, '==', '');


/* Clausula de consentimiento informado */
INSERT INTO `bloque` (`nombre`,`id`) VALUES ('Clausula de consentimiento informado', NULL);
SET @bloque_id_1 = LAST_INSERT_ID();

INSERT INTO `proceso` (`id`,`nombre`,`width`,`height`,`cuenta_id`) VALUES (NULL, 'BLOQUE', '100%', '800px', 1);
SET @proceso_id_1 = LAST_INSERT_ID();

INSERT INTO `formulario` (`id`,`nombre`,`proceso_id`,`bloque_id`,`leyenda`,`contenedor`) VALUES (NULL, 'Formulario', @proceso_id_1, @bloque_id_1, NULL, 0);
SET @formulario_id_1 = LAST_INSERT_ID();

INSERT INTO `campo` (`id`,`nombre`,`readonly`,`valor_default`,`posicion`,`tipo`,`formulario_id`,`etiqueta`,`validacion`,`ayuda`,`dependiente_tipo`,`dependiente_campo`,`dependiente_valor`,`datos`,`documento_id`,`extra`,`dependiente_relacion`,`fieldset`) VALUES (NULL,'clausula_de_consentimiento_informado',0,'',1,'fieldset',@formulario_id_1,'Cláusula de consentimiento informado','','','string','','',NULL,NULL,NULL,'==','');
INSERT INTO `campo` (`id`,`nombre`,`readonly`,`valor_default`,`posicion`,`tipo`,`formulario_id`,`etiqueta`,`validacion`,`ayuda`,`dependiente_tipo`,`dependiente_campo`,`dependiente_valor`,`datos`,`documento_id`,`extra`,`dependiente_relacion`,`fieldset`) VALUES (NULL,'57a8c159bd71e',1,'',2,'paragraph',@formulario_id_1,'<p>\"De conformidad con la Ley N° 18.331, de 11 de agosto de 2008, de Protección de Datos Personales y Acción de Habeas Data (LPDP), los datos suministrados por usted quedarán incorporados en una base de datos, la cual será procesada exclusivamente para la siguiente finalidad: **Objetivo del formulario**.</p>\r\n\r\n<p>Los datos personales serán tratados con el grado de protección adecuado, tomándose las medidas de seguridad necesarias para evitar su alteración, pérdida, tratamiento o acceso no autorizado por parte de terceros que lo puedan utilizar para finalidades distintas para las que han sido solicitadas al usuario.</p>\r\n\r\n<p>El responsable de la base de datos es **Titular de la base** y la dirección donde podrá ejercer los derechos de acceso, rectificación, actualización, inclusión o supresión, es **Dirección del organismo**, según lo establecido en la LPDP\".</p>\r\n<br />','','','string','','',NULL,NULL,NULL,'==','clausula_de_consentimiento_informado');
INSERT INTO `campo` (`id`,`nombre`,`readonly`,`valor_default`,`posicion`,`tipo`,`formulario_id`,`etiqueta`,`validacion`,`ayuda`,`dependiente_tipo`,`dependiente_campo`,`dependiente_valor`,`datos`,`documento_id`,`extra`,`dependiente_relacion`,`fieldset`) VALUES (NULL,'terminos_de_la_clausula',0,'',3,'radio',@formulario_id_1,'Términos de la cláusula','required','','string','','','[{\"etiqueta\":\"Acepto los t\\u00e9rminos\",\"valor\":\"acepto\"},{\"etiqueta\":\"No acepto los t\\u00e9rminos. (No se enviar\\u00e1 el mensaje)\",\"valor\":\"\"}]',NULL,NULL,'==','clausula_de_consentimiento_informado');

/* Valoracion */
INSERT INTO `bloque` (`nombre`,`id`) VALUES ('Valoracion', NULL);
SET @bloque_id_2 = LAST_INSERT_ID();

INSERT INTO `proceso` (`id`,`nombre`,`width`,`height`,`cuenta_id`) VALUES (NULL,'BLOQUE','100%','800px',1);
SET @proceso_id_2 = LAST_INSERT_ID();

INSERT INTO `formulario` (`id`,`nombre`,`proceso_id`,`bloque_id`,`leyenda`,`contenedor`) VALUES (NULL,'Formulario',@proceso_id_2, @bloque_id_2,NULL,0);
SET @formulario_id_2 = LAST_INSERT_ID();

INSERT INTO `campo` (`id`,`nombre`,`readonly`,`valor_default`,`posicion`,`tipo`,`formulario_id`,`etiqueta`,`validacion`,`ayuda`,`dependiente_tipo`,`dependiente_campo`,`dependiente_valor`,`datos`,`documento_id`,`extra`,`dependiente_relacion`,`fieldset`) VALUES (NULL,'ayudanos_a_mejorar',0,'',0,'fieldset',@formulario_id_2,'Ayúdanos a mejorar','','','string','','',NULL,NULL,NULL,'==','valoracion.');
INSERT INTO `campo` (`id`,`nombre`,`readonly`,`valor_default`,`posicion`,`tipo`,`formulario_id`,`etiqueta`,`validacion`,`ayuda`,`dependiente_tipo`,`dependiente_campo`,`dependiente_valor`,`datos`,`documento_id`,`extra`,`dependiente_relacion`,`fieldset`) VALUES (NULL,'valoracion',0,'',2,'radio',@formulario_id_2,'¿Cómo calificarías esta gestión?','required','','string','','','[{\"etiqueta\":\"Excelente\",\"valor\":\"5\"},{\"etiqueta\":\"Muy Buena\",\"valor\":\"4\"},{\"etiqueta\":\"Buena\",\"valor\":\"3\"},{\"etiqueta\":\"Regular\",\"valor\":\"2\"},{\"etiqueta\":\"Mala\",\"valor\":\"1\"}]',NULL,NULL,'==','ayudanos_a_mejorar');
INSERT INTO `campo` (`id`,`nombre`,`readonly`,`valor_default`,`posicion`,`tipo`,`formulario_id`,`etiqueta`,`validacion`,`ayuda`,`dependiente_tipo`,`dependiente_campo`,`dependiente_valor`,`datos`,`documento_id`,`extra`,`dependiente_relacion`,`fieldset`) VALUES (NULL,'comentarios',0,'',3,'textarea',@formulario_id_2,'Comentarios','required','','string','','',NULL,NULL,NULL,'==','ayudanos_a_mejorar');
