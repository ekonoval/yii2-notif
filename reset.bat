@ECHO OFF

mysql -u root -e "drop database if exists yii2_notif; create database yii2_notif default character set utf8 default collate utf8_unicode_ci";

yii migrate --migrationPath=@yii/rbac/migrations --interactive=0

yii migrate --interactive=0

yii rbac/init