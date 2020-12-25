<?php

namespace App\Models;

use App\Models\Traits\HasFileTrait;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

/**
 * App\Models\TicketReply
 *
 * @property int $id
 * @property int $ticket_id
 * @property int|null $user_id
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $created_by
 * @property-read \App\Models\Ticket $ticket
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketReply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketReply newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketReply query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketReply whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketReply whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketReply whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketReply whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketReply whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketReply whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketReply whereUserId($value)
 * @mixin \Eloquent
 */
class TicketReply extends Model
{
    use Userstamps;
    use HasFileTrait;

    protected $fillable = ['body'];
    /**
     * Get the ticket of this reply
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
