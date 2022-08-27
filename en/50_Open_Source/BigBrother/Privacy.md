If you install Big Brother from the modmore package provider, technical information from your site may be collected in accordance with the modmore [terms of service](https://modmore.com/tos/) and [privacy policy](https://modmore.com/privacy/).

In addition to that, it's worth noting how the authorization process with your Google account works and affects your privacy.

## Big Brother v3

When authorizing your MODX site with Google, you use an authorization proxy hosted by modmore. This authorization proxy takes care of the redirect steps in the OAuth authentication flow and, once approved, receives access to the `authorization_code`.

The `authorization_code` is a short-lived token (valid for only a few minutes) which can be exchanged for a `refresh_token` exactly once. The `refresh_token` is able of accessing your accounts' Google Analytics data until revoked.

If through the authorization proxy you approve sharing access with your site, the `authorization_code` is submitted to your website, which will then exchange it for a `refresh_token` locally to your site. [This can be confirmed in the open source Big Brother code](https://github.com/modmore/BigBrother/blob/2.x/core/components/bigbrother/controllers/authorize.class.php#L73). Once converted to the `refresh_token` on your site, the resulting tokens to access your sites' analytics data are only ever stored in your own site, and we literally cannot access anything, meaning your privacy is ensured.

In theory, the `authorization_code` may appear in server-level logging on the modmore server. Only in the short window before you accept sharing the `authorization_code` with your site and its expiration could modmore in theory claim a `refresh_token` to access your sites' data. We have no interest in doing so, and if this were to happen, you would receive an error when returning to your site.

If you wish to revoke access to your account, [visit your Google Security Profile](https://myaccount.google.com/permissions), find Big Brother for MODX in the list of _Third-party Apps with account access_, and click on _Remove Access_.

## Big Brother v1 and v2

When authorizing your MODX site with Google, the oauth screen says you're giving access to Mark Hamstra Web Development.

While technically that's true, the resulting tokens and keys that allow access to your sites' analytics data are only ever stored in your own site. Therefore, we literally cannot access your sites analytics data.

If you wish to revoke access to your account, [visit your Google Security Profile](https://myaccount.google.com/permissions), find Big Brother for MODX in the list of _Third-party Apps with account access_, and click on _Remove Access_.
