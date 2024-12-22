# Slim5 - каркаc приложения

### Установка
- создать директорию под проект
- клонировать репозиторий ```git clone https://github.com/OlegVashkevich/slim5.git .```
- подтянуть зависимости композера ```composer update```
- переименовать ```config\settings.example.php``` в ```settings.php```
- запустить сервер ```php -S localhost:8080 -t public/```

### Зависимости
- Фреймворк - [slim5](https://www.slimframework.com/)
- DI контейнер - [php-di](https://php-di.org/)
- Логировние - [monolog](https://seldaek.github.io/monolog/)
- Json Мапер - [valinor](https://valinor.cuyz.io/)
- Orm, Dbal, Миграции - [doctrine](https://www.doctrine-project.org/)

### Doctrine
консоль ```bin/doctrine```
миграции ```./vendor/bin/doctrine-migrations```