<?php

declare(strict_types=1);

use App\Console\HelloCommand;
use Doctrine\ORM\Tools\Console\Command\SchemaTool\DropCommand;
use Doctrine\ORM\Tools\Console\Command\ValidateSchemaCommand;

return [
    'config' => [
        'console' => [
            'commands' => [
                DropCommand::class
            ]
        ]
    ]
];
