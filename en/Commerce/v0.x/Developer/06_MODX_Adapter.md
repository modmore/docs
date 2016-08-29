The Adapter is a link between the MODX core and the Commerce extra. Should the MODX core change in a way that is not backwards compatible in the future, we hope the adapter will be able of accommodating those changes without rewriting the core or modules. 

If you can, use the adapter in your modules rather than relying on the xPDO or modX objects directly. 

The adapter exposes the following contract and is typically available via either `$commerce->adapter` or `$this->adapter` in models.

```` php
<?php

namespace modmore\Commerce\Adapter;

interface AdapterInterface
{
    /**
     * Returns a configuration option / system setting. If $options is defined, it will look through that array
     * first before looking up system configuration.
     *
     * @param $key
     * @param null|array $options
     * @param mixed $default
     * @param bool $skipEmpty
     * @return mixed
     */
    public function getOption($key, $options = null, $default = null, $skipEmpty = false);

    /**
     * Attempts to load an object from the database according to the criteria specified.
     *
     * @param $className
     * @param null $criteria
     * @param bool $cacheFlag
     * @return null|\comSimpleObject|\xPDOSimpleObject
     */
    public function getObject($className, $criteria = null, $cacheFlag = true);

    /**
     * Returns an xPDOIterator object with the available objects matching criteria.
     *
     * @param $className
     * @param null $criteria
     * @param bool $cacheFlag
     * @return \xPDOIterator
     */
    public function getIterator($className, $criteria = null, $cacheFlag = true);

    /**
     * Returns an array of available objects matching the criteria.
     *
     * @param $className
     * @param mixed $criteria
     * @param bool $cacheFlag
     * @return array|\xPDOObject[]|\comSimpleObject[]
     */
    public function getCollection($className, $criteria = null, $cacheFlag = true);

    /**
     * Returns the number of objects (optionally matching a certain criteria) that currently exist.
     *
     * @param string $className
     * @param mixed $criteria
     * @return int
     */
    public function getCount($className, $criteria = null);

    /**
     * Manually loads a class with the name $fqn in the specified path.
     *
     * @param $fqn
     * @param string $path
     * @param bool $ignorePkg
     * @param bool $transient
     * @return mixed
     */
    public function loadClass($fqn, $path = '', $ignorePkg = false, $transient = false);

    /**
     * Returns a modUser object or false if there is no current user record.
     *
     * @return false|\modUser
     */
    public function getUser();

    /**
     * Logs an entry to the error log.
     *
     * @param $level
     * @param $msg
     * @param string $target
     * @param string $def
     * @param string $file
     * @param string $line
     * @return mixed
     */
    public function log($level, $msg, $target = '', $def = '', $file = '', $line = '');

    /**
     * Creates a new object of the class specified.
     *
     * @param $className
     * @param array $fields
     * @return \comSimpleObject|\xPDOObject
     */
    public function newObject($className, $fields = array());

    /**
     * Return a new xPDOQuery object for the requested class type.
     *
     * @param string $className
     * @return \xPDOQuery
     */
    public function newQuery($className);

    /**
     * Returns the translated value for a lexicon key.
     *
     * @param $key
     * @param array $params
     * @param string $language
     * @return mixed
     */
    public function lexicon($key, $params = array(), $language = '');

    /**
     * Loads a lexicon topic
     *
     * @return mixed
     */
    public function loadLexicon();

    /**
     * Reads from the configured cache handler.
     *
     * @param $key
     * @param array $cacheOptions
     * @return mixed
     */
    public function readCache($key, array $cacheOptions = array());

    /**
     * Writes to the configured cache handler.
     *
     * @param $key
     * @param $var
     * @param int $lifetime
     * @param array $options
     * @return mixed
     */
    public function writeCache($key, $var, $lifetime= 0, $options= array());

    /**
     * Calls a (static) method on a xPDO Package class.
     *
     * @param $class
     * @param $method
     * @param array $args
     * @param bool $transient
     * @return mixed
     */
    public function call($class, $method, array $args = array(), $transient = false);

    /**
     * Creates a link to a MODX resource by its ID. This is primarily used by the
     * comResourceProduct class, for the view url.
     *
     * @param $id
     * @param string $context
     * @param string $args
     * @param int $scheme
     * @param array $options
     * @return string
     */
    public function makeResourceUrl($id, $context = '', $args = '', $scheme = -1, array $options = array());

    /**
     * Creates a link to a page in the Commerce admin area.
     *
     * @param string $action The action to load, e.g. dashboard, products or orders
     * @param array $parameters An optional array of additional parameters to pass along
     *
     * @return string
     */
    public function makeAdminUrl($action, $parameters = array());

    /**
     * Prepares the select array for xPDOQuery->select calls including the table alias and the likes.
     *
     * @param string $className
     * @param string $tableAlias
     * @param string $columnPrefix
     * @param array $columns
     * @param bool|false $exclude
     * @return array
     */
    public function getSelectColumns($className, $tableAlias = '', $columnPrefix = '', $columns = array(), $exclude = false);
}
````

Commerce ships with one implementation of the adapter, which is `Revolution` and provides mostly one-on-one links to the MODX core methods with the same name as the adapter.