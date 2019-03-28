PDF Writers are implemented as standalone services.

At the moment, one is available: [PDFCrowd Writer](https://github.com/modmore/Commerce_PDFCrowdWriter), which uses the PDFCrowd service to generate PDFs from HTML.

Other writers can be added. 

[TOC]


## Responsibility of a Writer

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

## Example Writer

The [PDFCrowd Writer is a decent example](https://github.com/modmore/Commerce_PDFCrowdWriter/blob/master/core/components/commerce_pdfcrowdwriter/src/Writer.php).

## Loading a custom PDF Writer

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
