#!/bin/bash
mysql -u root -e "drop database if exists yii2_notif_test; create database yii2_notif_test default character set utf8 default collate utf8_unicode_ci";

tests/codeception/bin/yii migrate --migrationPath=@yii/rbac/migrations --interactive=0

tests/codeception/bin/yii migrate --interactive=0

tests/codeception/bin/yii rbac/init

mysqldump -u root yii2_notif_test > tests/codeception/_data/dump.sql