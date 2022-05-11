If you prefer to use your own credentials to authenticate with Google, here's how to do that.

> **NOTE: As of February 28th 2022, new oAuth credentials are no longer allowed to use the "out of band" oAuth flow**, used by Big Brother. [Google has decided to deprecate it](https://developers.googleblog.com/2022/02/making-oauth-flows-safer.html). The credentials included in Big Brother by default still work until October 2022, and we expect to provide an update by then, but the below process will **no longer work for new credentials!** [See this issue on GitHub for updates](https://github.com/modmore/BigBrother/issues/112)
> 
> If you want to use custom credentials created prior to February 28th 2022, those should still work for now, too.
> 
> Due to the additional requirements for non-OOB oAuth flows, we may not be able to provide support for custom credentials in the future.

1. [Login to the Google Cloud API Console](https://console.developers.google.com/)
2. Create a project in the projects dropdown 
3. Add the **Google Analytics API** and **Google Analytics Admin API** to the project
4. Under oAuth permission screen, configure the type of app to either be internal (if only users within your Google organisation will need to authorise) or External (which will require app review from Google beyond 100 users). Also add a name and add the Google Analytics realm to the permissions. 
5. In Credentials, click the button at the top and choose to create a new oAuth Client-ID. 
6. For the Type, choose Desktop App. 
7. Copy the Client ID to the "bigbrother.native_app_client_id" system setting in MODX
8. Copy the Client Secret to the "bigbrother.native_app_client_secret" system setting in MODX

Once you've done this, you can reuse your credentials among different projects. 
