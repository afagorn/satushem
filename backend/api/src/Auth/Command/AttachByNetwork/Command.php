<?php

declare(strict_types=1);

namespace App\Auth\Command\AttachByNetwork;

class Command
{
    public string $id = '';
    public string $network = '';
    public string $identity;
}