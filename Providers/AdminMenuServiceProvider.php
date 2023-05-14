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
        if ($adminMenu = Menu::get('admin')) {
            $video = $adminMenu->addItem('video', __('Video'))->data('order', 11);
            $video->addSubItem('videos', __('Videos'), '/admin/video')
                    ->prepend('<i class="fa-solid fa-video"></i>')
                    ->activateOnUrls('admin/video/*');
        }
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
