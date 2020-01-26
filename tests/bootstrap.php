<?php declare(strict_types=1);

use Ninjify\Nunjuck\Environment;
use Nette\Loaders\RobotLoader;

if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    echo 'Install Nette Tester using `composer update --dev`';
    die(0);
}

require_once __DIR__ . '/../vendor/autoload.php';

Environment::setupTester();
Environment::setupTimezone();
Environment::setupVariables(__DIR__);
Environment::setupRobotLoader(static function (RobotLoader $loader) {
    $loader->addDirectory(__DIR__ . '/app');
});
