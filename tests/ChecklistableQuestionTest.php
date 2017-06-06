<?php

namespace Convenia\Checklistable\Tests;

use Convenia\Checklistable\Models\ChecklistQuestion;

class ChecklistableQuestionTest extends TestCase
{
    public function test_get()
    {

        $response = $this->checklistable->questions()->get();
        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $response);
    }

    public function test_fill()
    {
        $response = $this->checklistable->questions()->fill([['question' => 'test']]);

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $response);
    }


    public function test_add()
    {
        $response = $this->checklistable
            ->questions()
            ->add(['question' => 'test']);

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $response);
    }

    public function test_del()
    {
        $this->checklistable
            ->questions()
            ->add(['question' => 'test']);

        $response = $this->checklistable
            ->questions()
            ->delete(1);

        $this->assertEquals(true, $response);
    }
}