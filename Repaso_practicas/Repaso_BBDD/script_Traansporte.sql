CREATE DATABASE Transporte CHARACTER SET utf8mb4;

USE Transporte;

CREATE TABLE VEHICULO (
    identificador INT PRIMARY KEY,
    nombre VARCHAR(100),
    codigo_modelo VARCHAR(50),
    capacidad_carga DECIMAL(10, 2),
    activo CHAR(1) default 'S'
);

-- DDL para la tabla TIPO_MANTENIMIENTO
CREATE TABLE TIPO_MANTENIMIENTO (
    codigo_tipo_mantenimiento CHAR(5) PRIMARY KEY,
    descripcion VARCHAR(100)
);

-- DDL para la tabla MANTENIMIENTO_VEHICULO con el campo proximo_mantenimiento
CREATE TABLE MANTENIMIENTO_VEHICULO (
    mantenimiento_id INT AUTO_INCREMENT PRIMARY KEY,
    vehiculo_identificador INT,
    codigo_tipo_mantenimiento CHAR(5),
    fecha DATE,
    costo DECIMAL(10, 2),
    descripcion TEXT,
    proximo_mantenimiento DATE,
    CONSTRAINT FK_MANTENIMIENTOVEHICULO_VEHICULO FOREIGN KEY (vehiculo_identificador) REFERENCES VEHICULO (identificador),
    CONSTRAINT FK_MANTENIMIENTOVEHICULO_TIPOMANTENIMIENTO FOREIGN KEY (codigo_tipo_mantenimiento) REFERENCES TIPO_MANTENIMIENTO (codigo_tipo_mantenimiento)
);

CREATE TABLE AVION (
    identificador INT PRIMARY KEY,
    altura_maxima DECIMAL(10, 2),
    velocidad_maxima DECIMAL(10, 2),
    tipo_ala VARCHAR(20),
    autonomia_vuelo TIME,
    CONSTRAINT FK_AVION_VEHICULO FOREIGN KEY (identificador) REFERENCES VEHICULO (identificador),
    CONSTRAINT CHECK_TIPO_ALA CHECK (
        tipo_ala IN (
            'Alas fijas',
            'Alas giratorias'
        )
    )
);

CREATE TABLE BARCO (
    identificador INT PRIMARY KEY,
    longitud DECIMAL(10, 2),
    tipo_propulsion VARCHAR(50),
    calado_maximo DECIMAL(10, 2),
    CONSTRAINT FK_BARCO_VEHICULO FOREIGN KEY (identificador) REFERENCES VEHICULO (identificador),
    CONSTRAINT CHECK_TIPO_PROPULSION CHECK (
        tipo_propulsion IN (
            'Motor de combustión interna',
            'Vela',
            'Electrico'
        )
    )
);

CREATE TABLE CAMION (
    camion_id INT AUTO_INCREMENT PRIMARY KEY,
    vehiculo_identificador INT null,
    longitud DECIMAL(10, 2),
    tipo_cabina VARCHAR(10),
    CONSTRAINT FK_CAMION_VEHICULO FOREIGN KEY (vehiculo_identificador) REFERENCES VEHICULO (identificador),
    CONSTRAINT CHECK_TIPO_CABINA CHECK (
        tipo_cabina IN ('simple', 'doble')
    )
);

CREATE TABLE CONDUCTOR (
    conductor_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    telefono VARCHAR(20),
    direccion VARCHAR(200),
    camion_id INT unique,
    CONSTRAINT FK_CONTUCTOR_CAMION FOREIGN KEY (camion_id) REFERENCES CAMION (camion_id)
);

CREATE TABLE RUTA (
    ruta_id INT PRIMARY KEY,
    origen VARCHAR(100),
    destino VARCHAR(100),
    distancia_km DECIMAL(10, 2)
);

CREATE TABLE CAMION_RUTA (
    camion_id INT,
    ruta_id INT,
    fecha DATE,
    costo DECIMAL(10, 2),
    PRIMARY KEY (camion_id, ruta_id, fecha),
    CONSTRAINT FK_CAMIONRUTA_VEHICULO FOREIGN KEY (camion_id) REFERENCES CAMION (camion_id),
    CONSTRAINT FK_CAMIONRUTA_RUTA FOREIGN KEY (ruta_id) REFERENCES RUTA (ruta_id)
);
-- Cargar datos en la tabla VEHICULO
INSERT INTO
    VEHICULO (
        identificador,
        nombre,
        codigo_modelo,
        capacidad_carga
    )
