#! /usr/bin/env bash

trap './scripts/undo-podman-unshare.sh' INT

./scripts/podman-unshare.sh
podman-compose up
