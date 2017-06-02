<?php

namespace Convenia\Checklistable\Models;

use Illuminate\Database\Eloquent\Model;

class ChecklistQuestion extends Model
{

    protected $fillable = ['item', 'checklist_id'];


}