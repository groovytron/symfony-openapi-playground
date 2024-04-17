#! /usr/bin/env bash

bin/console doctrine:migration:migrate
bin/console app:create-user admin secret
