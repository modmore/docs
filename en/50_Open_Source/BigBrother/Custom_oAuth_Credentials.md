If you prefer to use your own credentials to authenticate with Google, here's how to do that.

1. [Login to the Google Cloud API Console](https://console.developers.google.com/)
2. Create a project in the projects dropdown 
3. Add the Google Analytics API to the project
4. Under oAuth permission screen, configure the type of app to either be internal (if only users within your Google organisation will need to authorise) or External (which will require app review from Google beyond 100 users). Also add a name and add the Google Analytics realm to the permissions. 
5. In Credentials, click the button at the top and choose to create a new oAuth Client-ID. 
6. For the Type, choose Desktop App. 
7. Copy the Client ID to the "bigbrother.native_app_client_id" system setting in MODX
8. Copy the Client Secret to the "bigbrother.native_app_client_secret" system setting in MODX

Once you've done this, you can reuse your credentials among different projects. 
