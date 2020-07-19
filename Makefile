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
