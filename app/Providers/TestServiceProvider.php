<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Database\Console\Seeds\SeedCommand;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\ParallelTesting;
use Illuminate\Support\ServiceProvider;

use function expect;

class TestServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningUnitTests()) {
            $this->parallel();
            $this->macros();
        }
    }

    protected function parallel(): void
    {
        ParallelTesting::setUpTestDatabase(
            static fn () => Artisan::call(SeedCommand::class)
        );
    }

    protected function macros(): void
    {
        Http::macro('assertMatchSnapshots', function (): void {
            Http::recorded()->each(
                function (array $pair): void {
                    [$request, $response] = $pair;

                    expect([
                        'url'      => $request->url(),
                        'request'  => $request->data(),
                        'response' => json_validate($response->body()) ? $response->json() : $response->body(),
                    ])->toMatchSnapshot();
                }
            );
        });

        Collection::macro('toMatchSnapshot', function (): void {
            expect($this->toArray())->toMatchSnapshot();
        });
    }
}
