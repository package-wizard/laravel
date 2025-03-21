<?php

declare(strict_types=1);

namespace App\Console;

use App\Console\Commands\InspiringCommand;
use Illuminate\Cache\Console\PruneStaleTagsCommand;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Console\PruneCommand;
use Laravel\Horizon\Console\SnapshotCommand;

class Handler
{
    public function __invoke(Schedule $schedule): void
    {
        $this->service($schedule);
        $this->quotes($schedule);
        $this->some($schedule);
    }

    protected function service(Schedule $schedule): void
    {
        $this->command($schedule, PruneStaleTagsCommand::class)->hourly();
        $this->command($schedule, PruneCommand::class)->dailyAt('03:20');
        $this->command($schedule, SnapshotCommand::class)->everyFiveMinutes();
    }

    protected function quotes(Schedule $schedule): void
    {
        $this->command($schedule, InspiringCommand::class)->everyTenMinutes();
    }

    protected function some(Schedule $schedule): void
    {
        // some commands
    }

    protected function command(Schedule $schedule, string $command, array $parameters = []): Event
    {
        return $schedule->command($command, $parameters)
            ->withoutOverlapping($this->ttl())
            ->runInBackground();
    }

    protected function ttl(): int
    {
        return (int) (config('console.default_ttl') / 60);
    }
}
