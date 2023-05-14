<?php

namespace Modules\Video\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Modules\Video\Models\VideoState;
use Modules\Video\Contracts\Video as VideoContract;
use Konekt\Enum\Eloquent\CastsEnums;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Video extends Model implements VideoContract, HasMedia {

    use InteractsWithMedia;

//    use CastsEnums;
    use Sluggable;
    use SluggableScopeHelpers;

    protected $fillable = [
        'name',
        'slug',
        'excerpt',
        'description',
        'state',
        'ext_title',
        'meta_keywords',
        'meta_description',
    ];
    protected $enums = [
        'state' => 'VideoState@enumClass'
    ];

    public function isActive(): bool {
        return $this->state->isActive();
    }

    public function getIsActiveAttribute(): bool {
        return $this->isActive();
    }

    public function title(): string {
        return $this->ext_title ?? $this->name;
    }

    public function getTitleAttribute(): string {
        return $this->title();
    }

    public function scopeActives(Builder $query): Builder {
        return $query->whereIn('state', BookableState::getActiveStates());
    }

    public function scopeInactives(Builder $query): Builder {
        return $query->whereIn('state', array_diff(BookableState::values(), BookableState::getActiveStates()));
    }

    public function sluggable(): array {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function registerMediaCollections(): void {
        $this
                ->addMediaCollection('videos')
                ->useDisk('video')
                ->singleFile()
                ->registerMediaConversions(function (Media $media) {
                    $this
                    ->addMediaConversion('thumbnail')
                    ->width(100)
                    ->height(100);
                });
    }

}
