Perform the following actions:

- composer install

- copy /config/db.php.original -> /config/db.php and configure db setting

- yii migrate --migrationPath=@yii/rbac/migrations --interactive=0

- yii migrate --interactive=0

- yii rbac/init  (to assign roles for test users)



