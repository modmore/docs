ConsentFriend installs and uses the following default services:

## Essential Services

### ConsentFriend

| Setting                 | Value                                           |
|-------------------------|-------------------------------------------------|
| Active                  | Yes                                             |
| Default                 | No                                              |
| Required                | Yes                                             |
| Opt Out                 | No                                              |
| Only Once               | No                                              |
| Contextual Consent Only | No                                              |
| Cookies                 | Cookie: consentfriend<br>Path: ''<br>Domain: '' |

### Session

| Setting                 | Value                                       |
|-------------------------|---------------------------------------------|
| Active                  | Yes                                         |
| Default                 | No                                          |
| Required                | Yes                                         |
| Opt Out                 | No                                          |
| Only Once               | No                                          |
| Contextual Consent Only | No                                          |
| Cookies                 | Cookie: PHPSESSID<br>Path: ''<br>Domain: '' |

## Other Services

### Matomo

| Setting                 | Value                                                                                                     |
|-------------------------|-----------------------------------------------------------------------------------------------------------|
| Active                  | No                                                                                                        |  
| Default                 | No                                                                                                        |
| Required                | No                                                                                                        |  
| Opt Out                 | No                                                                                                        |
| Only Once               | Yes                                                                                                       |
| Contextual Consent Only | No                                                                                                        |
| Cookies                 | Cookie: '/^matomo\_.\*$/i'<br>Path: ''<br>Domain: ''<br>Cookie: '/^\_pk\_.\*$/'<br>Path: ''<br>Domain: '' |

This service uses two MODX system or context settings in the default Code. The
settings have to be created by yourself:

| Schlüssel      | Wert                           |
|----------------|--------------------------------|
| matomo_site_id | Site ID in Matomo              |
| matomo_url     | URL of the Matomo installation |  

#### Code

```
    <script type="text/javascript">
        var _paq = window._paq = window._paq || [];
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function() {
            var u="[[++matomo_url]]";
            _paq.push(['setTrackerUrl', u+'matomo.php']);
            _paq.push(['setSiteId', [[++matomo_site_id]] ]);
            var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
            g.type='text/javascript'; g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
        })();
    </script>
    <noscript><p><img src="[[++matomo_url]]matomo.php?idsite=[[++matomo_site_id]]&rec=1" style="border:0" alt="" /></p></noscript>
```

### Google Analytics

| Setting                 | Value                                                                                  |
|-------------------------|----------------------------------------------------------------------------------------|
| Code Section            | HEAD                                                                                   |
| Active                  | No                                                                                     |
| Default                 | No                                                                                     |
| Required                | No                                                                                     |
| Opt Out                 | No                                                                                     |
| Only Once               | Yes                                                                                    |
| Contextual Consent Only | No                                                                                     |
| Cookies                 | Cookie: _ga<br>Path: ''<br>Domain: ''<br>Cookie: '/^_ga.*$/'<br>Path: ''<br>Domain: '' |

This service uses one MODX system or context setting in the default code. The
setting has to be created by yourself:

| Schlüssel           | Wert                |
|---------------------|---------------------|
| google_analytics_id | Google Analytics ID |

#### Code

```
    <script async src="https://www.googletagmanager.com/gtag/js?id=[[++google_analytics_id]]"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
      
        gtag('config', '[[++google_analytics_id]]');
    </script>
```

### Google AdSense

| Setting                 | Value |
|-------------------------|-------|
| Code Section            | BODY  |
| Active                  | No    |
| Default                 | No    |
| Required                | No    |
| Opt Out                 | No    |
| Only Once               | No    |
| Contextual Consent Only | No    |

#### Code

```
    <script data-ad-client="[[++google_ad_client_id]]" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
```

### Google Fonts

| Setting                 | Value |
|-------------------------|-------|
| Code Section            | HEAD  |
| Active                  | No    |
| Default                 | No    |
| Required                | No    |
| Opt Out                 | No    |
| Only Once               | No    |
| Contextual Consent Only | No    |

#### Code

```
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
```

### Cloudflare

| Setting                 | Value                                                                                                                                                                                                                                    |
|-------------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Active                  | No                                                                                                                                                                                                                                       |
| Default                 | No                                                                                                                                                                                                                                       |
| Required                | Yes                                                                                                                                                                                                                                      |
| Opt Out                 | No                                                                                                                                                                                                                                       |
| Only Once               | No                                                                                                                                                                                                                                       |
| Contextual Consent Only | No                                                                                                                                                                                                                                       |
| Cookies                 | Cookie: _cflb<br>Path: ''<br>Domain: ''<br>Cookie: _cf_bm<br>Path: ''<br>Domain: ''<br>Cookie: _cfduid<br>Path: ''<br>Domain: ''<br>Cookie: cf_ob_info<br>Path: ''<br>Domain: ''<br>Cookie: 'cf_use_ob cookie'<br>Path: ''<br>Domain: '' |

### YouTube

| Setting                 | Value                                 |
|-------------------------|---------------------------------------|
| Active                  | No                                    |
| Default                 | No                                    |
| Required                | No                                    |
| Opt Out                 | No                                    |
| Only Once               | No                                    |
| Contextual Consent Only | No                                    |
| Cookies                 | Cookie: abc<br>Path: ''<br>Domain: '' |

