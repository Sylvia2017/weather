<?php
/**
 * Created by PhpStorm.
 * User: sylvia
 * Date: 2019/1/14
 * Time: 下午5:04
 */

namespace Sylvia\Weather;


class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(Weather::class, function () {
            return new Weather(config('services.weather.key'));
        });

        $this->app->alias(Weather::class, 'weather');
    }

    public function provides()
    {
        return [Weather::class, 'weather'];
    }
}