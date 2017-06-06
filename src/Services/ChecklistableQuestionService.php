<?php

namespace Convenia\Checklistable\Services;

use Convenia\Checklistable\Models\ChecklistQuestion;

use Illuminate\Support\Collection;

/**
 * Class ChecklistableQuestionService
 * @package Convenia\Checklistable\Services
 */
class ChecklistableQuestionService
{

    /**
     * @var
     */
    private $checklist;

    /**
     * @var
     */
    public $questions;

    /**
     * ChecklistableQuestionService constructor.
     * @param $checklist
     */
    public function __construct($checklist)
    {
        $this->checklist = $checklist;
    }

    /**
     * @return Collection
     */
    public function get() : Collection
    {
        $this->questions = ChecklistQuestion::query()
            ->where('checklist_id', $this->checklist->id)
            ->get();

        return $this->questions;
    }

    /**
     * @param array $questions
     * @return Collection
     */
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

    /**
     * @param array $question
     * @return Collection
     */
    public function add(Array $question) : Collection
    {
        $question['checklist_id'] = $this->checklist->id;

        ChecklistQuestion::insert($question);

        return $this->get();
    }

    /**
     * @param $questionId
     * @return bool
     */
    public function delete($questionId) : bool
    {
        return ChecklistQuestion::findOrFail($questionId)->delete();
    }


}