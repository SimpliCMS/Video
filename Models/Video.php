<?php

namespace Modules\Video\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Modules\Video\Models\VideoStateProxy;
use Modules\Video\Contracts\Video as VideoContract;
use Modules\Comment\Models\Comment;
use Modules\Like\Contracts\Likeable;
use Modules\Like\Traits\Likes;
use Konekt\Enum\Eloquent\CastsEnums;
use Konekt\User\Models\UserProxy;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use Carbon\Carbon;

class Video extends Model implements VideoContract, Likeable, HasMedia, Viewable {

    use InteractsWithMedia;
    use InteractsWithViews;
    use HasTags;
    use Likes;
    use CastsEnums;
    use Sluggable;
    use SluggableScopeHelpers;

    protected $fillable = [
        'name',
        'slug',
        'url',
        'excerpt',
        'description',
        'duration',
        'state',
        'service',
        'service_id',
        'ext_title',
        'meta_keywords',
        'meta_description',
        'user_id',
    ];
    protected $enums = [
        'state' => 'VideoStateProxy@enumClass'
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
        return $query->whereIn('state', VideoStateProxy::getActiveStates());
    }

    public function scopeInactives(Builder $query): Builder {
        return $query->whereIn('state', array_diff(VideoStateProxy::values(), VideoStateProxy::getActiveStates()));
    }

    public function timeAgo() {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function sluggable(): array {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function registerMediaCollections(): void {
        $this->addMediaCollection('videos')
                ->useDisk('video')
                ->singleFile()
                ->registerMediaConversions(function (Media $media) {
                    $this
                    ->addMediaConversion('thumbnail')
                    ->width(100)
                    ->height(100);
                });
        $this->addMediaCollection('service_image')
                ->useDisk('video')
                ->singleFile()
                ->registerMediaConversions(function (Media $media) {
                    $this
                    ->addMediaConversion('service_thumbnail')
                    ->width(100)
                    ->height(100);
                });
    }

    public function getUser(): User {
        return $this->user;
    }

    public function user() {
        return $this->belongsTo(UserProxy::modelClass(), 'user_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'type_id')->whereNull('parent_id');
    }

}
