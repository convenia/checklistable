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
     * @param $answarableId
     * @return Collection
     */
   public function start($answarableId) : Collection
   {
       $checkQuestion = new ChecklistableQuestionService($this->checklist);
       $questions = $checkQuestion->get();

       $questions->transform(function($item) use($answarableId) {
           $item['answerable_id'] = $answarableId;
           return $item;
       });

       ChecklistAnswer::insert($questions->toArray());

       return $this->get(1);
   }

   public function answer($answarableId, $answerId, $answer = true) : bool
   {
       $answerMoldel = ChecklistAnswer::findOrFail($answerId);
       $answerMoldel->answer = $answer;
       return $answerMoldel->save();
   }

    public function get($answarableId) : Collection
    {
        $answers = ChecklistAnswer::query()
            ->where('answerable_id', $answarableId)
            ->where('checklist_id', $this->checklist->id)
            ->get();

        if ($answers->count() == 0) {
            return $this->start($answarableId);
        }

        return $answers;
    }
}