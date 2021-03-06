<?php

namespace Start\Console;

use Start\Kernel\Application;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

class Command extends SymfonyCommand
{
    /**
     * @var Application Application
     */
    protected $nur;

    public function __construct(Application $app)
    {
        $this->nur = $app;

        parent::__construct();
    }

}
