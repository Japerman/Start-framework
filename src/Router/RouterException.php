<?php

namespace Start\Router;

use Start\Exception\NotFoundHttpException;

class RouterException
{
    /**
     * Create Exception Class.
     *
     * @param string $message
     *
     * @return mixed
     */
    public function __construct($message)
    {
        throw new NotFoundHttpException($message);
    }
}
