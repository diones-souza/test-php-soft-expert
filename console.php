<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use App\Console\Commands\GenerateKeyCommand;
use App\Console\Commands\DatabaseSeederCommand;
use Database\Seeds\DatabaseSeeder;

$application = new Application();

$application->add(new GenerateKeyCommand());
$application->add(new DatabaseSeederCommand(function () {
    $seed = new DatabaseSeeder();
    $seed->run();
}));

$application->run();
