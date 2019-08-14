PDF Writers are implemented as standalone services.

At the moment, writers for [mPDF](https://modmore.com/commerce/extensions/mpdf-writer/) and [PDFCrowd](https://modmore.com/commerce/extensions/pdfcrowd-writer/) are available.

Other writers can be added. 

[TOC]

## Using a PDF Writer

When a PDF Writer module has been installed and configured, you can easily get access to it in other extensions with the `getPDFWriter()` method. 

```php
try {
    $writer = $commerce->getPDFWriter();
} catch (\modmore\Commerce\PDF\Exception\PDFException $e) {
    $this->adapter->log(1, get_class($e) . ' generating PDF: ' . $e->getMessage());
}
```

Next, you'll want to set an output file path. 

``` php
$fullPath = MODX_CORE_PATH . 'export/pdf_' . rand(0,9999) . '.pdf'; 
$writer->setOutputFile($fullPath);
```

Check if we have a HTML writer, and if so, set the input HTML:

``` php
if ($writer instanceof FromHtmlWriterInterface) {
    $html = <<<HTML
<h1>Hello world</h1>
HTML;
    $writer->setSourceHtml($html);
}
````

In the future, we'll likely add different writer types, so this check is important. 

To generate the HTML from a twig template, see [Twig and Views](Twig_and_Views).

After setting the input and the output, we can call the render method which will return the PDF binary string (which has also been written to your output file). 

```php
return $writer->render();
```

As any of these methods can throw a `PDFException` which causes the rendering to fail, it's best to wrap the entire thing in a `try {} catch () {}` block, like so:

```php
try {
    $writer = $commerce->getPDFWriter();
    
    $fullPath = MODX_CORE_PATH . 'export/pdf_' . rand(0,9999) . '.pdf'; 
    $writer->setOutputFile($fullPath);
    
    if ($writer instanceof FromHtmlWriterInterface) {
        $html = <<<HTML
    <h1>Hello world</h1>
HTML;
        $writer->setSourceHtml($html);
    }
    
    return $writer->render();
} catch (\modmore\Commerce\PDF\Exception\PDFException $e) {
    $this->adapter->log(1, get_class($e) . ' generating PDF: ' . $e->getMessage());
}
```

And at that point you should have a PDF! :-)

## Building a PDF Writer 

It's possible to create a new PDF writer that can generate PDFs, and make that available for Commerce and extensions to use. 

### Responsibility of a Writer

The `WriterInterface` defines a very narrow scope of responsibility for a PDF Writer:

````php
<?php
interface WriterInterface {
    /**
     * @param array $options
     * @return string
     * @throws modmore\Commerce\PDF\Exception\MissingSourceException
     * @throws modmore\Commerce\PDF\Exception\RenderException
     */
    public function render(array $options = []);

    /**
     * @param string $file
     * @return void
     * @throws modmore\Commerce\PDF\Exception\InvalidOutputException
     */
    public function setOutputFile($file);
}
````

Basically, a method to accept an output file path to write the PDF to, and a method that should write the PDF. Any problem with the render triggers a RenderException or MissingSourceException, and providing an invalid path throws an InvalidOutputException. All of these extend the PDFException, making it easy to intercept any error. 

In addition, the `FromHtmlWriterInterface` adds a method that makes it accept source HTML:

````php
<?php
interface FromHtmlWriterInterface extends WriterInterface {
    /**
     * @param string $html
     * @return void
     */
    public function setSourceHtml($html);
}
````

By splitting up these two interfaces, we're prepared for future code-based PDF generation.

### Example Writer

See the GitHub repositories for [PDFCrowd](https://github.com/modmore/Commerce_PDFCrowdWriter/blob/master/core/components/commerce_pdfcrowdwriter/src/Writer.php) and [mPDF](https://github.com/modmore/Commerce_mPDFWriter/blob/master/core/components/commerce_mpdfwriter/src/Writer.php).

### Registering a custom PDF Writer

To load a custom PDF writer, you need a [functional module](Guides/01_Bootstrapping_a_Module). 

In the module, you'll want to add a listener to the `\Commerce::EVENT_GET_PDF_WRITER` event. The callback receives a `PDFwriter` event on which you can provide an instance of a writer to `$event->addWriter()`. For example:

````php
<?php
class MyModule extends BaseModule
{
    // ...
    
    public function initialize(EventDispatcher $dispatcher)
    {
        $dispatcher->addListener(\Commerce::EVENT_GET_PDF_WRITER, array($this, 'getPDFWriter'));
    }
    
    public function getPDFWriter(PDFWriter $event)
    {
        $instance = new MyWriter();
        $event->addWriter($instance);
    }
}
````

For a more complete example, [see the PDFCrowdWriter Module](https://github.com/modmore/Commerce_PDFCrowdWriter/blob/master/core/components/commerce_pdfcrowdwriter/src/Modules/PDFCrowdWriter.php) as well as the [Bootstrapping a Module guide if you're new to building modules.](Guides/01_Bootstrapping_a_Module)
