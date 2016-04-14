Perform the following actions

- copy /config/db.php.original -> /config/db.php and configure db setting

- php yii migrate --migrationPath=@yii/rbac/migrations

- php yii migrate

- php yii rbac/init
    to assign role for test users


