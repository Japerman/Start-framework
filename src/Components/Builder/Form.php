<?php

namespace Start\Components\Builder;

use Start\Components\Builder\Providers\FormProvider;
use Start\Uri\Uri;

class Form extends FormProvider
{
    /**
     * Class constructor
     *
     * @return mixed
     */
    public function __construct()
    {
        return parent::__construct(new Uri, new Html, csrf_token());
    }
}
