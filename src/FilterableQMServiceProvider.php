<?php

namespace Awstalib\FilterableQM;

use Illuminate\Support\ServiceProvider;

class FilterableQMServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register any bindings or services here
    }

    public function boot()
    {
        // Publish configuration files, views, migrations, etc.
        $this->publishes([
            __DIR__.'/config/filterable_qm.php' => config_path('filterable_qm.php'),
        ], 'config');
    }
}
