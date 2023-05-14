<?php

namespace Modules\Video\Contracts;

interface VideoState
{
    /**
     * Returns whether the state represents an active state
     *
     * @return boolean
     */
    public function isActive(): bool;

    /**
     * Returns an array of states that represent an active product state
     *
     * @return array
     */
    public static function getActiveStates(): array;
}