### Google reCAPTCHA

| Setting                 | Value                                                                                                                                                                                                                                                        |
|-------------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Active                  | No                                                                                                                                                                                                                                                           |
| Default                 | No                                                                                                                                                                                                                                                           |
| Required                | No                                                                                                                                                                                                                                                           |
| Opt Out                 | No                                                                                                                                                                                                                                                           |
| Only Once               | No                                                                                                                                                                                                                                                           |
| Contextual Consent Only | No                                                                                                                                                                                                                                                           |
| Cookies                 | Cookie: IDE<br>Path: ''<br>Domain: ''<br>Cookie: 1P_JAR<br>Path: ''<br>Domain: ''<br>Cookie: ANID<br>Path: ''<br>Domain: ''<br>Cookie: CONSENT<br>Path: ''<br>Domain: ''<br>Cookie: NID<br>Path: ''<br>Domain: ''<br>Cookie: DVacd<br>Path: ''<br>Domain: '' |

#### Callbacks

##### On Toggle

```
    function(consent, service) {
        var buttons = document.body.querySelectorAll('input[data-name="' + service.name + '"],button[data-name="' + service.name + '"]'), index;
        for (index = 0; index < buttons.length; index++) {
            buttons[index].disabled = !consent;
        }
    }
```

### Facebook Pixel

| Setting                 | Value                                                                                                                                                                                                                                                                                                                                                                                  |
|-------------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Code Section            | BODY                                                                                                                                                                                                                                                                                                                                                                                   |
| Active                  | No                                                                                                                                                                                                                                                                                                                                                                                     |
| Default                 | No                                                                                                                                                                                                                                                                                                                                                                                     |
| Required                | No                                                                                                                                                                                                                                                                                                                                                                                     |
| Opt Out                 | No                                                                                                                                                                                                                                                                                                                                                                                     |
| Only Once               | No                                                                                                                                                                                                                                                                                                                                                                                     |
| Contextual Consent Only | No                                                                                                                                                                                                                                                                                                                                                                                     |
| Cookies                 | Cookie: xs<br>Path: ''<br>Domain: ''<br>Cookie: wd<br>Path: ''<br>Domain: ''<br>Cookie: spin<br>Path: ''<br>Domain: ''<br>Cookie: c_user<br>Path: ''<br>Domain: ''<br>Cookie: locale<br>Path: ''<br>Domain: ''<br>Cookie: datr<br>Path: ''<br>Domain: ''<br>Cookie: fr<br>Path: ''<br>Domain: ''<br>Cookie: presence<br>Path: ''<br>Domain: ''<br>Cookie: sb<br>Path: ''<br>Domain: '' |

#### Code

```
    <script>
        !function(f,b,e,v,n,t,s)
        { if(f.fbq)return;n=f.fbq=function(){ n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments) };
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[ ];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[ 0 ];
        s.parentNode.insertBefore(t,s) }(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '[[++facebook_pixel_id]]');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=[[++facebook_pixel_id]]&ev=PageView&noscript=1"/></noscript>
```

### Google Tag Manager

| Setting                 | Value |
|-------------------------|-------|
| Code Section            | HEAD  |
| Active                  | No    |
| Default                 | No    |
| Required                | No    |
| Opt Out                 | No    |
| Only Once               | No    |
| Contextual Consent Only | No    |

#### Code

```
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','[[++google_tag_manager_id]]');</script>
```

#### Callbacks

#### On Init

```
    function (opts) {
        // initialization code here (will be executed only once per page-load)
        window.dataLayer = window.dataLayer || [];
        window.gtag = function () {
            dataLayer.push(arguments);
        }
        gtag('consent', 'default', {'ad_storage': 'denied', 'analytics_storage': 'denied'});
        gtag('set', 'ads_data_redaction', true);
    }
```

#### On Accept

```
    function (opts) {
        // we notify the tag manager about all services that were accepted. You can define
        // a custom event in GTM to load the service if consent was given.
        for (let k of Object.keys(opts.consents)) {
            if (opts.consents[k]) {
                let eventName = 'consentfriend-' + k + '-accepted';
                dataLayer.push({'event': eventName});
            }
        }
        // if consent for Google Analytics was granted we enable analytics storage
        if (opts.consents['googleAnalytics']) {
            console.log('Google analytics usage was granted!');
            gtag('consent', 'update', {'analytics_storage': 'granted'});
        }
        // if consent for Google Ads was granted we enable ad storage
        if (opts.consents['googleAdSense']) {
            console.log('Google ads usage was granted!');
            gtag('consent', 'update', {'ad_storage': 'granted'});
        }
    }
```

#### On Decline

```
    function (opts) {
        // we notify the tag manager about all services that were declined. You can define
        // a custom event in GTM to unload the service if consent was denied.
        window.dataLayer = window.dataLayer || [];
        window.gtag = function () {
            dataLayer.push(arguments)
        }
        gtag('consent', 'default', {'ad_storage': 'denied', 'analytics_storage': 'denied'})
        gtag('set', 'ads_data_redaction', true)
    }
```

