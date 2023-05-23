<?php

namespace Modules\Video\Resources\Database\Seeds;

use Illuminate\Database\Seeder;
use Modules\Core\Models\MenuProxy;
use Modules\Core\Models\MenuItemProxy;

class VideoMenus extends Seeder
{
    public function run()
    {
        $mainMenu = MenuProxy::where('name', 'Main Menu')->first();


        $videoMenuItem = MenuItemProxy::create([
                    "name" => 'Videos',
                    "url" => 'video.index',
                    "menu_id" => $mainMenu->id,
                    'is_internal' => 1
        ]);
    }
}

