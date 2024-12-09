

CREATE TABLE foro(
     id                 INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
     nombre             VARCHAR(100) NOT NULL,
     mensaje            TEXT,
     ip_alta            VARCHAR(15),
     fecha_alta         TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
     ip_ult_mod         VARCHAR(15),
     fecha_ult_mod      TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO foro (nombre, mensaje, ip_alta, ip_ult_mod)
VALUES ('Juan Pérez', 'Este es mi primer mensaje en el foro.', '192.168.1.1', '192.168.1.1');

INSERT INTO foro (nombre, mensaje, ip_alta, ip_ult_mod)
VALUES ('Ana Gómez', '¡Hola a todos! Espero aprender mucho aquí.', '10.0.0.5', '10.0.0.5');

INSERT INTO foro (nombre, mensaje, ip_alta, ip_ult_mod)
VALUES ('Carlos Ruiz', '¿Alguien sabe cómo resolver este problema técnico?', '172.16.0.3', '172.16.0.3');

INSERT INTO foro (nombre, mensaje, ip_alta, ip_ult_mod)
VALUES ('Luisa Martínez', 'Gracias por los consejos en el tema anterior, fueron muy útiles.', '203.0.113.8', '203.0.113.8');


INSERT INTO foro (nombre, mensaje, ip_alta, ip_ult_mod)
VALUES ('Pedro Sánchez', '¿Qué opinan del nuevo diseño del foro?', '198.51.100.15', '198.51.100.15');
