_ConsentFriend_ contains some _system settings_ in the `consentfriend`
namespace.

These are available in the MODX system settings panel and in the
[settings](02_Custom_Manager_Page/03_Settings) tab (gear icon) of the
_ConsentFriend_ custom manager page.

Key | Name | Description | Default
----|------|-------------|--------
consentfriend.accept_all | Accept All | If enabled, ConsentFriend will show an "accept all" button in the notice and modal, which will enable all third-party apps if the user clicks on it. If disabled, there will be an "accept" button that will only enable the apps that are enabled in the consent modal. | Yes
consentfriend.cookie_domain | Cookie Domain | You can change the cookie domain for the consent manager itself. Use this if you want to get consent once for multiple matching domains. By default, ConsentFriend will use the current domain. Only relevant if "storageMethod" is set to "cookie". | -
consentfriend.cookie_expires_after_days | Cookie Expiration | Set a custom expiration time in days for the ConsentFriend cookie. Only relevant if "storage_method" is set to "cookie". | 365
consentfriend.cookie_name | Cookie Name | The name of the cookie or localStorage entry that ConsentFriend will use for storing the consent information. | consentfriend
consentfriend.css_url | CSS Url | The CSS Url for ConsentFriend. If it is empty and `consentfriend.js_url` is empty too, `consentfriend.js_url` will be filled with an url of a script containing the default styles. | -
consentfriend.debug | Debug | Log debug information in the MODX error log. | No
consentfriend.default | Default | Defines the default state for services (true=enabled by default). | No
consentfriend.element_id | Element ID | The ID of the DIV element that ConsentFriend will create when starting up. | consentfriend
consentfriend.embedded | Embedded | If enabled, ConsentFriend will will render the modal and notice without the modal background, allowing you to e.g. embed them into a specific element of your website, such as your privacy notice. | No
consentfriend.enable | Enable | Enable ConsentFriend on this installation/context. | No
consentfriend.group_by_purpose | Group by Purpose | If enabled, ConsentFriend will group apps by their purpose in the modal. This is advisable if you have a large number of apps. Users can then enable or disable entire groups of apps instead of having to enable or disable every app. | Yes
consentfriend.hide_decline_all | Hide Decline All | If enabled, ConsentFriend will hide the "decline" button in the consent modal and force the user to open the modal in order to change his/her consent or disable all third-party apps. We strongly advise you to not use this feature, as it opposes the "privacy by default" and "privacy by design" principles of the GDPR (but might be acceptable in other legislations such as under the CCPA). | No
consentfriend.hide_learn_more | Hide Learn More | If enabled, ConsentFriend will hide the "learn more/customize" link in the consent notice. We strongly advise against using this under most circumstances, as it keeps the user from customizing his/her consent choices. | No
consentfriend.hide_powered_by | Hide Powered By | If enabled, ConsentFriend will hide the "Realized with ConsentFriend (Powered by Klaro!)" link in the consent modal. | No
consentfriend.html_texts | HTML Texts | If enabled, ConsentFriend will render the texts given in the `consentModal.description` and `consentNotice.description` translations as HTML. This enables you to e.g. add custom links or interactive content. | -
consentfriend.js_url | Javascript Url | The Javascript Url for ConsentFriend. If it is empty, the javascript is selected by the value of `consentfriend.css_url` or `consentfriend.theme` | -
consentfriend.log_usage | Log Usage | Log session-based usage of accepted and denied services from visitors with an anonymized IP address for later analysis. | No
consentfriend.must_consent | Must Consent | If enabled, ConsentFriend will directly display the consent manager modal and not allow the user to close it before having actively consented or declined the use of third-party applications. | No
consentfriend.no_autoLoad | No Autoload | If enabled, it will keep ConsentFriend from automatically loading itself when the page is being loaded. Available since ConsentFriend 1.2.0. | No
consentfriend.notice_as_modal | Notice as Modal | If enabled, ConsentFriend will show the cookie notice as modal. | No
consentfriend.privacy_policy_id | Privacy Policy ID | The ID of a MODX resource containing the privacy policy. | site_start
consentfriend.storage_method | Storage Method | How ConsentFriend persists consent information in the browser. Specify either "cookie" (the default) or "localStorage". | cookie
consentfriend.theme | Theme | The ConsentFriend [theme](05_Themes.md). Can be changed to "black", "dark", "light", "white". The value of `consentfriend.css_url` is affected by this value. | -
consentfriend.user_agent_filter | User Agent Filter | Comma-separated list of user agent substrings that are not logged. If this value is empty the following entry is used: `Bot, DuckDuckGo, Googlebot, python-requests, petalbot, SiteDash, sogou, Robot` | -
