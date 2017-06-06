<?php

namespace Convenia\Checklistable\Tests;

use Convenia\Checklistable\Models\Checklist;


class ChecklistableTest extends TestCase
{
    public function test_get()
    {
        $response = $this->checklistable->get();

        $this->assertInstanceOf(Checklist::class, $response);
    }


    public function test_questions()
    {
        $response = $this->checklistable->questions();
        $this->assertInstanceOf(\Convenia\Checklistable\Services\ChecklistableQuestionService::class, $response);
    }

    public function test_answers()
    {
        $response = $this->checklistable->answers();
        $this->assertInstanceOf(\Convenia\Checklistable\Services\ChecklistableAnswerService::class, $response);
    }
}