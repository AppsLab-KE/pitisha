<?php


namespace Reviewable;

use Illuminate\Support\ServiceProvider;

class ReviewableServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }
    }
    /**
     * Register
     */
    public function register()
    {
    }

    /**
     * Package route config
     *
     * @return array
     */
    protected function routeConfig()
    {
        return [
            'prefix' => config('reviewable.route-prefix'),
            'middleware' => config('reviewable.route-middleware')
        ];
    }

    /**
     * Publish resources
     */
    private function registerPublishing()
    {
        //this is to allow you to modify the tables according to your project need
        $this->publishes([
            __DIR__ . '/../config/reviewable.php' => 'config/reviewable.php',
            __DIR__.'/../database/migrations/2018_10_12_000000_create_reviews_table.php' =>
                'database/migrations/2018_10_12_000000_create_reviews_table.php',
        ], 'reviewable');
    }
}
