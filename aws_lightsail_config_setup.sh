cp config.template.ini config.ini
sed -i.bak "s/<password>/$(cat /home/bitnami/bitnami_application_password)/;" config.ini
