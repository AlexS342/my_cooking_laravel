[//]: # (<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>)

[//]: # ()
[//]: # (<p align="center">)

[//]: # (<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>)

[//]: # (<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>)

[//]: # (<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>)

[//]: # (<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>)

[//]: # (</p>)

[//]: # ()
[//]: # (- [Simple, fast routing engine]&#40;https://laravel.com/docs/routing&#41;.)

[//]: # (- [Powerful dependency injection container]&#40;https://laravel.com/docs/container&#41;.)

[//]: # (- Multiple back-ends for [session]&#40;https://laravel.com/docs/session&#41; and [cache]&#40;https://laravel.com/docs/cache&#41; storage.)

[//]: # (- Expressive, intuitive [database ORM]&#40;https://laravel.com/docs/eloquent&#41;.)

[//]: # (- Database agnostic [schema migrations]&#40;https://laravel.com/docs/migrations&#41;.)

[//]: # (- [Robust background job processing]&#40;https://laravel.com/docs/queues&#41;.)

[//]: # (- [Real-time event broadcasting]&#40;https://laravel.com/docs/broadcasting&#41;.)

# My cooking (my_cooking_laravel)

##### Создать новый проект: `composer create-project laravel/laravel example-app`

##### База данных PostgreSQL:
У меня зарание установлен Docker и контейнер PostgreSQL в нем.  
Конфигурация для базы данных написана в файле `docker_compose.yml`
Для запуска базы данных необходимо в терминале ввести команду: `sudo docker compose up -d`
Для остановки контейнера с базой данных можно в терминале ввести команду: `sudo docker compose down`

##### Инициализация git:
- Инициализируем git: `git init`
- Назначаем главную ветку: `git branch -M main`
- Делаем первый коммит: `git commit -m "first commit"`
- Указываем расположение удаленного репозитория: `git remote add origin git@github.com:AlexS342/my_cooking_laravel.git`
- Пушим коммит в удаленный репозиторий: `git push -u origin main`

### Авторизация и аутентификация

##### подключаем Fortify
* установите Fortify с помощью Composer package manager: `composer require laravel/fortify`
* опубликуйте ресурсы Fortify с помощью vendor:publish команды: `php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"`
* перенести вашу базу данных: `php artisan migrate`
* вручную в файле `config/app.php` в массив `providers` добавлен `App\Providers\FortifyServiceProvider::class`
##### Подключаем Laravel Sanctum
    - Sanctum был установлен из коробки. 
    - ниже 3 команды из документации на всякий случай.
    - далее необходимые действия
1. `composer require laravel/sanctum`
2. `php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"`
3. `php artisan migrate`
4. В файле `app/Http/Kernel.php` в массиве `api` нужно раскоментировать класс `\Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class`
5. В файле `config/cors.php` установлено `'supports_credentials' => true,`, это добавит заголовок `Access-Control-Allow-Credentials=true`
6. В файле `app/Http/Kernel.php` в массив `api` нужно добавит `\App\Http\Middleware\EncryptCookies::class` и `\Illuminate\Session\Middleware\StartSession::class`
   + если этого не сделать, то для работы с api нужно выдовать токены или обращатся к роутам в файле `routes/web.php`
   + В реализации аутентификации и авторизации на стороне фронтенда есть важные особенности, для понимания смотри описание в вайле `my_cooking_vue/README.md`

### Регистрация пользователя

+ После установки пакета `Fortify` и реализации Авторизации и аутентификаци ни каких действий не потребовалось
+ Для регистрации пользователя с frontend должен прийти post запрос на web-route `/register`, в теле запроса нужно передать `name`, `email`, `password` и `password_confirmation`.
+ После успешной регистрации пользователя приходит ответ со статусом 201, пользователь автоматически проходит аутентификацию
+ Если регистрация пользователя не удалась, то приходит ответ со статусом 422

# Разворачивание проекта на локальном сервере

* !!! Важно !!!
* Данный проект, `my_cooking_vue`, является frontend частью проекта `My cooking` и расчитан на совместную работу с проектом `my_cooking_laravel`, являющимся backend частью основного проекта, поэтому для нормально работы необходимо запускать оба подпроекта.
* Одновременный запуск двух подпроектов выполняется из двух разных окон терминала. Запуск из одного окна терминала невозможен
* Подпроект `my_cooking_vue` (frontend) запускается на порту 8080 по адресам http://localhost:8080/ и http://192.168.0.100:8080/
* Подпроект `my_cooking_laravel` (backend) запускается на порту 8000 по адресу http://localhost:8000/

### Порядок действий для запуска всего проекта

##### Установленное зарание ПО
* Я писал и запускал проекты в операционной системе Ubuntu в терминалах PHP-storm и все необходимое ПО было установлено зарание при работе с другими проектами
1. Node.js = v16.17.0
2. Composer = v2.2.6 2022-02-04 17:00:38
3. nvm = v0.35.3
4. npm = 8.15.0
5. PHP = v8.1.2 + пакеты: json, libxml, mbstring, mysqli, mysqlnd, openssl, pcntl, pcre, PDO, pdo_mysql, pdo_pgsql, pdo_sqlite, pgsql, Phar, posix, readline, Reflection, session, shmop, SimpleXML, sockets, sodium, SPL, sqlite3, standard, sysvmsg, sysvsem, sysvshm, tokenizer, xdebug, xml, xmlreader, xmlwriter, xsl, Zend OPcache, zip, zlib
6. Docker = v25.0.0 + контейнер postgres:15.4 (скачать контейнер postgeSQl: `docker pull postgres`)

##### Процес запуска
1. Создать папку проекта с удобным для вас названием, например `my_cooking`
2. Скопировать подпроекты c GitHub любым удобным для вас способом и поместить в папку из п.1
    * Проекты публичные и доступны для всех пользователей
    * `my_cooking_vue` (frontend):  https://github.com/AlexS342/my_cooking_vue
    * `my_cooking_laravel` (backend): https://github.com/AlexS342/my_cooking_laravel
    * важно отметить, что для запуска и нормальной работы проекта нет принципиальной разницы в структуре папок, так как подпроекты взаимодействуют через REST API и допускают запуск на двух отдельных хостингах.
3. Запуск backend приложения
    * Все действия выполняются в окне терминала №1
   1. В терминале перейти в корень проекта (`my_cooking_laravel`)
   2. Установить зависимости командой `composer install`
   3. Скопировать файл `.env.example` в файл `.env` командой `cp .env.example .env` и скоректировать глобальные переменные
   4. Скопировать файл `docker-compose.yml.example` в файл `docker-compose.yml` командой `cp docker-compose.yml.example docker-compose.yml` и исправить параметры по себя
   5. Сгенерировать уникальный ключь проекта командой `php artisan key:generate`
   6. Запускаем базу данных командой `sudo docker compose up -d`
   7. Параметры для подключения к базе данных занести в файл `.env`
      * все параметры для конфигурирования базы данных можно посмотреть в файле `docker-compose.yml.example`
        * DB_CONNECTION=pgsql
        * DB_HOST=127.0.0.1
        * DB_PORT=6500
        * DB_DATABASE=cooking
        * DB_USERNAME=user
        * DB_PASSWORD=pass
   8. Запустить миграции командой `php artisan migrate:fresh`
   9. Если необходимо, то запустить посев тестовых данных командой `php artisan db:seed`
   10. Запустить проект на локальном сервере командой `php artisan serve`
      * Проект доступен по ссылке http://127.0.0.1:8000 из вашего браузера, но внем нет реализации `view`
      * При необходимости остановить локальный сервер можно клавишами `Ctrl` + `C`
4. Запуск frontend приложения
    * Все действия выполняются в окне терминала №2
   1. В терминале перейти в корень проекта
   2. Установить зависимости командой `npm install`
   3. Запустить проект на локальном сервере командой `npm run serve`
       * Проект доступен по ссылке http://127.0.0.1:8080 из вашего браузера.
       * При необходимости остановить локальный сервер можно клавишами `Ctrl` + `C`
5. Для полноценной работы проекта необходимо запускать оба подпроекта паралельно
6. При разворацивании проекта на внешнем сервере: 
   * Команду в п.3.10 не выполнять
   * В п.4.3 команду `npm run serve` не выполнять
   * После выполнения п. 4.2 выполнить команду `npm run build`
   * При настройке сервера учесть proxy для api
