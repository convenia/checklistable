<?php

namespace Convenia\Checklistable\Traits;

use Convenia\Checklistable\Services\ChecklistableService;

trait ChecklistableTrait
{

    public function checklist($type, $ownerId)
    {
        return new ChecklistableService(get_class($this), $type, $ownerId);
    }
}