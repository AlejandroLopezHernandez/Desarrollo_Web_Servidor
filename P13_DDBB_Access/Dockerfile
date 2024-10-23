# Utiliza la imagen oficial de PHP con Apache como base
FROM php:8.2-apache

# Instalar las extensiones de MongoDB y MySQL
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install mysqli pdo_mysql \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb

# Habilitar mod_rewrite en Apache
RUN a2enmod rewrite

# Copia los archivos de configuración (opcional si tienes alguno)
# este archivo php.ini es el que tienes en tú proyecto!!!
 COPY ./php.ini /usr/local/etc/php/

# Exponer el puerto por defecto de Apache
EXPOSE 8081
