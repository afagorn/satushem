#!/usr/bin/env php
<?php

declare(strict_types=1);

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;

require __DIR__ . '/../vendor/autoload.php';

/** @var ContainerInterface $container */
$container = require __DIR__ . '/../config/container.php';

$cli = new Application('Console');

foreach ($container->get('config')['console']['commands'] as $commandClass) {
  $cli->add($container->get($commandClass));
}

$cli->getHelperSet()->set(
    new EntityManagerHelper($container->get(EntityManagerInterface::class)),
    'em'
);

$cli->run();