<?php

namespace Convenia\Checklistable\Traits;

use Convenia\Checklistable\Services\ChecklistableService;

/**
 * Trait ChecklistableTrait
 * @package Convenia\Checklistable\Traits
 */
trait ChecklistableTrait
{

    /**
     * @param $type
     * @param $ownerId
     * @return ChecklistableService
     */
    static function checklist($type, $ownerId)
    {
        return new ChecklistableService(self::class, $type, $ownerId);
    }
}