---
title: Invoices (UBL/XML)
---

Commerce 1.11+ supports generating EN 16931 compliant UBL (Universal Business Language) XML invoices alongside traditional PDF invoices. This feature enables automated invoice processing, e-invoicing compliance, and seamless integration with accounting systems and e-invoicing networks.

> At the time of writing, Commerce 1.11 is in private development preview. Contact support if you're interested in trying it out before the release.

The UBL/XML invoices are an extension of the [PDF invoices](Invoices), so you must have those configured first.

> While the generated XML files are compliant with EN 16931, there is not currently an integrated access point for automatically uploading them to e-invoicing networks like PEPPOL. However, this could be built on top of the generated invoice XMLs.

## What is UBL?

UBL (Universal Business Language) is an open standard for electronic business documents, particularly invoices. It's an XML-based format that provides a standardized way to exchange invoice data between different systems.

EN 16931 is the European standard for electronic invoicing in public procurement. Commerce generates UBL invoices that comply with this standard, making them suitable for:

- **E-invoicing networks**: Such as PEPPOL (Pan-European Public Procurement Online)
- **Automated processing**: Accounting systems can automatically import and process invoices
- **Legal compliance**: Meets European e-invoicing requirements
- **B2B integration**: Seamless exchange with business partners' systems

## Configuration

UBL invoices are generated in the same way as traditional PDF invoices, so make sure you have those [configured properly before starting with UBL invoices](Invoices).

UBL invoice generation can be enabled and configured through Commerce system settings. Navigate to **System Settings** → **Commerce** → **Invoices** section.

### Required Settings

1. **Enable UBL Invoice Generation** (`commerce.invoice_ubl_enabled`)
    - Set to `Yes` to enable UBL invoice generation
    - When enabled, UBL XML files will be generated alongside PDF invoices

2. **Company Name** (`commerce.invoice_ubl_company_name`)
    - The legal name of your company
    - Appears as PartyName and RegistrationName in the supplier party
    - Example: `Acme Corporation Ltd`

