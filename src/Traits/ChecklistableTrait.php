<?php

namespace Convenia\Checklistable\Traits;

use Convenia\Checklistable\Services\ChecklistableService;

trait ChecklistableTrait
{

    static function checklist($type, $ownerId)
    {
        return new ChecklistableService(self::class, $type, $ownerId);
    }
}