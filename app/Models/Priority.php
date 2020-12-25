<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

/**
 * App\Models\Priority
 *
 * @property int $id
 * @property string $title
 * @property string $color
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Priority newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Priority newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Priority query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Priority whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Priority whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Priority whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Priority whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Priority whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Priority whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Priority whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class Priority extends Model
{
    use Userstamps;
    protected $fillable = ['title' , 'color'];
}
