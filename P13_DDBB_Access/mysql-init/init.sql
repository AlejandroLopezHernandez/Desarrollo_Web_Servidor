-- Crear base de datos INICIAL
CREATE DATABASE IF NOT EXISTS test_db;

-- Usar la base de datos
USE test_db;

-- Crear tabla
CREATE TABLE IF NOT EXISTS table_test (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    age INT NOT NULL
);

-- Insertar datos de ejemplo
INSERT INTO table_test (name, age) VALUES
('alumno1', 30),
('alumno2', 25),
('alumno3', 35);

-- Crear base de datos DEL JUEGO RPG
CREATE DATABASE IF NOT EXISTS rpg_game;


USE rpg_game;

-- Crear tabla characters
CREATE TABLE characters (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    level INT DEFAULT 1,
    experience INT DEFAULT 0,
    health INT DEFAULT 100
);

-- Insertar datos de ejemplo en la tabla characters (mitología griega)
INSERT INTO characters (name, level, experience, health) VALUES
('Ulises', 5, 500, 100),
('Penélope', 4, 300, 80),
('Telemaco', 3, 250, 70),
('Circe', 6, 400, 90),
('Calipso', 5, 350, 85),
('Atenea', 7, 600, 95);

-- Crear tabla quests
CREATE TABLE quests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    reward INT,
    is_completed BOOLEAN DEFAULT FALSE
);

-- Insertar datos de ejemplo en la tabla quests (mítología griega)
INSERT INTO quests (title, description, reward, is_completed) VALUES
('Viajar a Ítaca', 'Ulises debe regresar a su hogar en Ítaca tras la Guerra de Troya.', 500, FALSE),
('Enfrentar a Polifemo', 'Ulises debe escapar del cíclope Polifemo y liberar a sus hombres.', 400, TRUE),
('Superar las Sirenas', 'Ulises debe resistir el canto de las Sirenas para continuar su viaje.', 300, FALSE),
('Destruir a los pretendientes', 'Ulises debe recuperar su hogar y su esposa de los pretendientes.', 600, TRUE);

-- Crear tabla character_quests
CREATE TABLE character_quests (
    character_id INT,
    quest_id INT,
    FOREIGN KEY (character_id) REFERENCES characters(id),
    FOREIGN KEY (quest_id) REFERENCES quests(id),
    PRIMARY KEY (character_id, quest_id)
);

-- Insertar datos de ejemplo en la tabla character_quests
INSERT INTO character_quests (character_id, quest_id) VALUES
(1, 1),  -- Ulises: Viajar a Ítaca
(1, 2),  -- Ulises: Enfrentar a Polifemo
(2, 4),  -- Penélope: Destruir a los pretendientes
(3, 1),  -- Telemaco: Viajar a Ítaca
(4, 3),  -- Circe: Superar las Sirenas
(5, 1);  -- Calipso: Viajar a Ítaca
