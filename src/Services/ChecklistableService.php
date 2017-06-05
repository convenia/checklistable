<?php

namespace Convenia\Checklistable\Services;

use App\Exceptions\DefaultException;
use Convenia\Checklistable\Models\Checklist;
use Convenia\Checklistable\Models\ChecklistQuestion;
use Illuminate\Support\Collection;

class ChecklistableService
{

    /**
     * @var String
     */
    protected $type;

    /**
     * @var Checklist
     */
    protected $checklist = null;

    /**
     * @var String
     */
    protected $checklistableClass;

    /**
     * ChecklistableService constructor.
     * @param $checklistableClass String [Model Class to associate checklist]
     * @param $type [type or name]
     */

    function __construct($checklistableClass, $type)
    {
        $this->type = $type;
        $this->checklistableClass = $checklistableClass;
    }


    public function get($ownerId) : Checklist
    {
        $this->checklist = Checklist::query()
            ->where('checklistable', $this->checklistableClass)
            ->where('type', $this->type)
            ->where('owner_id', $ownerId)
            ->first();

        if ($this->checklist === null) {
            $this->checklist = Checklist::create([
                'answerable' => $this->checklistableClass,
                'type' => $this->type,
                'owner_id' => $ownerId
            ]);
        }

        return $this->checklist;

    }

    public function questions($ownerId = null) : ChecklistableQuestionService
    {

        if ($this->checklist === null && $ownerId === null ) {
            throw new \Exception('owner ID is needed');
        }

        $this->getChecklistIfNot($ownerId);
        return new ChecklistableQuestionService($this->checklist);
    }

    public function answers($ownerId) : ChecklistableAnswerService
    {
        $this->getChecklistIfNot($ownerId);
        return new ChecklistableAnswerService($this->checklist);
    }

    protected function getChecklistIfNot($ownerId)
    {
        if ($this->checklist === null) {
            $this->get($ownerId);
        }
    }


}