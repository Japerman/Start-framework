<?php

namespace Start\Components\Builder;

use Start\Components\Builder\Providers\HtmlProvider;
use Start\Uri\Uri;

class Html extends HtmlProvider
{
    /**
     * Class constructor
     *
     * @return mixed
     */
    public function __construct()
    {
        return parent::__construct(new Uri);
    }
}
