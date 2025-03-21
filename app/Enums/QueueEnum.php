<?php

declare(strict_types=1);

namespace App\Enums;

enum QueueEnum: string
{
    case Deploy  = 'deploy';
    case Default = 'default';
    case Some    = 'some';
}
