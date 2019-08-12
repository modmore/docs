---
title: "PDF Writer: mPDF"
---

The [mPDF PDF Writer module is a separate extension](https://modmore.com/commerce/extensions/mpdf-writer/), free to install, that allows you to generate PDFs using mPDF library. 

You need a PDF writer for [generating invoices](../Invoices).

[TOC]

## Install the Extension

Using the modmore package provider, download the _mPDFWriter for Commerce_ package. It's available for free. Install it.

Once installed, go to Commerce > Configuration > Modules and find "PDF Writer: mPDF" in the list (tip: search for pdf).

Click on its name, and enable it for test/live mode. mPDF does not require any additional configuration.

## Adding additional fonts

To keep the package relatively small, the mPDF package does not include all possible fonts. By default only variations of DejaVu and FreeMono, FreeSans, and FreeSerif are included. 

To add additional fonts, you can download [ttf font files from the official mpdf repository](https://github.com/mpdf/mpdf/tree/development/ttfonts) and upload them into `core/components/commerce_mpdfwriter/vendor/mpdf/mpdf/ttfonts/`
