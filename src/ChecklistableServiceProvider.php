<?php

namespace Convenia\Checklistable;

use Illuminate\Support\ServiceProvider;

class ChecklistableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->getMigrations() as $migration) {
            $this->publishes([
                __DIR__.'/migrations/'
                .$migration.'.php' => database_path('migrations/'.date('Y_m_d_His', time()).'_'.$migration.'.php'),
            ], 'migrations');
        }
    }

    /**
     * @return array
     */
    protected function getMigrations()
    {
        return [
            'create_checklists_table',
            'create_checklist_questions_table',
            'create_checklist_answers_table'
        ];
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
