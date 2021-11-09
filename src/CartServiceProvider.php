<?php


namespace Jimmitjoo\Cart;

use Illuminate\Support\Collection;
use Jimmitjoo\Cart\Models\CartItem;
use Illuminate\Support\Facades\Event;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Jimmitjoo\Cart\Events\CartItemAdded;
use Jimmitjoo\Cart\Events\CartItemDeleted;
use Jimmitjoo\Cart\Events\CartItemUpdated;
use Jimmitjoo\Cart\Observers\CartObserver;
use Jimmitjoo\Cart\Observers\CartItemObserver;
use Jimmitjoo\Cart\Models\Cart as LaravelCart;
use Jimmitjoo\Cart\Listeners\CalculateCartPrice;

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

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        LaravelCart::observe(CartObserver::class);
        CartItem::observe(CartItemObserver::class);

        Event::listen(
            CartItemAdded::class,
            CalculateCartPrice::class
        );

        Event::listen(
            CartItemUpdated::class,
            CalculateCartPrice::class
        );

        Event::listen(
            CartItemDeleted::class,
            CalculateCartPrice::class
        );
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

        // Register the service the package provides.
        $this->app->singleton('cart', function () {
            return new Cart;
        });
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
            __DIR__ . '/../database/migrations/2021_11_09_111109_create_cart_tables.php' => $this->getMigrationFileName('create_cart_tables.php'),
        ], 'laravel-cart');
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