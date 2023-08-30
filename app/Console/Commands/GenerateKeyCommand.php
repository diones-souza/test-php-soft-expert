<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateKeyCommand extends Command
{
    protected static $defaultName = 'generate:key';

    protected function configure()
    {
        $this->setDescription('Generate a secret key and add it to the .env file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $secretKey = base64_encode(random_bytes(32));

        $this->updateEnvKey('JWT_SECRET', $secretKey);

        $output->writeln('Secret key generated and added to .env');

        return Command::SUCCESS;
    }

    protected function updateEnvKey($envKey, $envValue)
    {
        $envFilePath = '.env';

        if (!file_exists($envFilePath)) {
            throw new \Exception('.env file not found');
        }

        $envContent = file_get_contents($envFilePath);

        $keyPosition = strpos($envContent, "{$envKey}=");

        if ($keyPosition !== false) {
            $lineEndPosition = strpos($envContent, "\n", $keyPosition);

            $originalLine = substr($envContent, $keyPosition, $lineEndPosition - $keyPosition);

            $newLine = str_replace($envKey . '=', $envKey . '=' . $envValue, $originalLine);

            $envContent = str_replace($originalLine, $newLine, $envContent);

            file_put_contents($envFilePath, $envContent);
        } else {
            $envContent .= "\n";
            $envContent .= $envKey . '=' . $envValue;
            file_put_contents($envFilePath, $envContent);
        }
    }
}
