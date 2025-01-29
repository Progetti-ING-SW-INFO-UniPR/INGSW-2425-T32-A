# Usa un'immagine base con PHP e Apache
FROM php:7.4-apache

# Abilita il modulo Apache mod_rewrite
RUN a2enmod rewrite

# Copia i file del progetto nella directory root di Apache
COPY ./html /var/www/html

# Configura Apache per permettere l'uso di .htaccess
RUN echo '<Directory /var/www/html/>\n\
    AllowOverride All\n\
    </Directory>' >> /etc/apache2/apache2.conf

# Imposta i permessi
RUN chown -R www-data:www-data /var/www/html

RUN docker-php-ext-install pdo pdo_mysql

