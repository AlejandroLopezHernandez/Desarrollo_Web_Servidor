CREATE DATABASE IF NOT EXISTS emergencia; 
-- Usar la base de datos 
USE emergencia; 
 
-- Crear la tabla estado_municipios 
CREATE TABLE IF NOT EXISTS estado_municipios ( 
    id INT AUTO_INCREMENT PRIMARY KEY, 
    nombre_poblacion VARCHAR(100) NOT NULL, 
    personas_afectadas INT NOT NULL, 
    comunicaciones_cortadas INT NOT NULL, 
    agua TINYINT(1) NOT NULL DEFAULT 0, 
    productos_limpieza TINYINT(1) NOT NULL DEFAULT 0, 
    viveres TINYINT(1) NOT NULL DEFAULT 0, 
    medicinas TINYINT(1) NOT NULL DEFAULT 0,
    otros VARCHAR(255), 
    fecha_reporte DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    UNIQUE KEY (nombre_poblacion) 
);