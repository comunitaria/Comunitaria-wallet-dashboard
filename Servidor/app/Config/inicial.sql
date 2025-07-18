DROP TABLE IF EXISTS `alarmas`;
CREATE TABLE `alarmas` (
  `ID` int(11) NOT NULL,
  `objeto` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `clase` int(11) NOT NULL DEFAULT 0 COMMENT '1:no localizado, 2:mal ubicado',
  `mensaje` text COLLATE latin1_spanish_ci NOT NULL,
  `aceptada` tinyint(4) NOT NULL DEFAULT 0,
  `anulada` tinyint(4) NOT NULL DEFAULT 0,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `anuladoPor` int(11) NOT NULL,
  `comentario` varchar(500) COLLATE latin1_spanish_ci NOT NULL,
  `fechaAnulado` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pendiente` tinyint(1) NOT NULL DEFAULT 0,
  `transBC` varchar(100) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `transBCAnulado` varchar(100) COLLATE latin1_spanish_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
ALTER TABLE `alarmas`
  ADD PRIMARY KEY (`ID`);
ALTER TABLE `alarmas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

DROP TABLE IF EXISTS `BCNODOS`;
CREATE TABLE `BCNODOS` (
  `DOMINIO` varchar(15) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `NOMBRE` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `ID` int(5) NOT NULL,
  `IP` varchar(12) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `PUERTO` int(5) NOT NULL,
  `VERSION` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `DESCRIPCION` varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `BLOCKCHAIN` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `CONEXION` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `CONECTADO` tinyint(1) NOT NULL,
  `B_ACTUAL` int(15) NOT NULL DEFAULT 0,
  `B_FINAL` int(15) NOT NULL DEFAULT 0,
  `FECHA` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
ALTER TABLE `BCNODOS`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `iFecha` (`FECHA`);

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `ID` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `icono` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `color` char(15) COLLATE latin1_spanish_ci NOT NULL,
  `propiedad3` varchar(100) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`ID`);
ALTER TABLE `categorias`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

DROP TABLE IF EXISTS `clases`;
CREATE TABLE `clases` (
  `ID` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `categoria` int(11) DEFAULT 0,
  `icono` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `color` char(15) COLLATE latin1_spanish_ci NOT NULL,
  `revisable` tinyint(1) NOT NULL DEFAULT 0,
  `propiedades` varchar(10000) COLLATE latin1_spanish_ci NOT NULL,
  `revisiones` varchar(10000) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
ALTER TABLE `clases`
  ADD PRIMARY KEY (`ID`);
ALTER TABLE `clases`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

DROP TABLE IF EXISTS `clase_alarma`;
CREATE TABLE `clase_alarma` (
  `codigo` int(11) NOT NULL,
  `origen` varchar(50) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
ALTER TABLE `clase_alarma`
  ADD PRIMARY KEY (`codigo`);

DROP TABLE IF EXISTS `debug`;
CREATE TABLE `debug` (
  `ID` int(11) NOT NULL,
  `hora` datetime NOT NULL DEFAULT current_timestamp(),
  `texto` varchar(20000) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
ALTER TABLE `debug`
  ADD PRIMARY KEY (`ID`);
ALTER TABLE `debug`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

DROP TABLE IF EXISTS `historico_objetos`;
CREATE TABLE `historico_objetos` (
  `ID` int(11) NOT NULL,
  `codigo` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `clase` int(11) NOT NULL,
  `unidad` text COLLATE latin1_spanish_ci NOT NULL,
  `plano` int(11) NOT NULL DEFAULT 0,
  `posicion` point NOT NULL,
  `GPS` point NOT NULL,
  `beacon` char(20) COLLATE latin1_spanish_ci NOT NULL,
  `NFC` char(20) COLLATE latin1_spanish_ci NOT NULL,
  `QR` varchar(100) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `link` varchar(500) COLLATE latin1_spanish_ci NOT NULL,
  `propiedades` varchar(10000) COLLATE latin1_spanish_ci NOT NULL,
  `detectadoEn` text COLLATE latin1_spanish_ci NOT NULL,
  `detectado` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `creado` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pendiente` tinyint(1) NOT NULL DEFAULT 0,
  `transBC` varchar(200) COLLATE latin1_spanish_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
ALTER TABLE `historico_objetos`
  ADD PRIMARY KEY (`ID`);
ALTER TABLE `historico_objetos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

DROP TABLE IF EXISTS `lecturas`;
CREATE TABLE `lecturas` (
  `tag_lec` binary(7) NOT NULL,
  `fechahora_lec` timestamp NOT NULL DEFAULT current_timestamp(),
  `longitud_lec` decimal(15,10) NOT NULL,
  `latitud_lec` decimal(15,10) NOT NULL,
  `autentico` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

DROP TABLE IF EXISTS `objetos`;
CREATE TABLE `objetos` (
  `codigo` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `clase` int(11) NOT NULL,
  `unidad` text COLLATE latin1_spanish_ci NOT NULL,
  `plano` int(11) NOT NULL DEFAULT 0,
  `posicion` point NOT NULL,
  `GPS` point NOT NULL,
  `beacon` char(20) COLLATE latin1_spanish_ci NOT NULL,
  `NFC` char(20) COLLATE latin1_spanish_ci NOT NULL,
  `QR` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `link` varchar(500) COLLATE latin1_spanish_ci NOT NULL,
  `propiedades` varchar(10000) COLLATE latin1_spanish_ci NOT NULL,
  `detectadoEn` text COLLATE latin1_spanish_ci NOT NULL,
  `detectado` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `creado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
ALTER TABLE `objetos`
  ADD PRIMARY KEY (`codigo`);

DROP TABLE IF EXISTS `parametros`;
CREATE TABLE `parametros` (
  `id_par` varchar(20) NOT NULL,
  `descripcion_par` varchar(100) NOT NULL,
  `valor_par` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
ALTER TABLE `parametros`
  ADD UNIQUE KEY `iParametros` (`id_par`);

DROP TABLE IF EXISTS `revisiones`;
CREATE TABLE `revisiones` (
  `ID` int(11) NOT NULL,
  `objeto` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `visto` tinyint(4) NOT NULL,
  `revision` varchar(1000) COLLATE latin1_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `ultima` tinyint(1) NOT NULL DEFAULT 0,
  `pendiente` tinyint(1) NOT NULL DEFAULT 0,
  `transBC` varchar(100) COLLATE latin1_spanish_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
ALTER TABLE `revisiones`
  ADD PRIMARY KEY (`ID`);
ALTER TABLE `revisiones`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`);

DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id_tag` binary(7) NOT NULL,
  `ref_art` varchar(300) NOT NULL,
  `epc_art` varchar(200) NOT NULL DEFAULT '',
  `BC` tinyint(1) NOT NULL DEFAULT 1,
  `pendiente` tinyint(1) NOT NULL DEFAULT 1,
  `transBC` char(200) NOT NULL DEFAULT ''''''
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Relación de tags con EPCs';

DROP TABLE IF EXISTS `temporizadores`;
CREATE TABLE `temporizadores` (
  `ID` int(11) NOT NULL,
  `objeto` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `clase` int(11) NOT NULL DEFAULT 0,
  `alarma` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `mensaje` text COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
ALTER TABLE `temporizadores`
  ADD PRIMARY KEY (`ID`);
ALTER TABLE `temporizadores`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

DROP TABLE IF EXISTS `UBICACIONES`;
CREATE TABLE `UBICACIONES` (
  `IDUBICACION` int(4) NOT NULL,
  `NOMBRE` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `CODIGO` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `LOCALIZACION` point NOT NULL,
  `RECTANGULO` point NOT NULL,
  `PROPIEDAD1` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `PROPIEDAD2` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `PROPIEDAD3` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `PLANOS` varchar(1000) COLLATE latin1_spanish_ci NOT NULL,
  `PADRE` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
ALTER TABLE `UBICACIONES`
  ADD PRIMARY KEY (`IDUBICACION`);
ALTER TABLE `UBICACIONES`
  MODIFY `IDUBICACION` int(4) NOT NULL AUTO_INCREMENT;

DROP TABLE IF EXISTS `unidades`;
CREATE TABLE `unidades` (
  `ID` text CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `nombre` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `padre` int(4) NOT NULL,
  `plano` int(11) NOT NULL DEFAULT 0,
  `zona` varchar(1000) NOT NULL,
  `BC` tinyint(1) NOT NULL,
  `transBC` char(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `pendiente` tinyint(1) NOT NULL,
  `propiedad1` varchar(100) NOT NULL,
  `propiedad2` varchar(100) NOT NULL,
  `propiedad3` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
ALTER TABLE `unidades`
  ADD UNIQUE KEY `ID` (`ID`(11)),
  ADD KEY `indexBC` (`transBC`,`BC`) USING BTREE,
  ADD KEY `iBC` (`BC`,`pendiente`);

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_usr` int(10) UNSIGNED NOT NULL,
  `nombre_usr` varchar(100) DEFAULT NULL,
  `login_usr` varchar(30) DEFAULT NULL,
  `pwd_usr` varchar(100) DEFAULT NULL,
  `token` varchar(100),
  `hora_token` datetime,
  `unidad` int(11) NOT NULL DEFAULT 0 COMMENT 'Unidad por defecto para el usuario',
  `email_usr` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usr`),
  ADD KEY `iLogin` (`login_usr`),
  ADD KEY `iEmailUsuario` (`email_usr`);
ALTER TABLE `usuarios`
  MODIFY `id_usr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

DROP TABLE IF EXISTS `usrperfiles`;
CREATE TABLE `usrperfiles` (
  `id_usr` int(11) NOT NULL,
  `id_prf` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
ALTER TABLE `usrperfiles`
  ADD PRIMARY KEY (`id_usr`,`id_prf`);

DROP TABLE IF EXISTS `perfiles`;
CREATE TABLE `perfiles` (
  `id_prf` int(11) NOT NULL,
  `desc_prf` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id_prf`);
ALTER TABLE `perfiles`
  MODIFY `id_prf` int(11) NOT NULL AUTO_INCREMENT;

DROP TABLE IF EXISTS `perfilespermisos`;
CREATE TABLE `perfilespermisos` (
  `id_prf` int(11) NOT NULL,
  `id_per` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
ALTER TABLE `perfilespermisos`
  ADD PRIMARY KEY (`id_prf`,`id_per`);

DROP TABLE IF EXISTS `permisos`;
CREATE TABLE `permisos` (
  `id_per` int(11) NOT NULL,
  `desc_per` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_per`);
ALTER TABLE `permisos`
  MODIFY `id_per` int(11) NOT NULL AUTO_INCREMENT;


INSERT INTO usrperfiles (id_usr, id_prf) VALUES (1,1);
INSERT INTO grupos (id_grupo, desc_grupo, id_perfil) VALUES (1,"Superusuario",1);
INSERT INTO perfiles (id_prf, desc_prf) VALUES (1,"Superusuario");
INSERT INTO perfilespermisos (id_prf, id_per) VALUES (1,1);
INSERT INTO permisos (id_per, desc_per) VALUES (1,"Configuración del portal");
