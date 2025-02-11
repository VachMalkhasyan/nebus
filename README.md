# Тестовое задание: Laravel + PostgreSQL + Docker + Swagger UI

## Описание

Этот проект представляет собой Laravel-приложение, упакованное в Docker-контейнер, с использованием базы данных PostgreSQL и документации API через Swagger UI.

## Запуск проекта

### 1. Клонирование репозитория

```sh
git clone https://github.com/VachMalkhasyan/nebus.git
cd nebus
```

### 2. Настройка базы данных

Перед запуском убедитесь, что в файле `.env` указаны правильные настройки подключения к базе данных. Если необходимо, измените имена баз данных в файлах `docker-compose.yml` в соответствии с вашими требованиями.

### 3. Запуск контейнеров Docker

```sh
docker-compose up -d --build
```

Это поднимет контейнеры с Laravel и PostgreSQL.

### 4. Выполнение начальных команд

```sh
docker exec -it laravel_app bash
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
chmod -R 777 storage bootstrap/cache
exit
```

Эти команды генерируют ключ приложения, выполняют миграции базы данных с начальными данными и создают символьную ссылку для хранения файлов.

## Доступ к API-документации (Swagger UI)

После успешного запуска проекта Swagger UI будет доступен по адресу:

```
http://localhost:8080/api/documentation
```

Здесь можно просматривать доступные API-эндпоинты и тестировать их.

## Остановка контейнеров

```sh
docker-compose down
```
