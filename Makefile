# Install the app
install: docker-down-clear docker-pull docker-build docker-up

# Alias to start up the app
up: docker-up

# Alias to shut down the app
down: docker-down

# Restart the app
restart: down up

# Start up the app
docker-up:
	docker-compose up --detach

# Shut down the app
docker-down:
	docker-compose down --remove-orphans

# Pull docker containers
docker-pull:
	docker-compose pull

# Build docker containers
docker-build:
	docker-compose build

# Shut down the app and remove all volumes
docker-down-clear:
	docker-compose down --volumes --remove-orphans

# Build all services for production
build: build-gateway build-frontend build-api

# Build the gateway service
build-gateway:
	docker --log-level=debug build --pull --file=gateway/docker/production/nginx/Dockerfile --tag=${REGISTRY}/auction-gateway:${IMAGE_TAG} gateway/docker/production/nginx

# Build the front-end service
build-frontend:
	docker --log-level=debug build --pull --file=frontend/docker/production/nginx/Dockerfile --tag=${REGISTRY}/auction-frontend:${IMAGE_TAG} frontend

# Build the API service
build-api:
	docker --log-level=debug build --pull --file=api/docker/production/php-fpm/Dockerfile --tag=${REGISTRY}/auction-api-php-fpm:${IMAGE_TAG} api
	docker --log-level=debug build --pull --file=api/docker/production/nginx/Dockerfile --tag=${REGISTRY}/auction-api:${IMAGE_TAG} api

# Check the build process
try-build:
	REGISTRY=localhost IMAGE_TAG=0 make build

