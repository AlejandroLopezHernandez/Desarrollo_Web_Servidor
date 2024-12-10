-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS FLOTA;
USE FLOTA;

-- Crear la tabla VEHICULO
CREATE TABLE IF NOT EXiSTS VEHICULO (
    id_vehiculo INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(20) NOT NULL CHECK (tipo IN ('camion', 'furgoneta')),
    matricula VARCHAR(10) NOT NULL UNIQUE,
    alarma_revision INT DEFAULT 0, -- 0 indica que la alarma está desactivada, 1 que está activada
    coordenada_x INT NOT NULL,
    coordenada_y INT NOT NULL
);

-- Crear la tabla CONDUCTOR
CREATE TABLE IF NOT EXISTS CONDUCTOR (
    id_conductor INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    telefono VARCHAR(20)
);

-- Crear la tabla ENTREGA
CREATE TABLE IF NOT EXISTS ENTREGA (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_vehiculo INT NOT NULL,
    id_conductor INT NOT NULL,
    localidad VARCHAR(100) NOT NULL,
    kilometros INT NOT NULL,
    tiempo_maximo INT NOT NULL, -- en minutos
    tiempo_real INT, -- en minutos, puede estar vacío si la entrega está en proceso
    FOREIGN KEY (id_vehiculo) REFERENCES VEHICULO(id_vehiculo),
    FOREIGN KEY (id_conductor) REFERENCES CONDUCTOR(id_conductor)
);

-- Insertar datos de ejemplo en la tabla VEHICULO
INSERT INTO VEHICULO (tipo, matricula, alarma_revision, coordenada_x, coordenada_y) VALUES
('camion', 'ABC1234', 0, 1, 2),
('furgoneta', 'DEF5678', 1, 4, 5),
('camion', 'GHI9012', 0, 6, 7),
('furgoneta', 'JKL3456', 1, 8, 8);

-- Insertar datos de ejemplo en la tabla CONDUCTOR
INSERT INTO CONDUCTOR (nombre, telefono) VALUES
('Carlos Pérez', '600123456'),
('Ana García', '600654321'),
('Juan López', '600789123'),
('María Fernández', '600456789');

-- Insertar datos de ejemplo en la tabla ENTREGA
INSERT INTO ENTREGA (id_vehiculo, id_conductor, localidad, kilometros, tiempo_maximo, tiempo_real) VALUES
(1, 1, 'Madrid', 300, 180, 170),
(2, 2, 'Barcelona', 500, 300, NULL), -- En proceso
(3, 3, 'Valencia', 200, 120, 110),
(3, 3, 'Valencia', 400, 120, 110),
(3, 3, 'Valencia', 500, 120, 110),
(4, 4, 'Sevilla', 400, 240, NULL);-- En proceso



-- Crear la tabla ADMINISTRADOR con id_admin de tipo VARCHAR
CREATE TABLE IF NOT EXISTS ADMINISTRADOR (
    id_admin VARCHAR(50) PRIMARY KEY, -- Identificador único en formato VARCHAR
    password VARCHAR(255) NOT NULL -- Contraseña encriptada
);

-- Crear la tabla LOG
CREATE TABLE IF NOT EXISTS LOG (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_admin VARCHAR(50) NOT NULL,
    fecha_subida DATETIME NOT NULL,
    num_vehiculos_nuevos INT DEFAULT 0,
    num_conductores_nuevos INT DEFAULT 0,
    FOREIGN KEY (id_admin) REFERENCES ADMINISTRADOR(id_admin)
);

-- Insertar datos de ejemplo en la tabla ADMINISTRADOR con contraseñas cifradas
INSERT INTO ADMINISTRADOR (id_admin, password) VALUES
('admin1', '$2y$10$/V5KOUKlrfgPpfT/.bWgseNCciLjF3t/uOiqOVk9F8RhUuTNfiXBa'), -- Contraseña cifrada: 'admin123'
('admin2', '$2y$10$RoFZDOInU3MLTi.uSNHbzOV1824X.LFnLXW/NLu1OlZndBzfroiKK'); -- Contraseña cifrada: 'admin456'
