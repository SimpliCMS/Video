<?php

namespace Modules\Video\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Video\Contracts\VideoState as VideoStateContract;
use Konekt\Enum\Enum;

class VideoState extends Enum implements VideoStateContract {

    public const __DEFAULT = self::DRAFT;
    public const DRAFT = 'draft';
    public const INACTIVE = 'inactive';
    public const ACTIVE = 'active';
    public const UNAVAILABLE = 'unavailable';
    public const RETIRED = 'retired';

    protected static array $activeStates = [self::ACTIVE];

    public function isActive(): bool {
        return in_array($this->value, static::$activeStates);
    }

    public static function getActiveStates(): array {
        return static::$activeStates;
    }

}
