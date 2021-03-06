<?php

namespace Start\Console\Commands\Cache;

use Start\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

class ConfigCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('cache:config')
            ->setDescription("Cache your application config files.");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $cacheFile = cache_path('config.php');
        if (file_exists($cacheFile)) {
            $helper = $this->getHelper('question');
            $question = new ConfirmationQuestion('Old cache will be deleted and re-created. Are you sure?: ', false);

            if (!$helper->ask($input, $output, $question)) {
                return;
            }
            unlink($cacheFile);
            $output->writeln('<info>+Success!</info> Config cache has been deleted.');
            $output->writeln('Config cache re-creating....');
        }

        if (false === file_put_contents($cacheFile, $this->config())) {
            throw new \RuntimeException(sprintf('Config cache file could not be written.'));
        }

        return $output->writeln('<info>+Success!</info> Configs have been cached.');
    }

    private function config()
    {
        $config = app()->getConfig();
        return '<?php return ' . var_export($config, true) . ';' . PHP_EOL;
    }
}