#!/usr/bin/bash
#
# Instala los requerimientos minimos del Proyecto
#
#
sudo -u www-data composer require hashids/hashids
sudo -u www-data composer require phpoffice/phpspreadsheet
sudo -u www-data composer require setasign/fpdi
sudo -u www-data composer require setasign/fpdf
sudo chown -R www-data:www-data /home/gmoreno/docker/lamp2/www/pdv
sudo chown -R www-data:www-data /home/gmoreno/docker/lamp2/www/pdv/.*

