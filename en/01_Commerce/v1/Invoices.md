As of Commerce 1.0, you can automatically generate PDF invoices for orders. 

**Note:** These are basically PDF copies of an already-paid order. For the similarly named practice of "sending a customer an invoice asking them to pay it", this document is not the answer.

[TOC]

## Getting Started

There are a few pieces you need to set up before your invoices will work. These are:

- An Invoice Status Change Action that tells Commerce _when_ to create a PDF.
- A PDF Writer that creates the actual PDF file, typically from a template
- An Email Status Change Action that sends the invoice as an attachment.

### Set up the Invoice Status Change Action

The Invoice Status Change Action tells Commerce **when** it should create the invoice. 

This is typically either when the order is paid, or when it was shipped, which is why this is configured in the [status workflow](Statuses).

Go to Commerce > Configuration > Statuses and click on the status change where you want the invoice to be generated. For example, click on _Payment Received_. 

In the new screen, in the menu on **Add Status Change Action**, choose **Create PDF Invoice**. Make sure the _Type_ is set accordingly, and take note of the _Order_. Actions are executed from low-to-high order, and if you want the invoice to be attached to an email, you will need to make sure that the invoice is generated before the email is sent.

### Install & enable a PDF Writer

Now that you told Commerce **when** to create the invoice, you haven't told it **how** yet. For that, you need a PDF Writer.

Commerce does not ship with any writes, so you'll need an [extension](https://www.modmore.com/commerce/extensions/). One option is to use the [PDFCrowd Writer](Modules/PDFCrowdWriter), which requires a subscription/license from [PDFCrowd](https://pdfcrowd.com/); the v2 HTML to PDF API to be exact. Other writers [can be built as well](Developer/PDF_Writer). 

The installation instructions for different writers may vary. For PDFCrowd you need an account and to enter the username and API Key in the module configuration; for others you may need to install additional server software. 

Once you have an invoice action creating invoice records, and a PDF writer to create the actual PDF files, you'll be able of downloading invoices from the back-end by clicking on the invoice references shown in the order details. 

### Set up an Email Status Change Action to attach the invoice

Back in the Status Change where you want to attach the invoice, find the email action you want to attach the invoice to. (Or add an email action.)

At the bottom, you'll find a checkbox for _Attach Invoice_. Check it, and save.

Now when the status change runs, the email action will attach the invoice if the following conditions are met:

- The checkbox is checked
- A PDF writer is available and configured properly
- The invoice was created **before** the email status change; make sure to check the order (low-high). 

If you're not seeing the attachment, check in `core/export/invoices` if the PDF was created. If it wasn't, it's likely an issue with the PDF writer and the MODX error log may hold additional information. 

## Customising the invoice

There's a couple ways you can change the invoice.

- Add/change some basic information through settings
- Change the Twig template
- Change the way the invoice reference is generated

### Add company information [required]

In most jurisdictions you need to include your full company details on the invoice. You can add this, with HTML, in the `commerce.invoice_merchant_address` system setting; the contents of which will be added before the meta data in the top right of the invoice.

### Add a logo

With the `commerce.invoice_logo_url` system setting you can add a logo to the invoice, in the top left. 

### Add text to the footer

Use the `commerce.invoice_footer_text` system setting; supports HTML.

### Change the generated invoice reference

The `commerce.invoice_reference_template` system setting contains an inline twig template that is used to generate the invoice reference. The default is: `INV-{{- increment|str_pad_left(5, '0') -}}`

The primary component is an incrementing number, `{{ increment }}` in the template. The `commerce.invoice_increment_reset_yearly` system setting determines if that number resets at the start of each year or not. 

The invoice reference works the same as the [order reference](Orders/Reference), so check that documentation for more details about what you can set the template to. 