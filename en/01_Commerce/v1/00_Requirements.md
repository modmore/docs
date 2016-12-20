Commerce has the following minimum server requirements to run. 

- All requirements to run MODX Revolution 2.5+
- PHP 5.4.4+, version 5.5.x, 5.6.x or 7.x _strongly_ encouraged. 

Payment gateways communicate over a HTTPS connection, as do some other integrations, so your server needs to be capable of opening secure connections. If you're able to download Commerce from the modmore package provider that's a good sign.

- OpenSSL 1.0.1 or higher (or similar compatible extension)
- cURL 7.34.0 or higher
- Valid root certificates configured on the server (especially for PHP 5.5+)

## MODX Requirements

We strongly recommend verifying the following in your MODX configuration.

- Latest MODX version (2.5.0 at the very least)
- Email sending should be set up with an authenticated SMTP email account. Using services like Amazon Simple Email Service, Mandrill, Mailgun is strongly encouraged. 
- Emails sent via MODX should have matching DKIM and SPF set up. Use [Mail Tester](https://www.mail-tester.com/) to verify your emails have a good chance of getting delivered. 
- Friendly URLs should be enabled, including `friendly_alias_path`. 
- The `core` folder should either be moved outside the webroot, or be renamed and locked down to prevent direct access. 

