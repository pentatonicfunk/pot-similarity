#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application();

// ... register commands
$application->add(new \PotSimilarity\Commands\FindSimilarity());
try {
    $application->run();
} catch (Exception $e) {
}

