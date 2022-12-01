Commerce has the following requirements to run and/or to enable live mode. When Commerce is installed, the checklist under Configuration will help you make sure all requirements are met.

- MODX 2.7.0 or higher, and all its requirements; 2.8 or 3.0 recommended
- PHP 7.1.5 or higher, 7.4 or 8.0 recommended
  - Starting with Commerce 1.3, the lowest supported version is PHP 7.4
- Website accessible over HTTPS

Payment gateways communicate over a HTTPS connection, as do some other integrations, so your server needs to be capable of opening secure connections. If you're able to download Commerce from the modmore package provider that's a good sign.

- OpenSSL 1.0.1 or higher (or similar compatible extension)
- cURL 7.34.0 or higher
- Valid root certificates configured on the server for HTTPS communication

## MODX Best Practices

We strongly recommend verifying the following in your MODX configuration.

- Latest MODX version (either 2.8 or MODX3)
- Email sending should be set up with an authenticated SMTP email account. Using services like Amazon Simple Email Service, Mandrill, or Mailgun is strongly encouraged.
- Emails sent via MODX should have matching DKIM and SPF set up. Use [Mail Tester](https://www.mail-tester.com/) to verify your emails have a good chance of getting delivered.
- Friendly URLs should be enabled, including `friendly_alias_path`.
- The `core` folder should be locked down to prevent direct access.
