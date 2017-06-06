<?php

namespace Convenia\Checklistable\Models;

use \Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{

    protected $fillable = ['owner_id', 'type', 'checklistable'];


}