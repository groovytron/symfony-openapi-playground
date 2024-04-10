.PHONY:start
start:
	./scripts/start-containers.sh

.PHONY:jumpin
jumpin:
	podman-compose exec app /bin/bash
