1) Создать папку для сайта. /var/www/kagocel, например
2) cd /var/www/kagocel
2) git init
3) git remote add origin https://github.com/npyatak/kagocel
4) git pull origin master
5) php init (0 - developer)
6) composer update. Только сначала установить composer надо
7) Создать базу данных и прописать ее в конфиге: /common/config/main-local.php
8) php yii migrate
9) php yii fixture/load "*" - для загрузки тестовых данных.

Библиотеки:
imagick