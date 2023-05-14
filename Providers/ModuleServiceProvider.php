<?php

namespace Modules\Video\Providers;

use Konekt\Concord\BaseModuleServiceProvider;
use Illuminate\Support\Facades\DB;
use Modules\Video\Models\Video;
use Modules\Video\Models\VideoState;
use Modules\Video\Http\Requests\CreateVideo;
use Modules\Video\Http\Requests\UpdateVideo;
use Schema;

class ModuleServiceProvider extends BaseModuleServiceProvider {

    /**
     * The namespace for the module's models.
     *
     * @var string
     */
    protected $modelNamespace = 'Modules\Video\Models';
    protected $models = [
        Video::class,
    ];
    protected $enums = [
        VideoState::class,
    ];
    protected $requests = [
        CreateVideo::class,
        UpdateVideo::class,
    ];

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot() {
        parent::boot();
        // Your module's boot logic here
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(AdminMenuServiceProvider::class);
        $this->app->register(VideoSettingsServiceProvider::class);
        $this->app->register(PluginServiceProvider::class);
        $this->ViewPaths();
        $this->adminViewPaths();
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register() {
        // Your module's register logic here
    }

    public function ViewPaths() {
        $moduleLower = lcfirst('Video');
        if (Schema::hasTable('settings')) {
            $setting = DB::table('settings')->where('id', 'site.theme')->first();
            $currentTheme = $setting->value;
        } else {
            $currentTheme = 'default';
        }
        $views = [
            base_path("themes/$currentTheme/views/modules/Video"),
            module_Viewpath('Video', $currentTheme),
            base_path("themes/default/views/modules/Video"),
            module_Viewpath('Video', 'default'),
            base_path("resources/views/modules/Video"),
        ];

        return $this->loadViewsFrom($views, $moduleLower);
    }

    public function adminViewPaths() {
        $moduleLower = lcfirst('Video');
        $currentTheme = 'admin';
        $views = [
            module_Viewpath('Video', $currentTheme),
            base_path("themes/$currentTheme/views/modules/Video"),
        ];

        return $this->loadViewsFrom($views, $moduleLower . '-admin');
    }

}
