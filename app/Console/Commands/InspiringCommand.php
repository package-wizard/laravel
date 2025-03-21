<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\InspireService;
use Illuminate\Console\Command;

use function Laravel\Prompts\info;

class InspiringCommand extends Command
{
    protected $signature = 'inspiring';

    protected $description = 'Show inspiring quote';

    public function handle(InspireService $service): void
    {
        info(
            $service->quote()
        );
    }
}
