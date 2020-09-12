<?php


namespace Pitisha;

use Illuminate\Support\ServiceProvider;

class ApprovableServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }
    }

    /**
     * Publish resources
     */
    private function registerPublishing()
    {
        //this is to allow you to modify the tables according to your project need
        $this->publishes([
            __DIR__ . '/../config/pitisha.php' => 'config/pitisha.php',
            __DIR__ . '/../database/migrations/2018_10_12_000000_create_approvals_table.php' =>
                'database/migrations/2018_10_12_000000_create_approvals_table.php',
        ], 'pitisha');
    }
}