VALUES
    -- Datos de aviones
    (
        1,
        'Boeing 737',
        'B737',
        1000.00
    ),
    (
        2,
        'Airbus A320',
        'A320',
        1200.00
    ),
    (
        3,
        'Cessna 172',
        'C172',
        800.00
    ),
    (
        4,
        'Embraer E190',
        'E190',
        1500.00
    ),
    (
        5,
        'Bombardier Challenger 600',
        'BC600',
        900.00
    ),
    -- Datos de barcos
    (
        6,
        'Queen Mary 2',
        'QM2',
        5000.00
    ),
    (
        7,
        'RMS Titanic',
        'TIT',
        6000.00
    ),
    (
        8,
        'USS Enterprise',
        'ENT',
        4500.00
    ),
    (
        9,
        'HMS Victory',
        'VIC',
        7000.00
    ),
    (
        10,
        'SS Nomadic',
        'NOM',
        8000.00
    ),
    (
        11,
        'AIDAnova',
        'ANOVA',
        5500.00
    ),
    (
        12,
        'Harmony of the Seas',
        'HRS',
        6500.00
    ),
    (
        13,
        'MS Queen Elizabeth',
        'QEL',
        4800.00
    ),
    (
        14,
        'Costa Smeralda',
        'SMER',
        7200.00
    ),
    (
        15,
        'MSC Grandiosa',
        'GRAN',
        8500.00
    ),
    (
        16,
        'Norwegian Encore',
        'ENC',
        5800.00
    ),
    (
        17,
        'Royal Clipper',
        'RCLIP',
        6800.00
    ),
    -- Datos de camiones
    (
        18,
        'Volvo FH16',
        'FH16',
        2000.00
    ),
    (
        19,
        'Scania R730',
        'R730',
        1800.00
    ),
    (
        20,
        'Mercedes-Benz Actros',
        'ACTROS',
        2200.00
    ),
    (21, 'MAN TGX', 'TGX', 2500.00),
    (
        22,
        'Kenworth W900',
        'W900',
        1600.00
    ),
    (
        23,
        'Peterbilt 579',
        'P579',
        1900.00
    ),
    (
        24,
        'Iveco S-Way',
        'S-WAY',
        2100.00
    ),
    (25, 'DAF XF', 'XF', 2300.00),
    (
        26,
        'Renault Trucks T',
        'T',
        2400.00
    ),
    (
        27,
        'Fuso Super Great',
        'SG',
        1700.00
    ),
    (
        28,
        'Isuzu Giga',
        'GIGA',
        2000.00
    ),
    (
        29,
        'Hino Profia',
        'PROFIA',
        1800.00
    ),
    (
        30,
        'UD Quon',
        'QUON',
        2200.00
    ),
    (
        31,
        'Iveco Eurocargo',
        'EURO',
        2500.00
    ),
    (32, 'MAN TGM', 'TGM', 1600.00),
    (
        33,
        'Dongfeng KL',
        'KL',
        1900.00
    ),
    (
        34,
        'BharatBenz',
        'BB',
        2100.00
    ),
    (35, 'KAMAZ', 'KAM', 2300.00),
    -- Otros vehículos
    (
        36,
        'Tesla Model X',
        'MODX',
        3000.00
    ),
    (
        37,
        'Toyota Prius',
        'PRIUS',
        3200.00
    ),
    (
        38,
        'Harley-Davidson Street',
        'HDS',
        2800.00
    ),
    (
        39,
        'Yamaha YZF-R1',
        'YZF',
        3500.00
    );

-- Insertar registros en la tabla VEHICULO
INSERT INTO
    VEHICULO (
        identificador,
        nombre,
        codigo_modelo,
        capacidad_carga,
        activo
    )
VALUES (
        41,
        'MAN TGX',
        'TGX',
        22000.00,
        'N'
    ),
    (
        42,
        'Scania R500',
        'R500',
        19000.00,
        'N'
    ),
    (
        43,
        'Norwegian Encore',
        'Norwegian Encore',
        500000.00,
        'N'
    ),
    (
        44,
        'Europa 2',
        'Europa 2',
        400000.00,
        'N'
    ),
    (
        45,
        'Disney Fantasy',
        'Disney Fantasy',
        450000.00,
        'N'
    ),
    (
        46,
        'Airbus A350',
        'A350',
        135000.00,
        'N'
    ),
    (
        47,
        'Boeing 787 Dreamliner',
        '787 Dreamliner',
        150000.00,
        'N'
    ),
    (
        48,
        'Bombardier CRJ900',
        'CRJ900',
        25000.00,
        'N'
    ),
    (
        49,
        'Embraer ERJ-195',
        'ERJ-195',
        18000.00,
        'N'
    );

-- Insertar información para la tabla TIPO_MANTENIMIENTO
INSERT INTO
    TIPO_MANTENIMIENTO (
        codigo_tipo_mantenimiento,
        descripcion
    )
VALUES (
        'MT_CO',
        'Mantenimiento correctivo general'
    ),
    (
        'MT_PR',
        'Mantenimiento preventivo general'
    ),
    (
        'AV_PM',
        'Mantenimiento preventivo de avión'
    ),
    (
        'AV_CM',
        'Mantenimiento correctivo de avión'
    ),
    (
        'BA_PM',
        'Mantenimiento preventivo de barco'
    ),
    (
        'BA_CM',
        'Mantenimiento correctivo de barco'
    ),
    (
        'CA_PM',
        'Mantenimiento preventivo de camión'
    ),
    (
        'CA_CM',
        'Mantenimiento correctivo de camión'
    ),
    (
        'OT_PM',
        'Mantenimiento preventivo de otro tipo de vehículo'
    ),
    (
        'OT_CM',
        'Mantenimiento correctivo de otro tipo de vehículo'
    );

