<?php

namespace EngMahmoudElgml\Super\Providers;

use EngMahmoudElgml\Super\Facades\Super;
use EngMahmoudElgml\Super\Super as SuperParent;
use Illuminate\Support\ServiceProvider;

class SuperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind("Super" , function (){
            return new SuperParent();
        });
    }
}
