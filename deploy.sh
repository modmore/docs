#!/usr/bin/env bash

if [ -f .deploy_in_progress ];
then
    echo "Deploy already in progress";
    exit 0;
fi

touch .deploy_in_progress;

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

    rm .deploy_in_progress;
else
    echo "Failed generating documentation";
    rm .deploy_in_progress;
    exit 1;
fi
