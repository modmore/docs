#!/usr/bin/env bash

daux generate --source=. --destination=html

# Generate a zip file containing the static site
rm html.zip
zip -r html.zip html