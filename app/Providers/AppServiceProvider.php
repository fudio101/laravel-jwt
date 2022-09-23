<?php

namespace App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Blueprint::macro('commonFields', function () {
            if ($this->getTable() !== 'users') {
                $this->unsignedBigInteger('created_by')->nullable();
            }
            $this->unsignedBigInteger('updated_by')->nullable();
            $this->unsignedBigInteger('deleted_by')->nullable();
            $this->softDeletes();
            $this->timestamps();
        });

        Blueprint::macro('commonForeignKeys', function () {
            if ($this->getTable() !== 'users') {
                $this->foreign('created_by')->references('id')->on('users');
            }
            $this->foreign('updated_by')->references('id')->on('users');
            $this->foreign('deleted_by')->references('id')->on('users');
        });

        Blueprint::macro('common', function () {
            $this->commonFields();
            $this->commonForeignKeys();
        });
        //
    }
}
