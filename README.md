# Описание
Сатушем - движок для создания сайтов совместных покупок. Позволяет организаторам удобно учитывать заказы, выдачи и оплаты
# Работа с проектом
## Системные требования
- Для запуска нужен docker. На windows крайне удобно использовать docker через wsl2. Если сидим на линуксах, то не забываем добавить докер в судоюзер `sudo usermod -aG docker $USER`
- Консольная утилита make `sudo apt-get install build-essential`

## Первый запуск
Превращаем `docker/.env.local.dist` в `docker/.env.local`

Билдим образы
```
make dc-build
```

Создаем контейнеры
```
make dc-up
```

Добавить таблицы в БД
```
docker exec -i satushem_api-mariadb_1 mysql -u satushem -ppassword satushem < backend/api/db/init.sql
```

Перейти на `localhost:8081/install.php`

На `localhost:8080` находится фронт, на `localhost:8081` бек

## Последующее использование
Запуск контейнеров
```
make dc-start
```

## Сборка на прод
В ``frontend/app/src/enviroments/environment.prod.ts`` указываем продевский `apiUrl`, например, `https://api.site.com`

Собрать фронт 
```
make node-build
```

Запушить на docker registry с указанием тега. Например, 
```
REGISTRY=afagorn IMAGE_TAG=master-1 make dc-push
```

## Примечание
Если нужно зачем-то поменять адрес фронта, то:
- Указываем url фронта в файле `frontend/src/environments/environment.ts`. Например, `http://localhost:8080`
- В `backend/api/src/headers.php` в заголовке `Access-Control-Allow-Origin` указать адрес фронта, например, `http://localhost:8080`
