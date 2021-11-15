FROM debian:bullseye

LABEL maintainer="Klemen Berkovic <klemen.berkovic1@um.si>"
LABEL description="Debian image for ssh and apache servers."

ARG PASSWORD=password

RUN apt update && apt install -y openssh-server apache2 supervisor php libapache2-mod-php

RUN mkdir -p /var/lock/apache2 /var/run/apache2 /var/run/sshd /var/log/supervisor

RUN echo "root:$PASSWORD" | chpasswd
RUN echo 'Port 22\nPermitRootLogin yes\n' >> /etc/ssh/sshd_config

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 22 80

CMD ["/usr/bin/supervisord"]
