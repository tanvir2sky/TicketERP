<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Faq extends Model
{
    use Userstamps;
    protected $fillable = ['title' , 'description'];
}
