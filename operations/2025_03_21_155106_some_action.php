<?php

declare(strict_types=1);

use App\Console\Commands\InspiringCommand;
use DragonCode\LaravelDeployOperations\Operation;

return new class extends Operation {
    protected bool $before = false;

    public function __invoke(): void
    {
        $this->artisan(InspiringCommand::class);
    }
};
