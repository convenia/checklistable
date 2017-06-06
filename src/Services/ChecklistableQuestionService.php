<?php

namespace Convenia\Checklistable\Services;

use Convenia\Checklistable\Models\ChecklistQuestion;

use Illuminate\Support\Collection;

class ChecklistableQuestionService
{

    private $checklist;

    public $questions;

    public function __construct($checklist)
    {
        $this->checklist = $checklist;
    }

    public function get() : Collection
    {
        $this->questions = ChecklistQuestion::query()
            ->where('checklist_id', $this->checklist->id)
            ->get();

        return $this->questions;
    }


    public function fill(Array $questions) : Collection
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

    public function add(Array $question) : Collection
    {
        $question['checklist_id'] = $this->checklist->id;

        ChecklistQuestion::insert($question);

        return $this->get();
    }

    public function delete($questionId) : bool
    {
        return ChecklistQuestion::findOrFail($questionId)->delete();
    }


}