-- Insertar información en la tabla MANTENIMIENTO_VEHICULO
-- 2.1: 5 vehículos no tendrán ningún mantenimiento (no aparecerán en la tabla)
-- Los siguientes vehículos tendrán al menos 1 mantenimiento
INSERT INTO
    MANTENIMIENTO_VEHICULO (
        vehiculo_identificador,
        codigo_tipo_mantenimiento,
        fecha,
        costo,
        descripcion,
        proximo_mantenimiento
    )
VALUES
    -- Vehículos con al menos 1 mantenimiento
    (
        1,
        'AV_PM',
        '2023-01-05',
        500.00,
        'Revisión de motores',
        '2023-07-05'
    ),
    (
        2,
        'AV_CM',
        '2023-02-10',
        700.00,
        'Reparación de sistema de navegación',
        '2023-08-10'
    ),
    (
        3,
        'CA_PM',
        '2023-03-15',
        400.00,
        'Cambio de aceite y filtros',
        '2023-09-15'
    ),
    (
        4,
        'OT_CM',
        '2023-04-20',
        600.00,
        'Alineación y balanceo',
        '2023-10-20'
    ),
    (
        7,
        'BA_PM',
        '2023-05-25',
        800.00,
        'Inspección de casco',
        '2023-11-25'
    ),
    (
        8,
        'CA_CM',
        '2023-06-30',
        900.00,
        'Reparación de frenos',
        '2023-12-30'
    ),
    (
        9,
        'OT_PM',
        '2023-07-05',
        450.00,
        'Mantenimiento de sistemas de refrigeración',
        '2024-01-05'
    ),
    (
        10,
        'AV_CM',
        '2023-08-10',
        550.00,
        'Reparación de sistema hidráulico',
        '2024-02-10'
    ),
    (
        11,
        'BA_PM',
        '2023-09-15',
        750.00,
        'Revisión de sistema eléctrico',
        '2024-03-15'
    ),
    (
        12,
        'CA_CM',
        '2023-10-20',
        300.00,
        'Mantenimiento de suspensión',
        '2024-04-20'
    ),
    (
        13,
        'OT_PM',
        '2023-11-25',
        650.00,
        'Revisión de sistema de iluminación',
        '2024-05-25'
    ),
    (
        16,
        'AV_PM',
        '2023-12-30',
        700.00,
        'Inspección de tren de aterrizaje',
        '2024-06-30'
    ),
    (
        17,
        'BA_CM',
        '2024-01-05',
        850.00,
        'Reparación de sistema de propulsión',
        '2024-07-05'
    ),
    (
        18,
        'CA_PM',
        '2024-02-10',
        400.00,
        'Cambio de neumáticos',
        '2024-08-10'
    ),
    (
        19,
        'OT_CM',
        '2024-03-15',
        600.00,
        'Mantenimiento de sistema de escape',
        '2024-09-15'
    ),
    (
        20,
        'AV_CM',
        '2024-04-20',
        750.00,
        'Reparación de sistema de combustible',
        '2024-10-20'
    ),
    (
        21,
        'BA_PM',
        '2024-05-25',
        350.00,
        'Limpieza de tanques de combustible',
        '2024-11-25'
    ),
    (
        22,
        'CA_CM',
        '2024-06-30',
        800.00,
        'Reparación de transmisión',
        '2024-12-30'
    ),
    (
        23,
        'OT_PM',
        '2024-07-05',
        500.00,
        'Mantenimiento de sistema de dirección',
        '2025-01-05'
    ),
    (
        24,
        'AV_CM',
        '2024-08-10',
        650.00,
        'Reparación de sistema de comunicaciones',
        '2025-02-10'
    ),
    (
        26,
        'BA_PM',
        '2024-09-15',
        700.00,
        'Revisión de sistema de refrigeración',
        '2025-03-15'
    ),
    (
        27,
        'CA_CM',
        '2024-10-20',
        300.00,
        'Mantenimiento de sistema de combustión',
        '2025-04-20'
    ),
    (
        28,
        'OT_PM',
        '2024-11-25',
        600.00,
        'Revisión de sistema de frenos',
        '2025-05-25'
    ),
    (
        29,
        'AV_CM',
        '2024-12-30',
        750.00,
        'Reparación de sistema de iluminación',
        '2025-06-30'
    ),
    (
        30,
        'BA_PM',
        '2025-01-05',
        350.00,
        'Mantenimiento de sistema de propulsión',
        '2025-07-05'
    ),
    (
        31,
        'CA_CM',
        '2025-02-10',
        800.00,
        'Reparación de sistema hidráulico',
        '2025-08-10'
    ),
    (
        32,
        'OT_PM',
        '2025-03-15',
        500.00,
        'Mantenimiento de sistema de frenos',
        '2025-09-15'
    ),
    (
        34,
        'AV_CM',
        '2025-04-20',
        650.00,
        'Reparación de sistema de transmisión',
        '2025-10-20'
    ),
    (
        35,
        'BA_PM',
        '2025-05-25',
        700.00,
        'Revisión de sistema de dirección',
        '2025-11-25'
    ),
    (
        36,
        'CA_CM',
        '2025-06-30',
        300.00,
        'Mantenimiento de sistema de comunicaciones',
        '2025-12-30'
    ),
    (
        37,
        'OT_PM',
        '2025-07-05',
        600.00,
        'Revisión de sistema de combustible',
        '2026-01-05'
    ),
    (
        38,
        'AV_CM',
        '2025-08-10',
        750.00,
        'Reparación de sistema de navegación',
        '2026-02-10'
    ),
    (
        39,
        'BA_PM',
        '2025-09-15',
        350.00,
        'Mantenimiento de sistema de iluminación',
        '2026-03-15'
    );

