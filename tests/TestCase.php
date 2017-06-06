<?php

namespace Convenia\Checklistable\Tests;

use Convenia\Checklistable\ChecklistableServiceProvider;
use Convenia\Checklistable\Services\ChecklistableService;
use Orchestra\Testbench\TestCase as Orchestra;


class TestCase extends Orchestra
{

    /**
     * @var ChecklistableService
     */
    public $checklistable;

    public function setUp()
    {
        parent::setUp();

        $this->setUpDatabase();
        $this->checklistable = new ChecklistableService('Model\\Class', 'default', 1);
    }


    protected function setUpDatabase()
    {
        include_once __DIR__.'/../src/migrations/2017_05_30_160133_create_checklists_table.php';
        include_once __DIR__.'/../src/migrations/2017_05_30_160212_create_checklist_questions_table.php';
        include_once __DIR__.'/../src/migrations/2017_05_30_160235_create_checklist_answers_table.php';

        (new \CreateChecklistsTable())->up();
        (new \CreateChecklistQuestionsTable())->up();
        (new \CreateChecklistAnswersTable())->up();

    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders()
    {
        return [
            ChecklistableServiceProvider::class,
        ];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $app['config']->set('app.key', '6rE9Nz59bGRbeMATftriyQjrpF7DcOQm');
    }

}