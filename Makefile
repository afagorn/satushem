init: dc-down-clear dc-pull dc-build dc-up api-composer-install
rebuild: dc-down dc-build dc-up
up: dc-up
restart: dc-down dc-up
down: dc-down

#docker management
dc-up:
	docker-compose --env-file ./docker/.env.local up -d
dc-down:
	docker-compose --env-file ./docker/.env.local down --remove-orphans
dc-down-clear:
	docker-compose --env-file ./docker/.env.local down -v --remove-orphans
dc-pull:
	docker-compose --env-file ./docker/.env.local pull
dc-logs:
	docker-compose --env-file ./docker/.env.local logs -f
dc-build:
	docker-compose --env-file ./docker/.env.local build

#applications
#backend api
api-composer-install:
	docker-compose --env-file ./docker/.env.local run --rm api-php-cli composer install
api-db-init:
	docker-compose --env-file ./docker/.env.local exec api-mariadb mysql -u satushem -ppassword satushem < backend/api/db/init.sql

#prod build
node-build:
	docker-compose --env-file ./docker/.env.local exec frontend-node npm run-script build-prod

dc-build-prod: dc-build-frontend-nginx dc-build-api-php dc-build-api-php-cli dc-build-api-nginx dc-build-gateway
dc-build-frontend-nginx:
	docker build -t ${REGISTRY}/satushem_frontend-nginx:${IMAGE_TAG} -f ./frontend/docker/production/nginx/Dockerfile --pull ./frontend/
dc-build-api-php:
	docker build -t ${REGISTRY}/satushem_api-php:${IMAGE_TAG} -f ./backend/api/docker/production/php/Dockerfile --pull ./backend/api/
dc-build-api-php-cli:
	docker build -t ${REGISTRY}/satushem_api-php-cli:${IMAGE_TAG} -f ./backend/api/docker/production/php-cli/Dockerfile --pull ./backend/api/
dc-build-api-nginx:
	docker build -t ${REGISTRY}/satushem_api-nginx:${IMAGE_TAG} -f ./backend/api/docker/production/nginx/Dockerfile --pull ./backend/api/
dc-build-gateway:
	docker build -t ${REGISTRY}/satushem_gateway:${IMAGE_TAG} -f ./gateway/docker/production/nginx/Dockerfile --pull ./gateway/

try-dc-build-prod:
	REGISTRY=afagorn IMAGE_TAG=0 make dc-build-prod

#docker images push
dc-push: dc-push-frontend-nginx dc-push-api-php dc-push-api-php-cli dc-push-api-nginx dc-push-gateway
dc-push-frontend-nginx:
	docker push ${REGISTRY}/satushem_frontend-nginx:${IMAGE_TAG}
dc-push-api-php:
	docker push ${REGISTRY}/satushem_api-php:${IMAGE_TAG}
dc-push-api-php-cli:
	docker push ${REGISTRY}/satushem_api-php-cli:${IMAGE_TAG}
dc-push-api-nginx:
	docker push ${REGISTRY}/satushem_api-nginx:${IMAGE_TAG}
dc-push-gateway:
	docker push ${REGISTRY}/satushem_gateway:${IMAGE_TAG}

