<?php

namespace Start\Console\Commands\Make;

use Start\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SeederCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('make:seeder')
            ->addArgument('name', InputArgument::REQUIRED, 'The name for the seeder.')
            ->addOption('--force', '-f', InputOption::VALUE_OPTIONAL, 'Force to re-create seeder.')
            ->setDescription('Create a new seeder.')
            ->setHelp("This command makes you to create seeder...");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $file = database_path('seeds/' . $name . '.php');

        if (!file_exists($file)) {
            $this->createNewFile($file, $name);
            return $output->writeln('<info>+Success!</info> "' . $name . '" seeder created.');
        }

        if ($input->hasParameterOption('--force') !== false) {
            unlink($file);
            $this->createNewFile($file, $name);
            return $output->writeln('<info>+Success!</info> "' . $name . '" seeder re-created.');
        }

        return $output->writeln('<error>-Error!</error> Seeder already exists! (' . $name . ')');
    }

    private function createNewFile($file, $name)
    {
        $className = ucfirst($name);
        $contents = <<<PHP
<?php

use Start\Database\Seeder;

class $className extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 
    }
}

PHP;
        if (false === file_put_contents($file, $contents)) {
            throw new \RuntimeException(sprintf('The file "%s" could not be written to', $file));
        }
    }
}
