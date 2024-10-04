
CREATE TABLE `espacios` (
  `cod_espacio` int(100) NOT NULL,
  `nom_espacio` varchar(255) NOT NULL,
  `estado_espacio` enum('Libre','Ocupado') NOT NULL,
  `placa` varchar(255) NOT NULL,
  `hora_llegada` varchar(255) NOT NULL,
  `hora_salida` varchar(255) NOT NULL,
  `fecha` varchar(255) NOT NULL,
  `cobro` float(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `espacios` (`cod_espacio`, `nom_espacio`, `estado_espacio`, `placa`, `hora_llegada`, `hora_salida`, `fecha`, `cobro`) VALUES
(1, 'Estacionamiento 1', 'Ocupado', 'asd1234', '18:00', '22:00', '2024-05-23', 8000);


CREATE TABLE `registro` (
  `id` int(11) NOT NULL,
  `placa` varchar(255) NOT NULL,
  `hora_llegada` time NOT NULL,
  `hora_salida` time NOT NULL,
  `espacio_ocupado` varchar(255) NOT NULL,
  `tarifa_pagada` float NOT NULL,
  `fecha` varchar(255) DEFAULT '00-00-0000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `registro` (`id`, `placa`, `hora_llegada`, `hora_salida`, `espacio_ocupado`, `tarifa_pagada`, `fecha`) VALUES
(1, 'asd1234', '11:15:24', '13:15:24', 'Espacio 1', 5000, '23-05-2024');


CREATE TABLE `turnos_empleados` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `hora_entrada` time NOT NULL,
  `fecha` date NOT NULL,
  `hora_salida` time NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `turnos_empleados` (`id`, `login`, `hora_entrada`, `fecha`, `hora_salida`) VALUES
(1, 'daniel97', '10:03:48', '2024-05-21', '18:03:00');


CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `contrasena` varchar(255) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `rol` enum('Administrador','Supervisor') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `usuarios` (`id`, `login`, `contrasena`, `nombre`, `rol`) VALUES
(1, 'admin', 'admin', 'Administrador', 'Administrador'),
(51, 'daniel97', '123456', 'Daniel Alejandro Peña Estrella', 'Supervisor');


ALTER TABLE `espacios`
  ADD PRIMARY KEY (`cod_espacio`);

ALTER TABLE `registro`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `turnos_empleados`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `nombre_usuario` (`login`);

ALTER TABLE `espacios`
  MODIFY `cod_espacio` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

ALTER TABLE `registro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `turnos_empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
