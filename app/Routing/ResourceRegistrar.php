<?php

namespace App\Routing;

use Illuminate\Routing\ResourceRegistrar as DefaultRegistrar;

class ResourceRegistrar extends DefaultRegistrar
{
    // add data to the array
    /**
     * The default actions for a resourceful controller.
     *
     * @var array
     */
    protected $resourceDefaults = ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy', 'bulkaction', 'untrash'];

    /**
     * Add the bulkaction method for a resourceful route.
     *
     * @param  string  $name
     * @param  string  $base
     * @param  string  $controller
     * @param  array   $options
     * @return \Illuminate\Routing\Route
     */
    protected function addResourceBulkAction($name, $base, $controller, $options)
    {
        $uri = $this->getResourceUri($name).'/bulkaction';

        $action = $this->getResourceAction($name, $controller, 'bulkaction', $options);

        return $this->router->post($uri, $action);
    }

    /**
     * Add the untrash method for a resourceful route.
     *
     * @param  string  $name
     * @param  string  $base
     * @param  string  $controller
     * @param  array   $options
     * @return \Illuminate\Routing\Route
     */
    protected function addResourceUntrash($name, $base, $controller, $options)
    {
        $uri = $this->getResourceUri($name).'/{'.$base.'}/untrash';

        $action = $this->getResourceAction($name, $controller, 'untrash', $options);

        return $this->router->post($uri, $action);
    }
}
