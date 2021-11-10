<?php


namespace Jimmitjoo\Cart\Tests;

use Jimmitjoo\Cart\CartServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->turnStubsToMigrations();

        $this->loadMigrationsFrom(__DIR__ . '/migrations/');
        $this->artisan('migrate', ['--database' => 'testbench'])->run();

        $this->turnMigrationsToStubs();
    }

    protected function getPackageProviders($app): array
    {
        return [
            CartServiceProvider::class,
        ];
    }

    protected function turnStubsToMigrations(): void
    {
        $migrationsFolder = __DIR__ . '/../database/migrations/';
        $migrations = scandir($migrationsFolder);
        foreach ($migrations as $migration) {
            if ($migration === '.' || $migration === '..') continue;

            $newName = str_replace('.php.stub', '.php', $migration);

            rename($migrationsFolder . $migration, $migrationsFolder . $newName);
        }
    }

    protected function turnMigrationsToStubs(): void
    {
        $migrationsFolder = __DIR__ . '/../database/migrations/';
        $migrations = scandir($migrationsFolder);
        foreach ($migrations as $migration) {
            if ($migration === '.' || $migration === '..') continue;

            $newName = str_replace('.php', '.php.stub', $migration);

            rename($migrationsFolder . $migration, $migrationsFolder . $newName);
        }
    }

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }
}