<?php

namespace Delivery\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Delivery\Repositories\CategoriaRepository',
            'Delivery\Repositories\CategoriaRepositoryEloquent'
        );

        $this->app->bind(
            'Delivery\Repositories\ClienteRepository',
            'Delivery\Repositories\ClienteRepositoryEloquent'
        );

        $this->app->bind(
            'Delivery\Repositories\OrderRepository',
            'Delivery\Repositories\OrderRepositoryEloquent'
        );

        $this->app->bind(
            'Delivery\Repositories\OrderItemRepository',
            'Delivery\Repositories\OrderItemRepositoryEloquent'
        );

        $this->app->bind(
            'Delivery\Repositories\ProdutoRepository',
            'Delivery\Repositories\ProdutoRepositoryEloquent'
        );

        $this->app->bind(
            'Delivery\Repositories\UserRepository',
            'Delivery\Repositories\UserRepositoryEloquent'
        );

        $this->app->bind(
            'Delivery\Repositories\CupomRepository',
            'Delivery\Repositories\CupomRepositoryEloquent'
        );
    }
}
