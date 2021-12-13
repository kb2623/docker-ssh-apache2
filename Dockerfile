FROM debian:bullseye

LABEL maintainer="Klemen Berkovic <klemen.berkovic1@um.si>"
LABEL description="Debian image for ssh and apache servers."

ARG PASSWORD=password

RUN apt update \
 && apt install -y supervisor openssh-server apache2 php libapache2-mod-php

COPY files/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY files/index.php /var/www/html/index.php
COPY files/upload_form.php /var/www/html/upload_form.php

RUN mkdir -p /var/log/supervisor
RUN echo "root:$PASSWORD" | chpasswd \
 && echo 'Port 22\nPermitRootLogin yes\n' >> /etc/ssh/sshd_config \
 && mkdir -p /var/run/sshd
RUN chown -R www-data:www-data /var/www/html \
 && rm -f /var/www/html/index.html \
 && mkdir -p /var/lock/apache2 /var/run/apache2

EXPOSE 22 80

CMD ["/usr/bin/supervisord"]