-- 2.3: 4 de los vehículos existentes tendrán al menos 2 mantenimientos.
INSERT INTO
    MANTENIMIENTO_VEHICULO (
        vehiculo_identificador,
        codigo_tipo_mantenimiento,
        fecha,
        costo,
        descripcion,
        proximo_mantenimiento
    )
VALUES (
        1,
        'MT_CO',
        '2023-03-01',
        200.00,
        'Mantenimiento correctivo inicial',
        DATE_ADD(
            '2023-03-01',
            INTERVAL 3 MONTH
        )
    ),
    (
        2,
        'MT_PR',
        '2023-03-15',
        250.00,
        'Mantenimiento preventivo inicial',
        DATE_ADD(
            '2023-03-15',
            INTERVAL 6 MONTH
        )
    ),
    (
        3,
        'MT_CO',
        '2023-03-20',
        220.00,
        'Mantenimiento correctivo inicial',
        DATE_ADD(
            '2023-03-20',
            INTERVAL 4 MONTH
        )
    ),
    (
        4,
        'MT_PR',
        '2023-04-05',
        280.00,
        'Mantenimiento preventivo inicial',
        DATE_ADD(
            '2023-04-05',
            INTERVAL 5 MONTH
        )
    );

-- 2.4: 5 de los vehículos existentes tendrán al menos 3 mantenimientos.
INSERT INTO
    MANTENIMIENTO_VEHICULO (
        vehiculo_identificador,
        codigo_tipo_mantenimiento,
        fecha,
        costo,
        descripcion,
        proximo_mantenimiento
    )
VALUES (
        6,
        'MT_CO',
        '2023-06-01',
        300.00,
        'Mantenimiento correctivo inicial',
        DATE_ADD(
            '2023-06-01',
            INTERVAL 3 MONTH
        )
    ),
    (
        7,
        'MT_PR',
        '2023-06-15',
        350.00,
        'Mantenimiento preventivo inicial',
        DATE_ADD(
            '2023-06-15',
            INTERVAL 6 MONTH
        )
    ),
    (
        8,
        'MT_CO',
        '2023-06-20',
        320.00,
        'Mantenimiento correctivo inicial',
        DATE_ADD(
            '2023-06-20',
            INTERVAL 4 MONTH
        )
    ),
    (
        9,
        'MT_PR',
        '2023-07-05',
        380.00,
        'Mantenimiento preventivo inicial',
        DATE_ADD(
            '2023-07-05',
            INTERVAL 5 MONTH
        )
    ),
    (
        10,
        'MT_CO',
        '2023-07-10',
        340.00,
        'Mantenimiento correctivo inicial',
        DATE_ADD(
            '2023-07-10',
            INTERVAL 4 MONTH
        )
    );

-- 2.5: 3 de los vehículos existentes tendrán al menos 4 mantenimientos.
INSERT INTO
    MANTENIMIENTO_VEHICULO (
        vehiculo_identificador,
        codigo_tipo_mantenimiento,
        fecha,
        costo,
        descripcion,
        proximo_mantenimiento
    )
VALUES (
        11,
        'MT_CO',
        '2023-09-01',
        400.00,
        'Mantenimiento correctivo adicional',
        DATE_ADD(
            '2023-09-01',
            INTERVAL 3 MONTH
        )
    ),
    (
        12,
        'MT_PR',
        '2023-09-15',
        450.00,
        'Mantenimiento preventivo adicional',
        DATE_ADD(
            '2023-09-15',
            INTERVAL 6 MONTH
        )
    ),
    (
        13,
        'MT_CO',
        '2023-09-20',
        420.00,
        'Mantenimiento correctivo adicional',
        DATE_ADD(
            '2023-09-20',
            INTERVAL 4 MONTH
        )
    );

-- 2.4: 5 de los vehículos existentes tendrán al menos 3 mantenimientos.
INSERT INTO
    MANTENIMIENTO_VEHICULO (
        vehiculo_identificador,
        codigo_tipo_mantenimiento,
        fecha,
        costo,
        descripcion,
        proximo_mantenimiento
    )
VALUES (
        11,
        'MT_CO',
        '2023-09-01',
        400.00,
        'Mantenimiento correctivo adicional',
        DATE_ADD(
            '2023-09-01',
            INTERVAL 3 MONTH
        )
    ),
    (
        11,
        'MT_CO',
        '2023-12-01',
        400.00,
        'Mantenimiento correctivo adicional',
        DATE_ADD(
            '2023-12-01',
            INTERVAL 3 MONTH
        )
    ),
    (
        12,
        'MT_PR',
        '2023-09-15',
        450.00,
        'Mantenimiento preventivo adicional',
        DATE_ADD(
            '2023-09-15',
            INTERVAL 6 MONTH
        )
    ),
    (
        12,
        'MT_PR',
        '2023-12-15',
        450.00,
        'Mantenimiento preventivo adicional',
        DATE_ADD(
            '2023-12-15',
            INTERVAL 6 MONTH
        )
    ),
    (
        13,
        'MT_CO',
        '2023-09-20',
        420.00,
        'Mantenimiento correctivo adicional',
        DATE_ADD(
            '2023-09-20',
            INTERVAL 4 MONTH
        )
    ),
    (
        13,
        'MT_PR',
        '2023-12-20',
        470.00,
        'Mantenimiento preventivo adicional',
        DATE_ADD(
            '2023-12-20',
            INTERVAL 6 MONTH
        )
    );

