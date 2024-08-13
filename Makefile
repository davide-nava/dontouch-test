# build development environment
build:
	docker-compose -f docker/docker-compose.yml -p dontouch-test down && \
	docker-compose -f docker/docker-compose.yml -p dontouch-test rm -f && \
	docker-compose -f docker/docker-compose.yml -p dontouch-test build && \
	docker-compose -f docker/docker-compose.yml -p dontouch-test up -d