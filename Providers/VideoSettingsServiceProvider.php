<?php

namespace Modules\Video\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class VideoSettingsServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot() {
        // Your boot logic here
        Config::set('filesystems.disks.video', [
            'driver' => 'local',
            'root' => storage_path('app/video'),
            'url' => env('APP_URL') . 'app/storage/app/video',
            'visibility' => 'public',
        ]);
//        Config::set('youtube.key', '');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return [];
    }

}
