CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    disponibilidad ENUM('Disponible', 'Agotado') NOT NULL,
    accion VARCHAR(50),
    ip_alta VARCHAR(15),
    fecha_alta TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip_ult_mod VARCHAR(15),
    fecha_ult_mod TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
INSERT INTO productos (id, nombre, descripcion, precio, disponibilidad, accion, ip_alta, fecha_alta, ip_ult_mod, fecha_ult_mod)
VALUES
(1, 'Producto 1', 'Breve descripción aquíasddasdasd', 10.00, 'Disponible', 'Comprar', NULL, '2024-12-10 18:44:00', '127.0.0.1', '2024-12-10 18:55:07'),
(3, 'Servicio 1', 'Breve descripción aquí', 50.00, 'Disponible', 'Contratar', NULL, '2024-12-10 18:44:00', NULL, '2024-12-10 18:44:00'),
(6, 'gel', 'sdjlklsak', 2323.00, 'Disponible', 'asdasdasdasdasdas', '127.0.0.1', '2024-12-10 18:45:02', NULL, '2024-12-10 18:45:02'),
(7, 'sdsad', 'asdasdasd', 12.00, 'Disponible', 'asdasdasdd', '127.0.0.1', '2024-12-10 18:55:28', NULL, '2024-12-10 18:55:28'),
(8, 'Producto 2', 'Otra descripción aquí', 20.00, 'Disponible', 'Comprar', '192.168.1.1', '2024-12-10 18:50:00', '192.168.1.1', '2024-12-10 18:55:00'),
(9, 'Servicio 2', 'Un servicio de prueba', 100.00, 'Agotado', 'Notificar', '127.0.0.1', '2024-12-10 18:46:00', '127.0.0.1', '2024-12-10 18:56:00');
