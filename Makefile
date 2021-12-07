dc-build-frontend:
	docker build -f frontend.Dockerfile -t satushem_frontend .
dc-build-backend:
	docker build -f backend.Dockerfile -t satushem_backend .
dc-up:
	docker-compose up -d
dc-start:
	docker-compose start
dc-stop:
	docker-compose stop
dc-logs:
	docker-compose logs -f