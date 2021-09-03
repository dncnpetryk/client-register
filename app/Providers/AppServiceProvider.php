<?php

namespace App\Providers;

use App\Repositories\ClientRepository;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Services\AccountService;
use App\Services\Contracts\AccountServiceInterface;
use App\Services\GeoCoordinatesApiService;
use App\Services\GeoCoordinateService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Redis\RedisManager;
use Illuminate\Support\ServiceProvider;
use Spatie\Geocoder\Geocoder;

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
        $this->app->bind(GeoCoordinatesApiService::class, function (): GeoCoordinatesApiService {
            return new GeoCoordinatesApiService(
                config('geocoder.key'),
                app()->make(Geocoder::class)
            );
        });

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ClientRepositoryInterface::class, ClientRepository::class);
    }
}
