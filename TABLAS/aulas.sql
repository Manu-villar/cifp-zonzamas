CREATE TABLE aulas
(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY
    ,nombre VARCHAR(20)
    ,letra CHAR(01)
    ,numero INT
    ,planta INT
    ,ip_alta            VARCHAR(15)
    ,fecha_alta         TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ,ip_ult_mod         VARCHAR(15)
    ,fecha_ult_mod      TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);