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

2. **Company ID** (`commerce.invoice_ubl_company_id`)
- Your company registration or identification number
- This appears in the UBL invoice as the CompanyID in the PartyLegalEntity section
- Example: `12345678`

3. **Tax/VAT ID** (`commerce.invoice_ubl_tax_id`)
- Your tax or VAT identification number
- This appears in the UBL invoice as the CompanyID in the PartyTaxScheme section
- Example: `BE123456789`

4. **Company Country** (`commerce.invoice_ubl_company_country`)
- Your company's country code (ISO 3166-1 alpha-2)
- Example: `NL` for Netherlands

5. **Company Address** (`commerce.invoice_ubl_company_address`)
- Your company's full address
- Enter each line separated by a newline (press Enter for each line)
- Example:
```
123 Business Street
Business City
```

6. **Company Name** (`commerce.invoice_ubl_company_name`)
- The legal name of your company
- This appears as the PartyName and RegistrationName in the UBL invoice
- Example: `Acme Corporation Ltd`

7. **Company Address** (`commerce.invoice_ubl_company_address`)
- Your company's full address
- Enter each line separated by a newline (press Enter for each line)
- Example:
```
123 Business Street
Business City
```

8. **Contact Person** (`commerce.invoice_ubl_contact_person`)
- The name of the contact person for your company
- This appears as the Contact Name in the supplier party section
- Example: `John Doe`

### Advanced Settings

These settings are not created by default as they will not need to be changed often. If you create them in the system settings however, you can override these values.

9. **Customization ID** (`commerce.invoice_ubl_customization_id`)
- The UBL CustomizationID that identifies the customization of the UBL invoice
- Default: `urn:cen.eu:en16931:2017#compliant#urn:fdc:peppol.eu:2017:poacc:billing:3.0`
- Only change this if you need a different customization profile

10. **Profile ID** (`commerce.invoice_ubl_profile_id`)
- The UBL ProfileID that identifies the profile of the UBL invoice
- Default: `urn:fdc:peppol.eu:2017:poacc:billing:01:1.0`
- Only change this if you need a different profile

## How It Works

UBL invoices are generated in the same way as traditional PDF invoices, so make sure you have those [configured properly before starting with UBL invoices](Invoices).

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

- **Invoice Header**: Invoice number, issue date, invoice type, currency
- **Supplier Information**: Your company details (name, address, tax ID, company ID)
- **Customer Information**: Customer name and address from the order
- **Invoice Lines**: Each order item with:
- Product name and description
- SKU
- Quantity
- Unit price
- Line totals
- Tax information
- **Tax Totals**: Summary of all taxes applied
- **Charges**: for shipping and transaction fees
- **Monetary Totals**: Line totals, tax totals, and grand total

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

Commerce generates **UBL 2.1** invoices compliant with **EN 16931**.

### XML Structure

The UBL invoices use the following namespaces:
- `urn:oasis:names:specification:ubl:schema:xsd:Invoice-2` (root)
- `urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2` (cac)
- `urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2` (cbc)

### Tax Handling

- Tax rates are extracted from Commerce's tax system
- Multiple tax rates are supported
- Tax amounts are properly formatted (Commerce stores amounts in cents, UBL uses decimal format)
- Tax categories default to "S" (Standard rate) as per UNCL5305

### Currency Support

- Supports all currencies configured in Commerce
- Currency code is included in the DocumentCurrencyCode element
- All monetary amounts include the currencyID attribute

## Troubleshooting

### UBL Invoices Not Generated

1. **Check Settings**: Ensure `commerce.invoice_ubl_enabled` is set to `Yes`
2. **Verify Configuration**: All required fields (company ID, tax ID, company name, address) must be filled in
3. **Check Permissions**: Ensure the web server can write to `core/export/invoices/` directory
4. **Review Logs**: Check Commerce error logs for any generation errors

### Missing Company Information

If UBL invoices are generated but missing company information:
- Verify all company settings are configured in System Settings
- Company address should use newlines to separate address lines
- Ensure company name and tax ID are correctly entered

### XML Validation Errors

If customers report XML validation errors:
- [Use the Interopability Test Bed's validation service](https://www.itb.ec.europa.eu/invoice/upload) to check for errors.
- Ensure you're using the default Customization ID and Profile ID (unless you have specific requirements)
- Verify that all required fields are populated in the system settings
- Check that tax rates are properly configured in Commerce

If you can't figure out why an invoice is invalid, please send it to our support team for further investigation.

## Best Practices

1. **Complete Configuration**: Fill in all required company information before enabling UBL generation
2. **Test First**: Generate a test invoice and validate the XML before going live
3. **Inform Customers**: Let customers know they'll receive both PDF and XML formats
4. **Keep Settings Updated**: Update company information if your business details change
5. **Regular Validation**: Periodically validate generated UBL invoices to ensure compliance

## Integration with E-invoicing Networks

To use UBL invoices with e-invoicing networks like PEPPOL:

1. **Generate UBL Invoices**: Ensure UBL generation is enabled and configured
2. **Access Point**: You'll need a PEPPOL Access Point provider
3. **Upload XML**: Submit the generated UBL XML files to your Access Point
4. **Network Delivery**: The Access Point handles delivery to recipients

The UBL invoices generated by Commerce are compatible with PEPPOL BIS Billing 3.0, making them ready for PEPPOL network submission.

However, at the moment Commerce does **not** have any access point providers integrated to automate that process. That would require a separate module.

## Related Documentation

- [Commerce Invoice Documentation](https://docs.modmore.com/en/Commerce/v1/Invoices/)
- [EN 16931 Compliance](https://ec.europa.eu/digital-building-blocks/sites/spaces/DIGITAL/pages/467108950/EN+16931+compliance)
- [UBL 2.1 Specification](http://docs.oasis-open.org/ubl/os-UBL-2.1/)
- [PEPPOL Documentation](https://peppol.org/)