-- 2.5: 3 de los vehículos existentes tendrán al menos 4 mantenimientos.
INSERT INTO
    MANTENIMIENTO_VEHICULO (
        vehiculo_identificador,
        codigo_tipo_mantenimiento,
        fecha,
        costo,
        descripcion,
        proximo_mantenimiento
    )
VALUES (
        6,
        'MT_CO',
        '2023-06-01',
        300.00,
        'Mantenimiento correctivo inicial',
        DATE_ADD(
            '2023-06-01',
            INTERVAL 3 MONTH
        )
    ),
    (
        6,
        'MT_CO',
        '2023-09-01',
        400.00,
        'Mantenimiento correctivo adicional',
        DATE_ADD(
            '2023-09-01',
            INTERVAL 3 MONTH
        )
    ),
    (
        6,
        'MT_PR',
        '2023-06-15',
        350.00,
        'Mantenimiento preventivo inicial',
        DATE_ADD(
            '2023-06-15',
            INTERVAL 6 MONTH
        )
    ),
    (
        6,
        'MT_PR',
        '2023-09-15',
        450.00,
        'Mantenimiento preventivo adicional',
        DATE_ADD(
            '2023-09-15',
            INTERVAL 6 MONTH
        )
    ),
    (
        7,
        'MT_PR',
        '2023-06-15',
        350.00,
        'Mantenimiento preventivo inicial',
        DATE_ADD(
            '2023-06-15',
            INTERVAL 6 MONTH
        )
    ),
    (
        7,
        'MT_PR',
        '2023-09-15',
        450.00,
        'Mantenimiento preventivo adicional',
        DATE_ADD(
            '2023-09-15',
            INTERVAL 6 MONTH
        )
    ),
    (
        8,
        'MT_CO',
        '2023-06-20',
        320.00,
        'Mantenimiento correctivo inicial',
        DATE_ADD(
            '2023-06-20',
            INTERVAL 4 MONTH
        )
    ),
    (
        8,
        'MT_CO',
        '2023-09-20',
        420.00,
        'Mantenimiento correctivo adicional',
        DATE_ADD(
            '2023-09-20',
            INTERVAL 4 MONTH
        )
    ),
    (
        8,
        'MT_PR',
        '2023-06-20',
        380.00,
        'Mantenimiento preventivo inicial',
        DATE_ADD(
            '2023-06-20',
            INTERVAL 6 MONTH
        )
    ),
    (
        8,
        'MT_PR',
        '2023-09-20',
        480.00,
        'Mantenimiento preventivo adicional',
        DATE_ADD(
            '2023-09-20',
            INTERVAL 6 MONTH
        )
    ),
    (
        9,
        'MT_PR',
        '2023-07-05',
        380.00,
        'Mantenimiento preventivo inicial',
        DATE_ADD(
            '2023-07-05',
            INTERVAL 5 MONTH
        )
    ),
    (
        9,
        'MT_PR',
        '2023-10-05',
        480.00,
        'Mantenimiento preventivo adicional',
        DATE_ADD(
            '2023-10-05',
            INTERVAL 5 MONTH
        )
    );
-- Cargar datos en la tabla AVION
INSERT INTO
    AVION (
        identificador,
        altura_maxima,
        velocidad_maxima,
        tipo_ala,
        autonomia_vuelo
    )
VALUES (
        1,
        12000.00,
        800.00,
        'Alas fijas',
        '06:00:00'
    ),
    (
        2,
        11000.00,
        850.00,
        'Alas fijas',
        '07:30:00'
    ),
    (
        3,
        9000.00,
        750.00,
        'Alas giratorias',
        '05:00:00'
    ),
    (
        4,
        13000.00,
        900.00,
        'Alas fijas',
        '08:00:00'
    ),
    (
        5,
        10000.00,
        820.00,
        'Alas giratorias',
        '06:30:00'
    );

-- Insertar registros en la tabla AVION
INSERT INTO
    AVION (
        identificador,
        altura_maxima,
        velocidad_maxima,
        tipo_ala,
        autonomia_vuelo
    )
VALUES (
        46,
        64500,
        945.00,
        'Alas fijas',
        '12:30:00'
    ),
    (
        47,
        56900,
        900.00,
        'Alas fijas',
        '11:45:00'
    ),
    (
        48,
        12300,
        890.00,
        'Alas fijas',
        '04:20:00'
    ),
    (
        49,
        10800,
        840.00,
        'Alas fijas',
        '07:00:00'
    );

-- Cargar datos en la tabla BARCO
INSERT INTO
    BARCO (
        identificador,
        longitud,
        tipo_propulsion,
        calado_maximo
    )
