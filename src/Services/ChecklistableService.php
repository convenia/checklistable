<?php

namespace Convenia\Checklistable\Services;

use App\Exceptions\DefaultException;
use Convenia\Checklistable\Models\Checklist;
use Convenia\Checklistable\Models\ChecklistQuestion;
use Illuminate\Support\Collection;

/**
 * Class ChecklistableService
 * @package Convenia\Checklistable\Services
 */
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

    /**
     * @return Checklist
     */
    public function get() : Checklist
    {
        $this->checklist = Checklist::query()
            ->where('checklistable', $this->checklistableClass)
            ->where('type', $this->type)
            ->where('owner_id', $this->ownerId)
            ->first();

        if ($this->checklist === null) {
            $this->checklist = Checklist::create([
                'checklistable' => $this->checklistableClass,
                'type' => $this->type,
                'owner_id' => $this->ownerId
            ]);
        }

        return $this->checklist;

    }

    /**
     * @return ChecklistableQuestionService
     */
    public function questions() : ChecklistableQuestionService
    {
        $this->getChecklistIfNot();
        return new ChecklistableQuestionService($this->checklist);
    }

    /**
     * @return ChecklistableAnswerService
     */
    public function answers() : ChecklistableAnswerService
    {
        $this->getChecklistIfNot();
        return new ChecklistableAnswerService($this->checklist);
    }

    /**
     * start checklist if do not have
     */
    protected function getChecklistIfNot()
    {
        if ($this->checklist === null) {
            $this->get();

        }
    }


}