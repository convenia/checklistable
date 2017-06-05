<?php

namespace Convenia\Checklistable\Services;

use Convenia\Checklistable\Models\Checklist;
use Convenia\Checklistable\Models\ChecklistAnswer;
use Illuminate\Support\Collection;

class ChecklistableAnswerService
{

    /**
     * @var Checklist
     */
    private $checklist;

    /**
     * ChecklistableAnswerService constructor.
     * @param Checklist $checklist
     */
    public function __construct(Checklist $checklist)
    {
        $this->checklist = $checklist;
    }

    /**
     * @param $checklisableId
     * @return Collection
     */
   public function start($checklisableId) : Collection
   {
       $checkQuestion = new ChecklistableQuestionService($this->checklist);
       $questions = $checkQuestion->get();

       $questions->transform(function($item) use($checklisableId) {
           $item['answerable_id'] = $checklisableId;
           return $item;
       });

       ChecklistAnswer::insert($questions->toArray());

       return $this->get(1);
   }

   public function answer($checklisableId, $answerId, $answer = true) : bool
   {
       $answerMoldel = ChecklistAnswer::findOrFail($answerId);
       $answerMoldel->answer = $answer;
       return $answerMoldel->save();
   }

    public function get($checklisableId) : Collection
    {
        $answers = ChecklistAnswer::query()
            ->where('answerable_id', $checklisableId)
            ->where('checklist_id', $this->checklist->id)
            ->get();

        if ($answers->count() == 0) {
            return $this->start($checklisableId);
        }

        return $answers;
    }
}