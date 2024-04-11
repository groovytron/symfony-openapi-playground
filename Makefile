.PHONY:start
start:
	PODMAN_USERNS=keep-id podman-compose up

.PHONY:swagger-ui
swagger-ui:
	npm run swagger

.PHONY:clean
clean:
	PODMAN_USERNS=keep-id podman-compose down

.PHONY:jumpin
jumpin:
	PODMAN_USERNS=keep-id podman-compose exec app /bin/bash
