To manage data from the Commerce dashboard, you'll need:

- A `Page` class for each action (overview, create, update)
- A `Grid` class that lists your objects allowing the user to do stuff with it
- A `FormWidget` instance that defines the fields to use.
- A menu item to point to your overview page
- A module to tie it all together!

Your xPDO model will need to be loaded in Commerce (using a Module that calls `$this->adapter->loadPackage` in its `initalize` method).

**Your xPDO object will need to extend comSimpleObject**, otherwise the built-in form handling will *not* work.

You'll need a couple of page classes in most cases. These are:

- Overview, containing the Grid widget that lists your existing objects, as well as having a "Add Object" button and actions on existing objects.
- Create, containing the Form widget to create new objects with.
- Update, containing logic on loading the object to edit and loading the form widget to edit that object.
- Delete, along with a DeleteForm class, to handle deleting an object.

It's recommended to put all of these in the same directory and namespace, grouped by object/feature, inside an `Admin` subnamespace.

In this example we're using the namespace `MeMyselfAndI\AwesomeExtension\Admin\ToDo`. As all classes are in the same namespace, we don't have to include the full class name in references.

[TOC]

### Overview Page with Grid

File: `core/components/commerce_awesomeextension/src/Admin/ToDo/Overview.php`

Contents:
```` php
<?php
namespace MeMyselfAndI\AwesomeExtension\Admin\ToDo;

use modmore\Commerce\Admin\Page;
use modmore\Commerce\Admin\Sections\SimpleSection;

class Overview extends Page {
    public $key = 'todo-overview';
    public $title = 'commerce_todo.todos';

    public function setUp()
    {
        $section = new SimpleSection($this->commerce, [
            'title' => $this->getTitle()
        ]);
        $section->addWidget(new Grid($this->commerce));
        $this->addSection($section);
        return $this;
    }
}
````

We're creating a simple section, giving it a title of `commerce_todo.todos`  (which is expected to be a lexicon), and then add an instance of Grid to it.

Let's create the Grid.

File: `core/components/commerce_awesomeextension/src/Admin/ToDo/Grid.php`

```` php
<?php
namespace MeMyselfAndI\AwesomeExtension\Admin\ToDo;

use modmore\Commerce\Admin\Widgets\GridWidget;
use modmore\Commerce\Admin\Util\Action;

class Grid extends GridWidget {
    public $key = 'todos';
    public $defaultSort = 'name';

    public function getItems(array $options = array())
    {
        $items = [];

        $c = $this->adapter->newQuery('MyExtTodo');

        // If you want to do any filtering, this is the place!

        // Get the total count for pagination
        $count = $this->adapter->getCount('MyExtTodo', $c);
        $this->setTotalCount($count);

        // Set the current page limit and load the object
        $c->limit($options['limit'], $options['start']);
        $collection = $this->adapter->getCollection('MyExtTodo', $c);

        foreach ($collection as $object) {
            $items[] = $this->prepareItem($object);
        }

        return $items;
    }

    public function getColumns(array $options = array())
    {
        return [
            [
                'name' => 'id',
                'hidden' => true,
            ],
            [
                'name' => 'task',
                'title' => $this->adapter->lexicon('commerce_todos.task'),
                'sortable' => true,
            ],
            [
                'name' => 'when',
                'title' => $this->adapter->lexicon('commerce_todos.when'),
                'sortable' => true,
            ],
        ];
    }

    public function getTopToolbar(array $options = array())
    {
        $toolbar = [];

        $toolbar[] = [
            'name' => 'add-todo',
            'title' => $this->adapter->lexicon('commerce_todos.add_todo'),
            'type' => 'button',
            'link' => $this->adapter->makeAdminUrl('todos/create'),
            'button_class' => 'commerce-ajax-modal',
            'icon_class' => 'icon-plus',
            'modal_title' => $this->adapter->lexicon('commerce_todos.add_todo'),
            'position' => 'top',
        ];

        $toolbar[] = [
            'name' => 'limit',
            'title' => $this->adapter->lexicon('commerce.limit'),
            'type' => 'textfield',
            'value' => (int)$options['limit'],
            'position' => 'bottom',
            'width' => 'two wide',
        ];

        return $toolbar;
    }

    public function prepareItem(MyExtTodo $todo)
    {
        $item = $todo->toArray('', false, true);

        $item['actions'] = [];

        $editUrl = $this->adapter->makeAdminUrl('todos/update', ['id' => $item['id']]);
        $item['actions'][] = (new Action())
            ->setUrl($editUrl)
            ->setTitle($this->adapter->lexicon('commerce_todos.todo.edit'))
            ->setIcon('icon-edit');

        $deleteUrl = $this->adapter->makeAdminUrl('todos/delete', ['id' => $item['id']]);
        $item['actions'][] = (new Action())
            ->setUrl($deleteUrl)
            ->setTitle($this->adapter->lexicon('commerce_todos.todo.delete'))
            ->setIcon('icon-trash');

        return $item;
    }
}
````

Lots of things are happening in the grid.

- First we get the items in a way that allows pagination.
- We define the columns that are shown in the table. With lexicons for names, and defining if columns are sortable.
- We define toolbar options. One button, to add a new to do, and the limit field that allows the user to change how many results are shown.
- We turn our `MyExtTodo` object into an array. This can do all sorts of pre-processing of the data, but in this example we just return the object's data as-is. We also add Actions that will be shown for each row, with links to edit and delete the object.

### Top toolbar filter types

- `textfield`
- `datefield` (as of 1.4)
- `select`, provide a `optgroups` array of `[label => [ [value => 'val', label => 'val label'] ]` or `options` array of `[ [value => 'val', label => 'val label'] ]`.
- `button`, acts as a `link` or a dropdown `menu`
- anything else will just render the title in the toolbar

