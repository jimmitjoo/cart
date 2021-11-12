<?php


namespace Jimmitjoo\Cart;

use Illuminate\Support\Collection;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Jimmitjoo\Cart\Contracts\CartContract;
use Jimmitjoo\Cart\Contracts\CartItemContract;
use Jimmitjoo\Cart\Observers\CartItemObserver;
use Jimmitjoo\Cart\Observers\CartObserver;

class CartServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->offerPublishing();
        }

        $this->registerModelBindings();

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $cartClass = config('cart.models.cart');
        $cartItemClass = config('cart.models.cart-item');

        $cartClass::observe(CartObserver::class);
        $cartItemClass::observe(CartItemObserver::class);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/cart.php',
            'cart'
        );

        $this->app->register(CartEventServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return ['cart'];
    }

    public function offerPublishing(): void
    {
        $this->publishes([
            __DIR__ . '/../config/cart.php' => $this->app->configPath() . '/cart.php',
            __DIR__ . '/../database/migrations/2021_11_09_111109_create_carts_table.php.stub' => $this->getMigrationFileName('create_carts_table.php'),
        ], 'laravel-cart');
    }

    protected function registerModelBindings()
    {
        $config = $this->app->config['cart.models'];

        if (! $config) {
            return;
        }

        $this->app->bind(CartContract::class, $config['cart']);
        $this->app->bind(CartItemContract::class, $config['cart-item']);
    }

    /**
     * Returns existing migration file if found, else uses the current timestamp.
     *
     * @param $migrationFileName
     * @return string
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getMigrationFileName($migrationFileName): string
    {
        $timestamp = date('Y_m_d_His');

        $filesystem = $this->app->make(Filesystem::class);

        return Collection::make($this->app->databasePath() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR)
            ->flatMap(function ($path) use ($filesystem, $migrationFileName) {
                return $filesystem->glob($path . '*_' . $migrationFileName);
            })
            ->push($this->app->databasePath() . "/migrations/{$timestamp}_{$migrationFileName}")
            ->first();
    }
}