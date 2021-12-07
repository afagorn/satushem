Сатушем - движок для создания сайтов совместных покупок. Позволяет организаторам удобно учитывать заказы, выдачи и оплаты

# Docker
## Первый запуск
Указываем url фронта в файле `frontend/src/environments/environment.ts`. Например, `http://localhost/api`

В `backend/API/src/connect.php` проверяем что `host=mariadb`

Билдим фронт и бек
``make dc-build-frontend``
``make dc-build-backend``

Создаем контейнеры
``make dc-up``

Добавить таблицы в БД
``docker exec -i <app_name>_mariadb_1 mysql -u satushem -ppassword satusjem < db/init.sql``

Перейти на `localhost/api/install.php`

## Последующее использование
Запуск контейнеров
``make dc-start``

На `localhost:4200` находится фронт, на `localhost/api` бек