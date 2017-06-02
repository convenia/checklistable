<?php

namespace Convenia\Checklistable\Services;

use Convenia\Checklistable\Models\ChecklistQuestion;

class ChecklistableQuestionService
{

    private $checklist;

    public $questions;

    public function __construct($checklist)
    {
        $this->checklist = $checklist;
    }

    public function get()
    {
        $this->questions = ChecklistQuestion::query()
            ->where('checklist_id', $this->checklist->id)
            ->get();

        return $this->questions;
    }


    public function fill(Array $questions)
    {
        $oldQuestions = $this->get();

        if ($oldQuestions->count() > 0) {
            return $oldQuestions;
        }

        $questions = collect($questions)->transform(function ($item) {
            $item['checklist_id'] = $this->checklist->id;
            return $item;
        })->toArray();


        ChecklistQuestion::insert($questions);

        return $this->get();
    }

    public function add(Array $question)
    {
        $question['checklist_id'] = $this->checklist->id;

        ChecklistQuestion::insert($question);

        return $this->get();
    }

    public function delete($questionId)
    {
        return ChecklistQuestion::query()->delete($questionId);
    }


}