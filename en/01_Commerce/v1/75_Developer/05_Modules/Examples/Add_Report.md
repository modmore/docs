A module like the following will add a report to the reports section of the merchant dashboard.

```` php
<?php

namespace modmore\Commerce\Modules\Reports;

use modmore\Commerce\Events\Reports;
use modmore\Commerce\Modules\BaseModule;
use modmore\Commerce\Reports\ReportInterface;
use modmore\Commerce\Dispatcher\EventDispatcher;
// For modules that need to support 1.2 or before, replace with:
// use Symfony\Component\EventDispatcher\EventDispatcher;
// Please note that is DEPRECATED and will be REMOVED in 2.0

class Products extends BaseModule
{
    public function getName()
    {
        return 'Products Report';
    }

    public function getAuthor()
    {
        return 'Mark Hamstra';
    }

    public function getDescription()
    {
        return 'Adds a report. ';
    }

    public function initialize(EventDispatcher $dispatcher)
    {
        $dispatcher->addListener(\Commerce::EVENT_DASHBOARD_REPORTS_GET_REPORTS, [$this, 'addReport']);
    }

    public function addReport(Reports $event)
    {
        $event->addReport(new \modmore\Commerce\Reports\Products($this->commerce));
    }
}
````

Here's an example of a (already included) basic report meant to extract product records:

```` php
<?php

namespace modmore\Commerce\Reports;

use modmore\Commerce\Reports\Charts\BaseChart;
use modmore\Commerce\Reports\Data\Header;
use modmore\Commerce\Reports\Data\Row;

class Products extends BaseReport
{

    public function getName()
    {
        return $this->adapter->lexicon('commerce.report.products');
    }

    public function getDescription()
    {
        return $this->adapter->lexicon('commerce.report.products.description');
    }

    public function getGroup()
    {
        return 'products';
    }

    public function getOptions()
    {
        return [];
    }

    public function getDataHeaders()
    {
        $headers = [];

        $headers[] = new Header('id', $this->adapter->lexicon('commerce.id'), true);
        $headers[] = new Header('sku', $this->adapter->lexicon('commerce.sku'), true);
        $headers[] = new Header('name', $this->adapter->lexicon('commerce.name'), true);
        $headers[] = new Header('description',  $this->adapter->lexicon('commerce.description'), true);
        $headers[] = new Header('price', $this->adapter->lexicon('commerce.price'), true);
        $headers[] = new Header('class_key', $this->adapter->lexicon('commerce.class_key'), true);
        $headers[] = new Header('target', $this->adapter->lexicon('commerce.target'), true);
        $headers[] = new Header('properties', $this->adapter->lexicon('commerce.properties'), false);

        return $headers;
    }

    /**
     * @return Row[]
     */
    public function getDataRows()
    {
        $rows = [];

        /** @var \comProduct $prod */
        foreach ($this->adapter->getIterator('comProduct') as $prod) {
            $rows[] = new Row($prod->toArray('', true));
        }

        return $rows;
    }

    /**
     * @return BaseChart[]
     */
    public function getAvailableCharts()
    {
        return [];
    }
}
````
