-- Crear la base de datos si no existe 
CREATE DATABASE IF NOT EXISTS game_matrix; 
USE game_matrix; 
 
-- Crear la tabla `game` 
CREATE TABLE IF NOT EXISTS game ( 
    id_session INT AUTO_INCREMENT PRIMARY KEY, 
    score INT NOT NULL, 
    date_session DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP 
); 
 
-- Insertar algunos datos de ejemplo en la tabla `game` 
INSERT INTO game (score, date_session) VALUES 
(150, '2024-10-30 10:00:00'), 
(200, '2024-10-30 11:30:00'), 
(75, '2024-10-30 12:00:00'), 
(120, '2024-10-31 09:15:00'), 
(250, '2024-10-31 14:45:00'); 