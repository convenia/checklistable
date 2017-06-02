<?php

namespace Convenia\Checklistable\Tests;

use Convenia\Checklistable\Models\ChecklistQuestion;

class ChecklistableQuestionTest extends TestCase
{
    public function test_get()
    {

        $response = $this->checklistable->questions(1)->get();
        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $response);
    }

    public function test_fill()
    {
        $response = $this->checklistable->questions(1)->fill([['question' => 'test']]);

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $response);
    }


    public function test_add()
    {
        $response = $this->checklistable
            ->questions(1)
            ->add(['question' => 'test']);

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $response);
    }

    public function test_del()
    {
        $this->checklistable
            ->questions(1)
            ->add(['question' => 'test']);

        $response = $this->checklistable
            ->questions(1)
            ->delete(1);

        $this->assertEquals(true, $response);
    }
}