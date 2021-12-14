dc-up:
	docker-compose --env-file ./docker/.env.local up -d
dc-restart: dc-down dc-up
dc-start:
	docker-compose --env-file ./docker/.env.local start
dc-stop:
	docker-compose --env-file ./docker/.env.local stop
dc-down:
	docker-compose --env-file ./docker/.env.local down --remove-orphans
dc-down-clear:
	docker-compose --env-file ./docker/.env.local down -v --remove-orphans

dc-logs:
	docker-compose --env-file ./docker/.env.local logs -f

dc-build:
	docker-compose --env-file ./docker/.env.local build

node-build:
	docker-compose --env-file ./docker/.env.local exec frontend-node npm run-script build-prod

#prod build
dc-build-prod: dc-build-frontend-nginx dc-build-api-php dc-build-api-nginx dc-build-gateway
dc-build-frontend-nginx:
	docker build -t ${REGISTRY}/satushem_frontend-nginx:${IMAGE_TAG} -f ./frontend/docker/production/nginx/Dockerfile --pull ./frontend/
dc-build-api-php:
	docker build -t ${REGISTRY}/satushem_api-php:${IMAGE_TAG} -f ./backend/api/docker/production/php/Dockerfile --pull ./backend/api/
dc-build-api-nginx:
	docker build -t ${REGISTRY}/satushem_api-nginx:${IMAGE_TAG} -f ./backend/api/docker/production/nginx/Dockerfile --pull ./backend/api/
dc-build-gateway:
	docker build -t ${REGISTRY}/satushem_gateway:${IMAGE_TAG} -f ./gateway/docker/production/nginx/Dockerfile --pull ./gateway/

try-dc-build-prod:
	REGISTRY=afagorn IMAGE_TAG=0 make dc-build-prod

#images push
dc-push: dc-push-frontend-nginx dc-push-api-php dc-push-api-nginx dc-push-gateway
dc-push-frontend-nginx:
	docker push ${REGISTRY}/satushem_frontend-nginx:${IMAGE_TAG}
dc-push-api-php:
	docker push ${REGISTRY}/satushem_api-php:${IMAGE_TAG}
dc-push-api-nginx:
	docker push ${REGISTRY}/satushem_api-nginx:${IMAGE_TAG}
dc-push-gateway:
	docker push ${REGISTRY}/satushem_gateway:${IMAGE_TAG}