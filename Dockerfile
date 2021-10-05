FROM php:8.0-apache
LABEL maintainer="Bobby Hines <bobby@conflabs.com>"
LABEL image="conflabs/qrcode:latest"

# Set root directory for apache2 web server
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
ENV APACHE_LOG_DIR /var/www/html/storage/logs

# Update repos and install system/security updates
RUN apt-get update && apt-get upgrade -y

#############################################################
## SELECTED UTILITIES  ######################################
#############################################################

# Install required utility programs
RUN apt-get install -y apt-utils \
    build-essential \
    curl \
    nano \
    wget

# Install composer and put binary into $PATH
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#############################################################
## PHP EXTENSIONS / LIBRARIES  ##############################
#############################################################

#Install/Enable gd library
RUN apt-get install -y libfontconfig1  libfreetype6-dev libjpeg62-turbo-dev libpng-dev libwebp-dev libxpm-dev libxrender1 \
    && docker-php-ext-configure gd --enable-gd --with-webp --with-jpeg --with-xpm --with-freetype \
    && docker-php-ext-install -j$(nproc) gd

#Install Mysqli Library
RUN docker-php-ext-install -j$(nproc) mysqli

# Install/Enable PHP Zip extension
RUN apt-get install -y libzip-dev zlib1g-dev zip \
    && docker-php-ext-install zip

#############################################################
##  APACHE2  ################################################
#############################################################

# Establish directory for apache log files
RUN mkdir -p ${APACHE_LOG_DIR}

# Search and Replace baked in default configuration files with custom root directories
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Enable Pretty URLs
RUN ["a2enmod","rewrite"]

#############################################################
##  DOCKER  #################################################
#############################################################

EXPOSE 80

WORKDIR /var/www/html

VOLUME /var/www/html