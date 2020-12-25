<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

/**
 * App\Models\TicketCategory
 *
 * @property int $id
 * @property string $title
 * @property string $display_title
 * @property string $color
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketCategory whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketCategory whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketCategory whereDisplayTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketCategory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketCategory whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketCategory whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class TicketCategory extends Model
{
    use Userstamps;


    protected $fillable = ['title'];

}
