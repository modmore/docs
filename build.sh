#!/usr/bin/env bash

# Trick daux.io into thinking there's a zip file it can link to
if [ ! -f modmore-documentation.zip ];
then
    touch modmore-documentation.zip;
fi

# Generate the docs using daux.io
vendor/bin/daux generate --source=. --destination=html

# Remove the empty placeholder file from the generated html folder
if [ -f html/modmore-documentation.zip ];
then
    rm html/modmore-documentation.zip;
fi

# Generate a zip file containing the complete static site, placing it inside the html folder again
zip -r html/modmore-documentation.zip html