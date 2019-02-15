<?php

namespace Modules\Iviewcounts\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Iviewcounts\Events\Handlers\RegisterIviewcountsSidebar;

class IviewcountsServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterIviewcountsSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('counts', array_dot(trans('iviewcounts::counts')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('iviewcounts', 'permissions');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Iviewcounts\Repositories\CountRepository',
            function () {
                $repository = new \Modules\Iviewcounts\Repositories\Eloquent\EloquentCountRepository(new \Modules\Iviewcounts\Entities\Count());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iviewcounts\Repositories\Cache\CacheCountDecorator($repository);
            }
        );
// add bindings

    }
}
