<?php

namespace Convenia\Checklistable\Models;

use \Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{

    protected $fillable = ['company_id', 'type', 'answerable'];


}