#!/usr/bin/env bash

# More info about what does this script do: https://www.tutorialworks.com/podman-rootless-volumes/

mkdir -p vendor var
podman unshare chown 1000:1000 -R vendor var
