<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Enums\QueueEnum;
use Illuminate\Contracts\Support\Arrayable;
use Spatie\LaravelData\Optional;

use function array_fill;
use function array_filter;
use function collect;

class HorizonHelper implements Arrayable
{
    public function __construct(
        protected Optional|string $connection = 'redis',
        protected array|Optional|QueueEnum $queue = QueueEnum::Default,
        protected false|Optional|string $balance = 'auto',
        protected Optional|string $autoScalingStrategy = 'time',
        protected int|Optional $minProcesses = 1,
        protected int|Optional $maxProcesses = 1,
        protected int|Optional $balanceMaxShift = 1,
        protected int|Optional $balanceCooldown = 3,
        protected int|Optional $maxTime = 0,
        protected int|Optional $maxJobs = 0,
        protected int|Optional $tries = 3,
        protected int|Optional $timeout = 3600,
        protected int|Optional $nice = 0,
        protected int|Optional $sleep = 1,
    ) {}

    public static function make(): static
    {
        return new static();
    }

    public static function optional(): static
    {
        $values = array_fill(0, 14, Optional::create());

        return new static(...$values);
    }

    public function queue(array|QueueEnum $queue): static
    {
        $this->queue = $queue;

        return $this;
    }

    public function balance(bool|string $balance): static
    {
        $this->balance = $balance;

        return $this;
    }

    public function maxProcesses(int $maxProcesses): static
    {
        $this->maxProcesses = $maxProcesses;

        return $this;
    }

    public function tries(int $tries): static
    {
        $this->tries = $tries;

        return $this;
    }

    public function timeout(int $timeout): static
    {
        $this->timeout = $timeout;

        return $this;
    }

    public function sleep(int $sleep): static
    {
        $this->sleep = $sleep;

        return $this;
    }

    public function toArray(): array
    {
        return array_filter([
            'connection'          => $this->connection,
            'queue'               => $this->getQueue(),
            'balance'             => $this->balance,
            'autoScalingStrategy' => $this->autoScalingStrategy,
            'minProcesses'        => $this->minProcesses,
            'maxProcesses'        => $this->maxProcesses,
            'balanceMaxShift'     => $this->balanceMaxShift,
            'balanceCooldown'     => $this->balanceCooldown,
            'maxTime'             => $this->maxTime,
            'maxJobs'             => $this->maxJobs,
            'tries'               => $this->tries,
            'timeout'             => $this->timeout,
            'nice'                => $this->nice,
            'sleep'               => $this->sleep,
        ], static fn (mixed $value) => ! $value instanceof Optional);
    }

    protected function getQueue(): array|Optional
    {
        if ($this->queue instanceof Optional) {
            return $this->queue;
        }

        return collect($this->queue)->map->value->all();
    }
}
