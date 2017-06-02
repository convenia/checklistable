<?php

namespace Convenia\Checklistable\Traits;

use Convenia\Checklistable\Services\ChecklistableService;

class ChecklistableTrait
{

    public function checklist($type)
    {
        return new ChecklistableService(get_class($this), $type);
    }
}