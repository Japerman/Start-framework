<?php

namespace Start\Router;

use Start\Router as RouterProvider;

class Router extends RouterProvider
{
    /**
     * Throw new Exception for Router Error
     *
     * @param string $message
     *
     * @return RouterException
     */
    public function exception($message = '')
    {
        return new RouterException($message);
    }

    /**
     * RouterCommand class
     *
     *
     * @return RouterCommand
     */
    public function routerCommand()
    {
        return RouterCommand::getInstance($this->baseFolder, $this->paths, $this->namespaces);
    }

    /**
     * @param $controller
     *
     * @return \Start\Router\RouterException|mixed
     */
    protected function resolveClass($controller)
    {
        if (strstr($controller, '\\')) {
            return ($controller);
        }

        return (str_replace(['.', '/'], ['\\'], $this->namespaces['controllers'] . $controller));
    }

    /**
     * Display all Routes.
     *
     * @return void
     */
    public function getList()
    {
        dd($this->getRoutes());
    }
}
