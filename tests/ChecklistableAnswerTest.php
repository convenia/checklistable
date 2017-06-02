<?php

namespace Convenia\Checklistable\Tests;

class ChecklistableAnswerTest extends TestCase
{
    public function test_start()
    {

        $test = $this
            ->checklistable
            ->questions(1)
            ->fill([
                ['question' => 'aassdd1'],
                ['question' => 'aassdd2'],
                ['question' => 'aassdd3'],
                ['question' => 'aassdd4'],
            ]);

        $response = $this
            ->checklistable
            ->answers(1)
            ->start(1);


        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $response);
    }

    public function test_answer()
    {
        $test = $this
            ->checklistable
            ->questions(1)
            ->fill([
                ['question' => 'aassdd1'],
                ['question' => 'aassdd2'],
                ['question' => 'aassdd3'],
                ['question' => 'aassdd4'],
            ]);

        $response = $this
            ->checklistable
            ->answers(1)
            ->start(1);

        $response = $this
            ->checklistable
            ->answers(1)
            ->answer(1, 1, true);

        $this->assertEquals(true, $response);
    }

    public function test_get()
    {
        $test = $this
            ->checklistable
            ->questions(1)
            ->fill([
                ['question' => 'aassdd1'],
                ['question' => 'aassdd2'],
                ['question' => 'aassdd3'],
                ['question' => 'aassdd4'],
            ]);

        $response = $this
            ->checklistable
            ->answers(1)
            ->get(1);

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $response);
    }
}