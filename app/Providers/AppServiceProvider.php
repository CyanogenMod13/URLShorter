<?php

namespace App\Providers;

use App\Repository\HashedUrlRepository;
use App\Service\CheckSafeUrlService;
use App\Service\HashUrlService;
use App\Service\UrlShortGeneratorService;
use GuzzleHttp\Client;
use Illuminate\Contracts\Foundation\Application;
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
        $this->app->bind(CheckSafeUrlService::class, function (Application $app) {
			$config = $app['config']['services']['google_safe'];
			return new CheckSafeUrlService(new Client(), $config['api_key'], $config['api_url']);
		});

		$this->app->bind(UrlShortGeneratorService::class, function (Application $app) {
			$config = $app['config']['app'];
			return new UrlShortGeneratorService(
				$app->make(HashedUrlRepository::class),
				$app->make(HashUrlService::class),
				$app->make(CheckSafeUrlService::class),
				$config['url']
			);
		});
    }
}
