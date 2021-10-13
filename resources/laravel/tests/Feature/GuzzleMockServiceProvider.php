<?php

namespace Tests\Feature;

use GuzzleHttp\Handler\MockHandler;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class GuzzleMockServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function __construct(Application $app, MockHandler $handler)
    {
        parent::__construct($app);
        $this->handler = $handler;
    }

    public function register()
    {
        $this->app->singleton(MockHandler::class, function () {
            return $this->handler;
        });
    }

    public function provides()
    {
        return [MockHandler::class];
    }
}