VALUES (
        6,
        50.00,
        'Motor de combustión interna',
        10.00
    ),
    (
        7,
        60.00,
        'Motor de combustión interna',
        12.00
    ),
    (8, 45.00, 'Vela', 8.00),
    (
        9,
        70.00,
        'Motor de combustión interna',
        14.00
    ),
    (
        10,
        80.00,
        'Motor de combustión interna',
        16.00
    ),
    (11, 55.00, 'Electrico', 9.00),
    (12, 65.00, 'Electrico', 11.00),
    (13, 48.00, 'Vela', 7.50),
    (14, 72.00, 'Electrico', 13.00),
    (
        15,
        85.00,
        'Motor de combustión interna',
        17.00
    ),
    (16, 58.00, 'Vela', 9.50),
    (17, 68.00, 'Vela', 10.50);

-- Insertar registros en la tabla BARCO
INSERT INTO
    BARCO (
        identificador,
        longitud,
        tipo_propulsion,
        calado_maximo
    )
VALUES (
        43,
        333.00,
        'Motor de combustión interna',
        12.50
    ),
    (44, 225.00, 'Vela', 9.80),
    (
        45,
        340.00,
        'Electrico',
        14.00
    );

-- Cargar datos en la tabla CAMION
INSERT INTO
    CAMION (
        camion_id,
        vehiculo_identificador,
        longitud,
        tipo_cabina
    )
VALUES (1, 18, 10.00, 'simple'),
    (2, 19, 9.50, 'simple'),
    (3, 20, 11.00, 'doble'),
    (4, 21, 12.00, 'doble'),
    (5, 22, 9.00, 'simple'),
    (6, 23, 10.50, 'simple'),
    (7, 24, 11.50, 'doble'),
    (8, 25, 12.50, 'doble'),
    (9, 26, 9.50, 'simple'),
    (10, 27, 11.00, 'simple'),
    (11, 28, 10.00, 'doble'),
    (12, 29, 12.00, 'doble'),
    (13, 30, 9.00, 'simple'),
    (14, 31, 10.50, 'simple'),
    (15, 32, 11.50, 'doble'),
    (16, 33, 12.50, 'doble'),
    (17, 34, 9.50, 'simple'),
    (18, 35, 11.00, 'simple');

-- Insertar información en la tabla CAMION
INSERT INTO
    CAMION (
        camion_id,
        vehiculo_identificador,
        longitud,
        tipo_cabina
    )
VALUES (28, NULL, 10.2, 'simple'),
    (29, NULL, 9.5, 'doble'),
    (30, NULL, 11.0, 'simple'),
    (31, NULL, 10.8, 'doble'),
    (32, NULL, 10.5, 'simple'),
    (33, NULL, 9.0, 'doble'),
    (34, NULL, 11.2, 'simple'),
    (35, NULL, 10.1, 'doble'),
    (36, NULL, 9.8, 'simple');

-- Insertar registros en la tabla CAMION
INSERT INTO
    CAMION (
        camion_id,
        vehiculo_identificador,
        longitud,
        tipo_cabina
    )
VALUES (37, 41, 12.5, 'simple'),
    (38, 42, 14.2, 'doble');

-- Insertando información de conductores de camiones
INSERT INTO
    CONDUCTOR (
        nombre,
        telefono,
        direccion,
        camion_id
    )
VALUES (
        'Juan García Pérez',
        '123456789',
        'Calle Mayor 123, Madrid',
        1
    ),
    (
        'María López Martínez',
        '987654321',
        'Calle Gran Vía 456, Barcelona',
        2
    ),
    (
        'Pedro Martín Sánchez',
        '654987321',
        'Calle Real 789, Valencia',
        3
    ),
    (
        'Ana González García',
        '789654123',
        'Calle Sol 456, Sevilla',
        4
    ),
    (
        'Carlos Rodríguez Fernández',
        '321456987',
        'Calle Luna 789, Bilbao',
        5
    ),
    (
        'Laura Sánchez Gómez',
        '147258369',
        'Calle Estrella 123, Málaga',
        6
    ),
    (
        'Sergio Pérez Rodríguez',
        '963852741',
        'Calle Sol 456, Zaragoza',
        7
    ),
    (
        'Elena Fernández López',
        '258963147',
        'Calle Luna 789, Murcia',
        8
    ),
    (
        'David Gómez Martínez',
        '369258147',
        'Calle Mayor 123, Alicante',
        9
    ),
    (
        'Carmen Martín Pérez',
        '852369741',
        'Calle Gran Vía 456, Valladolid',
        10
    );

-- Insertando información de conductores de otros tipos de camiones
INSERT INTO
    CONDUCTOR (
        nombre,
        telefono,
        direccion,
        camion_id
    )
