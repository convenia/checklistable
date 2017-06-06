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
     * @var
     */
    protected $ownerId;

    /**
     * ChecklistableService constructor.
     * @param $checklistableClass
     * @param $type
     * @param $ownerId
     */

    function __construct($checklistableClass, $type, $ownerId)
    {
        $this->type = $type;
        $this->checklistableClass = $checklistableClass;
        $this->ownerId = $ownerId;
    }


    public function get() : Checklist
    {
        $this->checklist = Checklist::query()
            ->where('checklistable', $this->checklistableClass)
            ->where('type', $this->type)
            ->where('company_id', $this->ownerId)
            ->first();

        if ($this->checklist === null) {
            $this->checklist = Checklist::create([
                'answerable' => $this->checklistableClass,
                'type' => $this->type,
                'company_id' => $this->ownerId
            ]);
        }

        return $this->checklist;

    }

    public function questions() : ChecklistableQuestionService
    {
        $this->getChecklistIfNot();
        return new ChecklistableQuestionService($this->checklist);
    }

    public function answers() : ChecklistableAnswerService
    {
        $this->getChecklistIfNot();
        return new ChecklistableAnswerService($this->checklist);
    }

    protected function getChecklistIfNot()
    {
        if ($this->checklist === null) {
            $this->get();
        }
    }


}