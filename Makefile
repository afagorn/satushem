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
