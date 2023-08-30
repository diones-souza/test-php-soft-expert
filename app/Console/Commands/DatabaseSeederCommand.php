<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DatabaseSeederCommand extends Command
{
    protected static $defaultName = 'db:seed';
    private $seederCallback;

    public function __construct(callable $seederCallback)
    {
        $this->seederCallback = $seederCallback;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Run database seeders');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $seederCallback = $this->seederCallback;
        $seederCallback();

        return Command::SUCCESS;
    }
}
