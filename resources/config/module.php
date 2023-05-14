<?php

return [
    'event_listeners' => true,
    'routes' => [
        'prefix' => 'admin/video',
        'namespace' => 'Modules\\Video\\Http\\Controllers\\Admin',
        'as' => 'video.admin.',
        'middleware' => ['web', 'auth', 'acl'],
        'files' => ['admin']
    ],
    'breadcrumbs' => true,
];
