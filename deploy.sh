#!/usr/bin/env bash

# Trick daux.io into thinking there's a zip file it can link to
if [ ! -f modmore-documentation.zip ];
then
    touch modmore-documentation.zip;
fi

# Generate the docs using daux.io
if vendor/bin/daux generate --source=. --destination=html_tmp ; then

    # Remove the empty placeholder file from the generated html folder
    if [ -f html_tmp/modmore-documentation.zip ];
    then
        rm html_tmp/modmore-documentation.zip;
    fi

    # Generate a zip file containing the complete static site, placing it inside the html folder again
    zip -r html_tmp/modmore-documentation.zip html_tmp;

    # Remove the html folder
    rm -rf html/;
    mv html_tmp/ html;
else
    echo "Failed generating documentation";
    exit 1;
fi
