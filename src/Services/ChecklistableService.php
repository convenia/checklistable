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


    public function get($companyId) : Checklist
    {
        $this->checklist = Checklist::query()
            ->where('checklistable', $this->checklistableClass)
            ->where('type', $this->type)
            ->where('company_id', $companyId)
            ->first();

        if ($this->checklist === null) {
            $this->checklist = Checklist::create([
                'answerable' => $this->checklistableClass,
                'type' => $this->type,
                'company_id' => $companyId
            ]);
        }

        return $this->checklist;

    }

    public function questions($companyId = null) : ChecklistableQuestionService
    {

        if ($this->checklist === null && $companyId === null ) {
            throw new DefaultException('Company ID is needed');
        }

        $this->getChecklistIfNot($companyId);
        return new ChecklistableQuestionService($this->checklist);
    }

    public function answers($companyId) : ChecklistableAnswerService
    {
        $this->getChecklistIfNot($companyId);
        return new ChecklistableAnswerService($this->checklist);
    }

    protected function getChecklistIfNot($companyId)
    {
        if ($this->checklist === null) {
            $this->get($companyId);
        }
    }


}