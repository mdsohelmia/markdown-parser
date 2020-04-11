<?php


namespace Sohel\MarkdownParser;


use Illuminate\Support\ServiceProvider;
use Sohel\MarkdownParser\Console\ProccessCommand;

class MarkdonwPaserBaseServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->registerResources();
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }

    }

    private function registerResources()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__.'/../config/press.php'=>config_path('press.php')
        ],'press-config.php');
    }

    public function register()
    {
        $this->registerCommands();
    }

    protected function registerCommands()
    {
        if (!$this->app->runningInConsole()) return;
        $this->commands([ ProccessCommand::class]);
    }
}
