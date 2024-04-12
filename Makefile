OPEN_API_BUNDLE=src/OpenApiBundle

.PHONY:start
start:
	PODMAN_USERNS=keep-id podman-compose up

.PHONY:swagger-ui
swagger-ui:
	npm run swagger

.PHONY:api
api: ${OPEN_API_BUNDLE}

${OPEN_API_BUNDLE}: doc/api_spec.yaml
	npm run generate-openapi-bundle \
	&& rm -rf ${OPEN_API_BUNDLE}/Tests \
	&& rm -rf ${OPEN_API_BUNDLE}/src \
	&& rm -rf ${OPEN_API_BUNDLE}/.coveralls.yml \
	&& rm -rf ${OPEN_API_BUNDLE}/.gitignore \
	&& rm -rf ${OPEN_API_BUNDLE}/.openapi-generator-ignore \
	&& rm -rf ${OPEN_API_BUNDLE}/.php_cs.dist \
	&& rm -rf ${OPEN_API_BUNDLE}/.travis.yml \
	&& rm -rf ${OPEN_API_BUNDLE}/autoload.php \
	&& rm -rf ${OPEN_API_BUNDLE}/composer.json \
	&& rm -rf ${OPEN_API_BUNDLE}/git_push.sh \
	&& rm -rf ${OPEN_API_BUNDLE}/phpunit.xml.dist \
	&& rm -rf ${OPEN_API_BUNDLE}/pom.xml

.PHONY:clean
clean:
	PODMAN_USERNS=keep-id podman-compose down

.PHONY:jumpin
jumpin:
	PODMAN_USERNS=keep-id podman-compose exec app /bin/bash
