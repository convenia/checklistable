<?php

namespace Convenia\Checklistable\Models;

use Illuminate\Database\Eloquent\Model;

class ChecklistAnswer extends Model
{

    protected $fillable = ['checklist_id', 'question', 'answer', 'checklistable_id'];


}