VALUES (
        'Raúl Hernández Rodríguez',
        '123987654',
        'Calle Real 789, Cádiz',
        28
    ),
    (
        'Sara Martínez Gómez',
        '987321654',
        'Calle Gran Vía 456, Santander',
        29
    ),
    (
        'Javier González Martín',
        '654321987',
        'Calle Mayor 123, Pamplona',
        30
    ),
    (
        'Eva Sánchez Pérez',
        '789123456',
        'Calle Real 789, Salamanca',
        31
    ),
    (
        'Luis Pérez Gutiérrez',
        '321654987',
        'Calle Gran Vía 456, Logroño',
        32
    ),
    (
        'Marina Gómez Sánchez',
        '147963258',
        'Calle Luna 789, Oviedo',
        33
    ),
    (
        'Pablo Fernández Martínez',
        '963147258',
        'Calle Mayor 123, Córdoba',
        34
    ),
    (
        'Lucía Martín López',
        '258741963',
        'Calle Gran Vía 456, Albacete',
        35
    ),
    (
        'Daniel Sánchez Martínez',
        '369852741',
        'Calle Real 789, Girona',
        36
    );
-- Cargar datos en la tabla RUTA
INSERT INTO
    RUTA (
        ruta_id,
        origen,
        destino,
        distancia_km
    )
VALUES (
        1,
        'Madrid',
        'Barcelona',
        620.00
    ),
    (
        2,
        'Barcelona',
        'Valencia',
        350.00
    ),
    (
        3,
        'Valencia',
        'Sevilla',
        540.00
    ),
    (
        4,
        'Sevilla',
        'Málaga',
        220.00
    ),
    (5, 'Málaga', 'Bilbao', 890.00),
    (
        6,
        'Bilbao',
        'Alicante',
        750.00
    ),
    (
        7,
        'Alicante',
        'Granada',
        520.00
    ),
    (
        8,
        'Granada',
        'Zaragoza',
        770.00
    ),
    (
        9,
        'Zaragoza',
        'Madrid',
        320.00
    );

-- 3.1.1: Incluir 12 nuevos registros con origenes repetidos pero destinos distintos
INSERT INTO
    RUTA (
        ruta_id,
        origen,
        destino,
        distancia_km
    )
VALUES (
        10,
        'Madrid',
        'Valencia',
        350.00
    ),
    (
        11,
        'Madrid',
        'Sevilla',
        540.00
    ),
    (
        12,
        'Madrid',
        'Málaga',
        220.00
    ),
    (
        13,
        'Madrid',
        'Barcelona',
        620.00
    ),
    (
        14,
        'Madrid',
        'Bilbao',
        890.00
    ),
    (
        15,
        'Madrid',
        'Alicante',
        750.00
    ),
    (
        16,
        'Madrid',
        'Granada',
        520.00
    ),
    (
        17,
        'Madrid',
        'Zaragoza',
        320.00
    ),
    (
        18,
        'Madrid',
        'La Coruña',
        600.00
    ),
    (19, 'Madrid', 'Vigo', 550.00),
    (20, 'Madrid', 'Cádiz', 640.00),
    (
        21,
        'Madrid',
        'Santander',
        430.00
    );

-- 3.1.2: Incluir 10 nuevos registros con destinos repetidos pero origenes no repetidos
INSERT INTO
    RUTA (
        ruta_id,
        origen,
        destino,
        distancia_km
    )
VALUES (
        22,
        'Valencia',
        'Barcelona',
        350.00
    ),
    (
        23,
        'Sevilla',
        'Barcelona',
        900.00
    ),
    (
        24,
        'Málaga',
        'Barcelona',
        800.00
    ),
    (
        25,
        'Bilbao',
        'Barcelona',
        700.00
    ),
    (
        26,
        'Alicante',
        'Barcelona',
        550.00
    ),
    (
        27,
        'Granada',
        'Barcelona',
        720.00
    ),
    (
        28,
        'Zaragoza',
        'Barcelona',
        300.00
    ),
    (
        29,
        'La Coruña',
        'Barcelona',
        1100.00
    ),
    (
        30,
        'Vigo',
        'Barcelona',
        950.00
    ),
    (
        31,
        'Cádiz',
        'Barcelona',
        810.00
    );

--  Incluir 4 nuevos registros con origen "Santander" y distintos destinos
INSERT INTO
    RUTA (
        ruta_id,
        origen,
        destino,
        distancia_km
    )
VALUES (
        32,
        'Santander',
        'Madrid',
        480.00
    ),
    (
        33,
        'Santander',
        'Valencia',
        720.00
    ),
    (
        34,
        'Santander',
        'Barcelona',
        740.00
    ),
    (
        35,
        'Santander',
        'Sevilla',
        860.00
    );

-- Incluir 4 nuevos registros con origen "Palencia" y distintos destinos
INSERT INTO
    RUTA (
        ruta_id,
        origen,
        destino,
        distancia_km
    )
VALUES (
        36,
        'Palencia',
        'Alicante',
        430.00
    ),
    (
        37,
        'Palencia',
        'Málaga',
        590.00
    ),
    (
        38,
        'Palencia',
        'Zaragoza',
        320.00
    ),
    (
        39,
        'Palencia',
        'Bilbao',
        240.00
    );

-- Incluir 10 nuevos registros con destinos repetidos "Santander" y otros 4 con "Palencia" pero con orígenes distintos
INSERT INTO
    RUTA (
        ruta_id,
        origen,
        destino,
        distancia_km
    )
