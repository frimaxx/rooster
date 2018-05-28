<?php

namespace App\Http\Controllers\api\Events;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class RetrieveEventsController extends Controller
{

    public function getBranchEventsTimestamp($start, $end, Request $request, Branch $branch)
    {
        $user = $request->user();

        $start = Carbon::createFromTimestamp($start);
        $end = Carbon::createFromTimestamp($end);

        $timeDifferenceDays = $end->diffInDays($start);
        if ($timeDifferenceDays > 62) {
            return response()->json([
                'hasErrors' => true,
                'errors' => [
                    'time' => 'Tijdsverschil mag niet meer zijn dan 62 dagen'
                ]
            ], 502);
        }

        $events = Event::select('users.name', 'users.name as title', 'branches.name as branch_name', 'user_id', 'branch_id', 'start', 'end', 'events.id as event_id', 'events.active')
            ->join('users', 'users.id', '=', 'events.user_id')
            ->join('branches', 'branches.id', '=', 'events.branch_id')
            ->where('branch_id', $user->current_branch_id)
            ->where('events.start', '>=', $start)
            ->where('events.end', '<=', $end);

        if ($request->input('active') == true) {
            $events = $events->where('events.active', 1);
        }

        if ($request->input('order') == 'name') {
            $events = $events->orderBy('users.name', 'asc');
        }
        $events = $events->orderBy('events.start', 'asc')->get();

        $userIdsArray = $events->pluck('user_id');
        $users = $branch->getEmployees($user->current_branch_id)->whereNotIn('users.id', $userIdsArray)->get()->toArray();

        $eventsArray = $events->toArray();

        return response()->json([
           'hasErrors' => false,
           'errors' => [],
           'unPlannedUsers' => $users,
           'events' => $eventsArray,
        ]);
    }

    public function getUserEventsTimestamp($start, $end, Request $request)
    {
        $user = $request->user();

        $start = Carbon::createFromTimestamp($start);
        $end = Carbon::createFromTimestamp($end);

        $timeDifferenceDays = $end->diffInDays($start);
        if ($timeDifferenceDays > 62) {
            return response()->json([
                'hasErrors' => true,
                'errors' => [
                    'time' => 'Tijdsverschil mag niet meer zijn dan 62 dagen'
                ]
            ], 502);
        }

        $events = Event::select('users.name', 'users.name as title', 'branches.name as branch_name', 'user_id', 'branch_id', 'start', 'end', 'events.id as event_id', 'events.active')
            ->join('users', 'users.id', '=', 'events.user_id')
            ->join('branches', 'branches.id', '=', 'events.branch_id')
            ->where('user_id', $user->id)
            ->where('events.start', '>=', $start)
            ->where('events.end', '<=', $end)
            ->orderBy('events.start', 'asc')->get();

        return response()->json([
            'hasErrors' => false,
            'errors' => [],
            'events' => $events->toArray()
        ]);
    }

}
