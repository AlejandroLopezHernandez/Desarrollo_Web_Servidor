-- Crear base de datos
CREATE DATABASE red_social_informatica;
USE red_social_informatica;

-- Crear tabla de usuarios
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(50) NOT NULL,
    seguidores INT DEFAULT 0
);

-- Crear tabla de publicaciones
CREATE TABLE publicaciones (
    id_publicacion INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    contenido TEXT,
    likes INT DEFAULT 0,
    categoria ENUM('BBDD', 'Lenguajes de Programación', 'Plataformas', 'IA', 'Big Data') NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE
);

-- Crear tabla de seguir_a para gestionar las relaciones de seguimiento entre usuarios
CREATE TABLE seguir_a (
    id_seguidor INT,
    id_seguido INT,
    FOREIGN KEY (id_seguidor) REFERENCES usuarios(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_seguido) REFERENCES usuarios(id_usuario) ON DELETE CASCADE,
    PRIMARY KEY (id_seguidor, id_seguido)
);

-- Insertar datos de ejemplo en la tabla usuarios
INSERT INTO usuarios (nombre_usuario, seguidores) VALUES 
    ('Carlos', 150),
    ('Lucia', 200),
    ('Miguel', 120),
    ('Sofia', 300),
    ('Ana', 180);

-- Insertar datos de ejemplo en la tabla publicaciones con categorías específicas
INSERT INTO publicaciones (id_usuario, contenido, likes, categoria) VALUES 
    (1, 'bases de datos relacionales y NoSQL', 35, 'BBDD'),
    (1, 'Cómo optimizar consultas en SQL', 50, 'BBDD'),
    (2, 'PHP y sus mejores prácticas', 120, 'Lenguajes de Programación'),
    (2, 'JavaScript y Python', 60, 'Lenguajes de Programación'),
    (3, 'Plataformas en la nube: AWS vs Azure', 20, 'Plataformas'),
    (4, 'Nuevas tendencias en inteligencia artificial', 100, 'IA'),
    (4, 'Aplicaciones de IA en medicina', 75, 'IA'),
    (5, 'Introducción al análisis de grandes datos', 45, 'Big Data'),
    (5, 'Uso de Hadoop para big data', 85, 'Big Data');

-- Insertar datos de ejemplo en la tabla seguir_a para relaciones de seguimiento
INSERT INTO seguir_a (id_seguidor, id_seguido) VALUES 
    (1, 2), -- Carlos sigue a Lucia
    (1, 3), -- Carlos sigue a Miguel
    (2, 4), -- Lucia sigue a Sofia
    (2, 5), -- Lucia sigue a Ana
    (3, 1), -- Miguel sigue a Carlos
    (3, 4), -- Miguel sigue a Sofia
    (4, 5), -- Sofia sigue a Ana
    (5, 1); -- Ana sigue a Carlos