3. **Company ID** (`commerce.invoice_ubl_company_id`) + **Endpoint scheme** (`commerce.invoice_ubl_company_id_scheme`)
    - Your company registration or identification number (e.g. chamber of commerce number)
    - Used as `cbc:EndpointID` on the supplier party and as `cbc:CompanyID` in PartyLegalEntity
    - Example ID: `12345678`
    - The scheme is the type of ID from the [PEPPOL EAS code list](https://docs.peppol.eu/poacc/billing/3.0/codelist/eas/) (default: `0192`)

4. **PartyLegalEntity scheme** (`commerce.invoice_ubl_party_company_scheme`)
    - Scheme for `cbc:CompanyID` under PartyLegalEntity (default: `0151`)
    - See the [ISO 6523 ICD list](https://docs.peppol.eu/poacc/billing/3.0/codelist/ICD/)

5. **Tax/VAT ID** (`commerce.invoice_ubl_tax_id`)
    - Your tax or VAT identification number
    - Appears as `cbc:CompanyID` in PartyTaxScheme
    - Example: `NL123456789B01`

6. **Company address** (structured fields)
    - Supplier postal address is built from separate settings (not a free-text block):
    - **Street** (`commerce.invoice_ubl_company_street`) → `cbc:StreetName`
    - **Address line 2** (`commerce.invoice_ubl_company_address_line2`, optional) → `cbc:AdditionalStreetName` (e.g. suite or unit)
    - **Postal code** (`commerce.invoice_ubl_company_postal_code`) → `cbc:PostalZone`
    - **City** (`commerce.invoice_ubl_company_city`) → `cbc:CityName`
    - **Country** (`commerce.invoice_ubl_company_country`) → `cbc:IdentificationCode` (ISO 3166-1 alpha-2, e.g. `NL`)

   Example for a Dutch supplier:

   | Setting        | Value                            |
   |----------------|----------------------------------|
   | Street         | `Hoofdstraat 1`                  |
   | Address line 2 | *(leave empty or e.g. `Unit 5`)* |
   | Postal code    | `1234 AB`                        |
   | City           | `Amsterdam`                      |
   | Country        | `NL`                             |

   Dutch postcodes entered as `1234AB` are normalized to `1234 AB` in the XML.

7. **Contact Person** (`commerce.invoice_ubl_contact_person`, optional)
    - Contact name in the supplier party
    - Example: `John Doe`

### Payment settings (required for Dutch suppliers)

When **Company Country** is `NL` and the invoice has an amount due, Dutch Peppol rules require payment instructions in the XML.

8. **Payment IBAN** (`commerce.invoice_ubl_payment_iban`)
    - Bank account IBAN for `cac:PaymentMeans` / `cac:PayeeFinancialAccount`
    - Required for [NL-R-007](https://docs.peppol.eu/poacc/billing/3.0/rules/ubl-peppol/NL-R-007/) validation
    - Example: `NL91ABNA0417164300` (spaces are stripped)

9. **Payment means code** (`commerce.invoice_ubl_payment_means_code`, optional)
    - UNCL4461 code (default: `30` = credit transfer)
    - For the Netherlands, [NL-R-008](https://docs.peppol.eu/poacc/billing/3.0/rules/ubl-peppol/NL-R-008/) allows: `30`, `48`, `49`, `57`, `58`, `59`

10. **Payment BIC** (`commerce.invoice_ubl_payment_bic`, optional)
    - BIC/SWIFT for the payment account

### Advanced settings

These settings are not created by default. Add them in system settings only if you need to override the defaults and know what you're doing.

11. **Customization ID** (`commerce.invoice_ubl_customization_id`)
    - Default: `urn:cen.eu:en16931:2017#compliant#urn:fdc:peppol.eu:2017:poacc:billing:3.0`

12. **Profile ID** (`commerce.invoice_ubl_profile_id`)
    - Default: `urn:fdc:peppol.eu:2017:poacc:billing:01:1.0`

## How It Works

### Invoice Generation

When UBL invoicing is enabled:

1. **Invoice Creation**: When an invoice is created (typically through a status change action), Commerce generates both:
    - A PDF invoice (as before)
    - A UBL XML invoice (new)

2. **File Storage**: Both files are stored in the same directory structure:
    - Location: `core/export/invoices/YYYY/`
    - PDF: `INV-001-abc123.pdf`
    - UBL: `INV-001-abc123.xml`

3. **Email Attachments**: When invoices are attached to order emails:
    - Both PDF and XML files are attached (when UBL is enabled)
    - PDF for human-readable viewing
    - XML for automated processing

### UBL Invoice Structure

The generated UBL invoices include:

- **Invoice header**: CustomizationID, ProfileID, invoice number, issue date, type code (`380`), currency, buyer reference (order reference)
- **Supplier party**: EndpointID, name, structured postal address, VAT ID, legal entity, optional contact
- **Customer party**: EndpointID (VAT number, or email, or order reference), name, postal address, optional VAT ID, legal entity
- **Payment means** (Dutch suppliers, when amount due): PaymentMeansCode, IBAN, optional BIC, payment reference
- **Payment terms**: Note when amount due (BR-CO-25)
- **Document-level charges**: Shipping and transaction fees as AllowanceCharge where applicable
- **Tax totals**: Per-rate subtotals with VAT category codes
- **Monetary totals**: Line extension, tax exclusive/inclusive, charges, payable amount
- **Invoice lines**: Quantity, amounts, item name/description/SKU, unit price, classified tax category per line

Element order follows UBL 2.1 and PEPPOL BIS Billing 3.0 (e.g. TaxTotal and LegalMonetaryTotal before InvoiceLine).

### Customer and order data

- **Buyer reference** (`cbc:BuyerReference`): Set from the order reference
- **Customer EndpointID**: VAT number (scheme `9930`) when present; otherwise email or order reference
- Customer address comes from the order billing address (structured fields where available)

## Tax handling

Tax data is taken from Commerce order totals and line-level tax rows.

### VAT category codes (UNCL5305)

Commerce maps tax rates to Peppol VAT categories:

| Situation | Category | Notes |
|-----------|----------|--------|
| Standard rate (> 0%) | `S` | Default for taxed amounts |
| Zero rate (0%, not reverse charge) | `Z` | Including zero-tax invoices (one TaxSubtotal is still emitted) |
| EU VAT reverse charge | `AE` | When the tax rate key is `EU-REVERSE-CHARGE` (EU VAT module); includes `VATEX-EU-AE` exemption code |

Reverse charge applies when the EU VAT rate provider is configured with reverse charge and the customer has a validated VAT registration on the billing address (via the EU VAT address validation module).

### Amounts and shipping

- Amounts are formatted as decimals (Commerce stores values in cents internally)
- Document-level shipping uses the shipment’s tax rate for AllowanceCharge tax category
- Transaction fees are included as charges with category `Z` (not taxed in Commerce)
- Tax subtotal taxable amounts include line amounts and taxed shipping per Commerce `getTaxTotals()`

## Customer Access

Customers can access UBL invoices in two ways:

### 1. Email Attachments

When an invoice email is sent with attachments enabled:
- Both PDF and XML files are attached
- Customers receive both formats automatically

### 2. Account Section

Customers can download UBL invoices from their account section set up with the get_order and get_orders snippets. If you previously customised the templates, you may need to update those to add the XML/UBL download link.

### Download URLs

UBL invoices can be downloaded using the same URL structure as PDF invoices, with an additional parameter:

```
[[~order_resource]]?order=123&downloadInvoice=456&downloadType=ubl
```

- `order`: The order ID
- `downloadInvoice`: The invoice ID
- `downloadType`: Set to `ubl` for XML, or omit for PDF (default)

## Technical Details

### UBL Version

Commerce generates **UBL 2.1** invoices aligned with **EN 16931** and **PEPPOL BIS Billing 3.0** (via default CustomizationID and ProfileID).

### XML Structure

The UBL invoices use the following namespaces:

- `urn:oasis:names:specification:ubl:schema:xsd:Invoice-2` (root)
- `urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2` (cac)
- `urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2` (cbc)

### Currency Support

- Supports all currencies configured in Commerce
- Currency code is included in `cbc:DocumentCurrencyCode`
- Monetary amounts include the `currencyID` attribute

## Troubleshooting

### UBL Invoices Not Generated

1. **Check Settings**: Ensure `commerce.invoice_ubl_enabled` is set to `Yes`
2. **Verify configuration**: Company name, ID, tax ID, street, city, postal code, and country should be filled in
3. **Check permissions**: Ensure the web server can write to `core/export/invoices/`
4. **Review logs**: Check Commerce error logs for generation errors

### Missing or Invalid Company Address (NL-R-002)

- Fill in **all** structured address fields: street, city, postal code, and country
- For Netherlands: use a valid postcode (e.g. `1234 AB`) and city name in the correct settings—not in the optional address line 2 field
- Address line 2 is only for extras such as suite or unit (`AdditionalStreetName`)

### Missing Payment Means (NL-R-007)

- Set **Company Country** to `NL`
- Configure **Payment IBAN**
- Ensure the invoice has a payable amount greater than zero

### XML Validation Errors

- [Validate with the EU Invoice Test Bed](https://www.itb.ec.europa.eu/invoice/upload)
- Use the default Customization ID and Profile ID unless you have specific requirements
- Confirm tax rates and EU VAT reverse charge behaviour match your shop configuration
- For reverse-charge B2B invoices, ensure the EU VAT validator has marked the billing address as valid

If you cannot resolve a validation error, send the XML to our support team.

## Best Practices

1. **Complete configuration**: Fill in supplier name, ID, VAT ID, full structured address, and (for NL) IBAN before enabling UBL
2. **Test first**: Generate a test invoice and validate the XML before going live
3. **Inform customers**: Let customers know they may receive both PDF and XML formats
4. **Keep settings updated**: Update company and payment details when your business details change
5. **Regular validation**: Periodically validate generated UBL invoices, especially after tax or address configuration changes

## Integration with E-invoicing Networks

To use UBL invoices with e-invoicing networks like PEPPOL:

1. **Generate UBL invoices**: Enable UBL and complete configuration (including NL payment fields if applicable)
2. **Access Point**: Use a PEPPOL Access Point provider
3. **Upload XML**: Submit the generated UBL XML files to your Access Point
4. **Network delivery**: The Access Point handles delivery to recipients

The UBL invoices generated by Commerce are compatible with PEPPOL BIS Billing 3.0.

Commerce does **not** currently integrate with an access point to automate upload and delivery; that would require a separate module or external process.

## Related Documentation

- [Commerce Invoice Documentation](https://docs.modmore.com/en/Commerce/v1/Invoices/)
- [EN 16931 Compliance](https://ec.europa.eu/digital-building-blocks/sites/spaces/DIGITAL/pages/467108950/EN+16931+compliance)
- [UBL 2.1 Specification](http://docs.oasis-open.org/ubl/os-UBL-2.1/)
- [PEPPOL BIS Billing 3.0](https://docs.peppol.eu/poacc/billing/3.0/)
- [PEPPOL EAS code list](https://docs.peppol.eu/poacc/billing/3.0/codelist/eas/)
