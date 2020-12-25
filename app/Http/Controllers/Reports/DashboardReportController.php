<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardReportController extends Controller
{
    private $intervals;
    private $interval_hour;
    private $today;

    public function __construct()
    {
        $this->today = Carbon::now()->startOfDay();
        $this->interval_hour = 3;
        $this->intervals = [];
        $this->generateIntervals();
    }

    public function index()
    {
        $opened = $this->generateTodayTicketsGraph();
        $closed = $this->generateTodayTicketsGraph(1);
        $new_tickets = Ticket::where('status' , Ticket::PENDING)
            ->whereNull('user_id')
            ->latest()
            ->get();
        $assigned_tickets = Ticket::whereNotNull('user_id')
            ->where('status' , [Ticket::ONGOING ,Ticket::PENDING])
            ->count();
        $closed_tickets = Ticket::whereIn('status' , [Ticket::SOLVED])->latest()->get();
        $today_total_tickets = Ticket::where('created_at' , '>=' ,Carbon::today())->count();

        return response()->json([
            'new_tickets' => $new_tickets->count(),
            'assigned_tickets' => $assigned_tickets,
            'closed_tickets' => $closed_tickets->count(),
            'today_total_tickets' => $today_total_tickets,
            'opened_graph' => $opened,
            'closed_graph' => $closed,
            'last_opened' => ($new_tickets->first()) ? Carbon::parse($new_tickets->first()->created_at)
                ->diffForHumans() : '',
            'last_closed' => ($closed_tickets->first()) ? Carbon::parse($closed_tickets->first()->updated_at)
                ->diffForHumans() : '',
        ]);
    }

    protected function generateIntervals()
    {
        for ($i = 1 ; $i <= 24 / $this->interval_hour ; $i++){
            array_push($this->intervals, $this->today->copy()->addHours($this->interval_hour * $i));
        }
        $this->intervals[24 / $this->interval_hour - 1]->subSecond();
    }

    protected function generateTodayTicketsGraph($status = null)
    {
        $column = 'created_at';
        if($status){
            $column = 'updated_at';
        }

        $today_open_tickets = Ticket::where($column ,'>=' , Carbon::today())->get();
        if($status){
            $today_open_tickets = $today_open_tickets->whereIn('status' , [Ticket::SOLVED , Ticket::CANCELLED]);
        }
        $labels = [];
        $ticket_counts = [];

        foreach ($this->intervals as $interval){
            $counted_tickets = $today_open_tickets
                ->whereBetween($column , [$interval->copy()->subHours($this->interval_hour) , $interval])
                ->count();
            array_push($labels , $interval->format('ga'));
            array_push($ticket_counts , $counted_tickets);
        }
        return [
            "labels" => $labels,
            "value" => $ticket_counts
        ];
    }
}
