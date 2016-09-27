#!/bin/bash

# Normalize.css - Rename .css file to .scss 
command -v cp >/dev/null 2>&1 || { copy src/bower_components/normalize.css/normalize.css src/bower_components/normalize.css/_normalize.scss; exit 0; }

cp src/bower_components/normalize.css/normalize.css src/bower_components/normalize.css/_normalize.scss