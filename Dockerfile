# Étape 2 : Configurer le conteneur PHP avec Apache
FROM php:7.4-apache

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Activer les modules Apache requis
RUN a2enmod rewrite

# Installer le client MySQL
RUN apt-get update && apt-get install -y default-mysql-client

# Copier les fichiers d'erreur personnalisés
COPY error404.html /var/www/html/error404.html
COPY error403.html /var/www/html/error403.html
COPY error500.html /var/www/html/error500.html
COPY error503.html /var/www/html/error503.html

# Copier le fichier de configuration Apache personnalisé
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Modify Apache configuration to allow .htaccess overrides
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Configurer Apache pour écouter sur toutes les interfaces
RUN sed -i 's/Listen 80/Listen 0.0.0.0:80/g' /etc/apache2/ports.conf

# Copy site files into the container
COPY . /var/www/html/

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Exposer le port 80
EXPOSE 80

# Commande de démarrage de l'application
CMD ["apache2-foreground"]