VALUES (
        40,
        'Madrid',
        'Santander',
        450.00
    ),
    (
        41,
        'Barcelona',
        'Santander',
        580.00
    ),
    (
        42,
        'Valencia',
        'Santander',
        620.00
    ),
    (
        43,
        'Sevilla',
        'Santander',
        750.00
    ),
    (
        44,
        'Granada',
        'Santander',
        840.00
    ),
    (
        45,
        'Alicante',
        'Santander',
        710.00
    ),
    (
        46,
        'Málaga',
        'Santander',
        690.00
    ),
    (
        47,
        'Zaragoza',
        'Santander',
        470.00
    ),
    (
        48,
        'Bilbao',
        'Santander',
        130.00
    ),
    (
        49,
        'La Coruña',
        'Santander',
        560.00
    ),
    (
        50,
        'Madrid',
        'Palencia',
        250.00
    ),
    (
        51,
        'Barcelona',
        'Palencia',
        480.00
    ),
    (
        52,
        'Valencia',
        'Palencia',
        390.00
    ),
    (
        53,
        'Sevilla',
        'Palencia',
        620.00
    );

-- Cargar datos en la tabla CAMION_RUTA
-- Asignar camiones a rutas
INSERT INTO
    CAMION_RUTA (
        camion_id,
        ruta_id,
        fecha,
        costo
    )
VALUES
    -- Ruta 1
    (1, 1, '2024-02-20', 350.00),
    (2, 1, '2024-02-21', 300.00),
    (3, 1, '2024-02-22', 320.00),
    -- Ruta 2
    (4, 2, '2024-02-23', 280.00),
    (5, 2, '2024-02-24', 330.00),
    (6, 2, '2024-02-25', 290.00),
    -- Ruta 3
    (7, 3, '2024-02-26', 420.00),
    (8, 3, '2024-02-27', 380.00),
    (9, 3, '2024-02-28', 400.00),
    -- Ruta 4
    (10, 4, '2024-02-29', 250.00),
    (11, 4, '2024-03-01', 270.00),
    (12, 4, '2024-03-02', 260.00),
    -- Ruta 5
    (13, 5, '2024-03-03', 600.00),
    (14, 5, '2024-03-04', 620.00),
    (15, 5, '2024-03-05', 580.00),
    -- Ruta 6
    (16, 6, '2024-03-06', 520.00),
    (17, 6, '2024-03-07', 550.00),
    (18, 6, '2024-03-08', 500.00),
    -- Ruta 7
    (1, 7, '2024-03-09', 450.00),
    (10, 7, '2024-03-10', 470.00),
    (12, 7, '2024-03-11', 480.00),
    -- Ruta 8
    (2, 8, '2024-03-12', 380.00),
    (3, 8, '2024-03-13', 400.00),
    (4, 8, '2024-03-14', 360.00),
    -- Ruta 9
    (15, 9, '2024-03-15', 320.00),
    (16, 9, '2024-03-16', 350.00),
    (17, 9, '2024-03-17', 310.00);
-- Insertar 18 nuevos registros del año 2021 con camiones y rutas repetidas con distintos costos
INSERT INTO
    CAMION_RUTA (
        camion_id,
        ruta_id,
        fecha,
        costo
    )
VALUES (1, 10, '2021-01-05', 1200),
    (2, 30, '2021-02-10', 1350),
    (3, 20, '2021-03-15', 1100),
    (4, 10, '2021-04-20', 1250),
    (5, 30, '2021-05-25', 1300),
    (6, 20, '2021-06-30', 1150),
    (7, 10, '2021-07-05', 1220),
    (8, 30, '2021-08-10', 1280),
    (9, 20, '2021-09-15', 1120),
    (10, 10, '2021-10-20', 1275),
    (11, 30, '2021-11-25', 1315),
    (12, 20, '2021-12-30', 1135),
    (13, 10, '2021-01-05', 1230),
    (14, 30, '2021-02-10', 1360),
    (15, 20, '2021-03-15', 1115),
    (16, 10, '2021-04-20', 1265),
    (17, 30, '2021-05-25', 1325),
    (18, 20, '2021-06-30', 1145);

-- Insertar 19 nuevos registros del año 2022 con camiones y rutas repetidas con distintos costos
INSERT INTO
    CAMION_RUTA (
        camion_id,
        ruta_id,
        fecha,
        costo
    )
VALUES (11, 14, '2022-01-05', 1210),
    (12, 3, '2022-02-10', 1345),
    (13, 22, '2022-03-15', 1112),
    (14, 11, '2022-04-20', 1258),
    (15, 31, '2022-05-25', 1298),
    (16, 21, '2022-06-30', 1163),
    (17, 11, '2022-07-05', 1227),
    (28, 31, '2022-08-10', 1272),
    (29, 21, '2022-09-15', 1134),
    (29, 11, '2022-10-20', 1285),
    (31, 31, '2022-11-25', 1305),
    (32, 22, '2022-12-30', 1158),
    (33, 11, '2022-01-05', 1218),
    (34, 31, '2022-02-10', 1343),
    (35, 21, '2022-03-15', 1116),
    (28, 11, '2022-04-20', 1268),
    (28, 31, '2022-05-25', 1320),
    (28, 21, '2022-06-30', 1165),
    (29, 11, '2022-07-05', 1235);