To install the extras from modmore you need to configure a new Package Provider in your MODX installation. This will allow you to download, install and update our extras from within MODX.

For our Premium Extras you will first need to purchase a license, or a [development domain to use a free development license](https://www.modmore.com/free-development-licenses/).


[TOC]

## Step 1: Create an API Key

To connect with our Package Provider, you first need to create an API Key. This is done on our website under [Account &raquo; API Keys](https://www.modmore.com/account/api-keys/). 

API Keys act as a username and password for the webservices, and is connected to your account. 

It's recommended (but not required) to create one API key per project or client. This way you can easily invalidate an API Key for that specific project or client only should that be needed. 

To create the API Key click the _Add API Key_ button to expose the form, and fill in the input fields. If you leave them empty something random will be generated. Click _Create API Key_ to register the key in our system. 

When the page reloads you will see a bookmarklet button and a manual setup section providing the details you entered or which were randomly generated. **This is the last time you are shown the API Key in clear text.**

To use the _bookmarklet_, drag the button into your bookmarks bar at the top of the browser, or into a bookmarks tab or menu item. Then open your MODX manager on the Extras > Installer page, and from your bookmarks bar/tab/menu click the bookmarklet to run it. Unless you get any errors, you can now browse our provider. 

For the _manual setup_, go to Extras > Installer and on the _Providers_ tab click the _Add New Provider_ button. In the modal that pops up enter a descriptive name ("modmore"), and the API Key information provided. 

**Note:** Make sure that the Service Url ends with a slash (`https://rest.modmore.com/`) and that there are no spaces before or after any of the values.

Hit Save.

## Step 2: Browse the Package Provider

To browse and download our extras, click on the small arrow on the _Download Extras_ button (back on the Packages tab). Choose _Select a Provider_ and in the modal choose your modmore.com provider in the list and submit. 

At this point you should see the start screen of the provider, with a list of most popular and latest updated extras from our provider. You can click one of the extras on that screen to search for it, or you can use the left hand tree view to browse by category. 

If you're on a domain that's eligible for a [free development license](https://www.modmore.com/free-development-licenses/), our premium extras will say "Free to try on development" in the name and a download will not require or deduct any available licenses. 

## Step 3: Download & Install

Just like the MODX.com provider, you hit download and then return to the list of packages to install our extras. 

Some extras may have specific requirements or additional installation instructions. These will be documented in a getting started or installation document for each individual extra. 





