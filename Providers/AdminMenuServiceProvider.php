<?php

namespace Modules\Video\Providers;

use Illuminate\Support\ServiceProvider;
use Konekt\Menu\Facades\Menu;

class AdminMenuServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot() {
        // Your boot logic here
        $this->app->booted(function () {
            if ($adminMenu = Menu::get('admin')) {
                $video = $adminMenu->addItem('video', __('Video'))->data('order', 11);
                $video->addSubItem('videos', __('Videos'), ['route' => 'video.admin.index'])
                        ->prepend('<i class="fa-solid fa-video"></i>')
                        ->activateOnUrls($this->routeWildcard('video.admin.index'));
            }
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        //
    }

    private function routeWildcard(string $route): string {
        if (0 === strlen($path = parse_url(route($route), PHP_URL_PATH))) {
            return '';
        }

        if ('/' === $path[0]) {
            $path = substr($path, 1);
        }

        return "$path*";
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
