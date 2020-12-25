<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TicketNote
 *
 * @property int $id
 * @property int $ticket_id
 * @property int|null $user_id
 * @property string $body
 * @property string $color
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property-read \App\Models\Ticket $ticket
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketNote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketNote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketNote query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketNote whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketNote whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketNote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketNote whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketNote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketNote whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketNote whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketNote whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TicketNote whereUserId($value)
 * @mixin \Eloquent
 */
class TicketNote extends Model
{
    /**
     * Get the ticket of the note
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
