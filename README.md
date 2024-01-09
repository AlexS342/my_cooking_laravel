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


