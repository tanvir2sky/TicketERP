<?php

namespace App\Models;

use App\Models\Traits\HasFileTrait;
use App\Models\Traits\HasMultipleFileTrait;
use App\Service\FileUploadService;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Wildside\Userstamps\Userstamps;

/**
 * App\Models\Ticket
 *
 * @property int $id
 * @property int $ticket_category_id
 * @property int|null $user_id
 * @property int $priority_id
 * @property string $name
 * @property string $email
 * @property string|null $mobile
 * @property string $subject
 * @property string $body
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property-read \App\User|null $creator
 * @property-read \App\User $destroyer
 * @property-read \App\User|null $editor
 * @property-read \App\Models\Priority $priority
 * @property-read \App\Models\TicketCategory $ticketCategory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TicketNote[] $ticketNotes
 * @property-read int|null $ticket_notes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TicketReply[] $ticketReplies
 * @property-read int|null $ticket_replies_count
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket wherePriorityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereTicketCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ticket whereUserId($value)
 * @mixin \Eloquent
 */
class Ticket extends Model
{
    use Userstamps;
    use HasMultipleFileTrait;
    use Notifiable;

    const PENDING = "Pending";
    const ONGOING = "On Going";
    const SOLVED = "Solved";
    const CANCELLED = "Cancelled";

    const STATUSES = [self::PENDING,self::ONGOING,self::SOLVED,self::CANCELLED];

    protected $fillable = ['ticket_category_id', 'priority_id','name', 'email', 'mobile', 'subject', 'body'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // auto-sets values on creation
        static::creating(function ($query) {
            $date = Carbon::now()->format('Y-m-d');
            $last = Ticket::whereDate('created_at' , Carbon::now())->count();
            $last = sprintf("%05s", $last + 1);
            $query->ticket_number = $date.'-'.$last;
        });
    }

    /**
     * Get the user of the ticket
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    /**
     * Get the category of the ticket
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticketCategory()
    {
        return $this->belongsTo(TicketCategory::class);
    }

    /**
     * Get the priority of the ticket
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    /**
     * Get all the replies of the ticket
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ticketReplies()
    {
        return $this->hasMany(TicketReply::class);
    }

    /**
     * Get all the notes of the ticket
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ticketNotes()
    {
        return $this->hasMany(TicketNote::class);
    }

}
