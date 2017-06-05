<?php

namespace Convenia\Checklistable\Models;

use Illuminate\Database\Eloquent\Model;

class ChecklistQuestion extends Model
{

    protected $fillable = ['question', 'checklist_id'];


}