



The Donations extension is free to install from our package provider. It lets you raise funds for specific causes (or projects) on a Commerce-powered webshop.

Each cause/project can have a goal, which is either all-time or monthly/yearly to encourage recurring donations. Donations are tracked per project to show a completion percentage, and you can list donors.

[TOC]

## Setting up Donations

First, download and install the extension from the modmore.com package provider. Navigate to Commerce > Configuration > Modules and enable the Donations module.

### Create a project

You'll now find the causes under Products > Causes (Projects).

Add a cause with a name, description, and make sure to check it as active. Adding a goal is optional but recommended. Add some suggested amounts, separated by a comma.

### Include the project

Where you want the donation box to appear, call the [commerce_donations.cause snippet](cause_snippet) with the &cause property containing the ID of the project. For your first project, that's probably 1:

````html
[[!commerce_donations.cause? &cause=`1`]]
````

There is a default template that will show the project name, description, and a form to add donations.

### Show donors

To show people who donated, and the amount they donated along with their note if any, use the [commerce_donations.donations snippet](donations_snippet).

````html
[[!commerce_donations.donations? &cause=`1`]]
````

Only donations that had the `donor_public` checkbox enabled will be listed.

## Customisation

Templating is done through Twig. There are 3 templates, the defaults of which can be found in `core/components/commerce_donations/templates/donations/cause/`, which you will want to copy into your own templates folder under `/donations/cause/`.

The `active.twig` is used for active projects to accept donations. The `inactive.twig` is used to show an inactive project which will still show the donations and percentage of the goal reached, but will not allow new donations.

The `donations.twig` is used for the list of donations.

Some more information on the templates, including available values, can [be found here](https://github.com/modmore/Commerce_Donations/#showing-the-donation-widget).
