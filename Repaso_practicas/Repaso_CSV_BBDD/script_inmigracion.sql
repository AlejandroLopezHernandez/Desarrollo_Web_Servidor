CREATE DATABASE IF NOT EXISTS Inmigracion;

USE Inmigracion;

CREATE TABLE IF NOT EXISTS datos_inmigracion (
    Any INT NOT NULL,
    Codi_Pays VARCHAR(10) NULL,
    Nacionalitat VARCHAR(50) NOT NULL,
    Poblaci INT NOT NULL
);