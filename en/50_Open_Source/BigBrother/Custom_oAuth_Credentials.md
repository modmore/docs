
> **As of February 28th 2022, new oAuth credentials are no longer allowed to use the "out-of-band" oAuth flow** which is used by Big Brother v1 and v2. [Google has decided to deprecate it](https://developers.googleblog.com/2022/02/making-oauth-flows-safer.html) and to remove it entirely on October 3rd, 2022.
>
> New credentials will **not** be able to authorize Google accounts through newly created credentials as outlined below. Only credentials created prior to February 28th, 2022 will work until October 3rd, 2022.
>
> Big Brother 3.0 has been released on August 25th with a new authorization process which will work after that date. However, it is no longer possible to use custom credentials.

## Big Brother v3

Due to the use of an authorization proxy with the new authentication flow, it's not possible to use custom oAuth credentials in v3. If you'd like to sponsor the development of support for custom proxies, get in touch.

## Big Brother v2

If you prefer to use your own credentials to authenticate with Google, here's how to do that.

1. [Login to the Google Cloud API Console](https://console.developers.google.com/)
2. Create a project in the projects dropdown
3. Add the **Google Analytics API**, **Google Analytics Data API**, and **Google Analytics Admin API** to the project
4. Under oAuth permission screen, configure the type of app to either be internal (if only users within your Google organisation will need to authorise) or External (which will require app review from Google beyond 100 users). Also add a name and add the Google Analytics realm to the permissions.
5. In Credentials, click the button at the top and choose to create a new oAuth Client-ID.
6. For the Type, choose Desktop App.
7. Copy the Client ID to the "bigbrother.native_app_client_id" system setting in MODX
8. Copy the Client Secret to the "bigbrother.native_app_client_secret" system setting in MODX

Once you've done this, you can reuse your credentials among different projects.
