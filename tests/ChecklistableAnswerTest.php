<?php

namespace Convenia\Checklistable\Tests;

class ChecklistableAnswerTest extends TestCase
{
    public function test_start()
    {

        $test = $this
            ->checklistable
            ->questions()
            ->fill([
                ['question' => 'aassdd1'],
                ['question' => 'aassdd2'],
                ['question' => 'aassdd3'],
                ['question' => 'aassdd4'],
            ]);

        $response = $this
            ->checklistable
            ->answers()
            ->start(1);


        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $response);
    }

    public function test_answer()
    {
        $test = $this
            ->checklistable
            ->questions()
            ->fill([
                ['question' => 'aassdd1'],
                ['question' => 'aassdd2'],
                ['question' => 'aassdd3'],
                ['question' => 'aassdd4'],
            ]);

        $response = $this
            ->checklistable
            ->answers()
            ->start(1);

        $response = $this
            ->checklistable
            ->answers()
            ->answer(1, 1, true);

        $this->assertEquals(true, $response);
    }

    public function test_get()
    {
        $test = $this
            ->checklistable
            ->questions()
            ->fill([
                ['question' => 'aassdd1'],
                ['question' => 'aassdd2'],
                ['question' => 'aassdd3'],
                ['question' => 'aassdd4'],
            ]);

        $response = $this
            ->checklistable
            ->answers()
            ->get(1);

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $response);
    }
}