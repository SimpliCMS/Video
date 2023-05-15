<?php

namespace Modules\Video\Resources\Database\Seeds;

use Illuminate\Database\Seeder;
use Modules\Core\Models\Menu;
use Modules\Core\Models\MenuItem;

class VideoMenus extends Seeder
{
    public function run()
    {
        $mainMenu = Menu::where('name', 'Main Menu')->first();


        $videoMenuItem = MenuItem::create([
                    "name" => 'Videos',
                    "url" => 'video.index',
                    "menu_id" => $mainMenu->id,
                    'is_internal' => 1
        ]);
    }
}

