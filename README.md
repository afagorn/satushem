Сатушем - движок для создания сайтов совместных покупок. Позволяет организаторам удобно учитывать заказы, выдачи и оплаты

# Docker
## Первый запуск
Указываем url фронта в файле `frontend/src/environments/environment.ts`. Например, `http://localhost:8081`

В `backend/API/src/connect.php` проверяем что `host=api-mariadb`

Билдим образы
``make dc-build``

Проверить, что в ``backend/api/src/headers.php`` в заголовке `Access-Control-Allow-Origin` указан верный адрес фронта, например, `http://localhost:8080`

Создаем контейнеры
``make dc-up``

Добавить таблицы в БД
``docker exec -i satushem_api-mariadb_1 mysql -u satushem -ppassword satushem < backend/api/db/init.sql``

Перейти на `localhost:8081/install.php`

## Последующее использование
Запуск контейнеров
``make dc-start``

На `localhost:8080` находится фронт, на `localhost:8081` бек