FROM debian:buster


RUN  apt update && apt install -y software-properties-common
#RUN  add-apt-repository ppa:ondrej/php
RUN  apt update && DEBIAN_FRONTEND="noninteractive" apt install -y php7.3 nano git curl unzip zip php7.3-common php7.3-mysql php7.3-xml php7.3-xmlrpc php7.3-curl php7.3-gd php7.3-imagick php7.3-cli php7.3-dev php7.3-imap php7.3-mbstring php7.3-opcache php7.3-soap php7.3-zip php7.3-intl


RUN git clone https://github.com/achauque/xPL-printserver.git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR xPL-printserver

RUN composer install

RUN cp .env.example .env

RUN php artisan key:generate

EXPOSE 8000 9100

CMD php artisan serve --host=0.0.0.0 --port=8000