<?php

namespace App\Http\Controllers\api\Events;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Factory as ValidationFactory;
use Validator;

class ManageEventsController extends Controller
{
    public function __construct(ValidationFactory $validationFactory)
    {
        $validationFactory->extend(
            'valid_employee',
            function ($attribute, $value, $parameters) {
                $query = Employee::where('user_id', $value)->where('branch_id', $parameters[0])->first();
                if ($query) {
                    return true;
                }
                return false;
            },
            'Deze medewerker bestaat niet.'
        );
        $validationFactory->extend(
            'event_exists',
            function ($attribute, $value, $parameters) {
                $query = Event::where('id', $value)->where('branch_id', $parameters[0])->first();
                if ($query) {
                    return true;
                }
                return false;
            },
            'Deze medewerker bestaat niet.'
        );
    }

    public function editEvent(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'start' => 'required|date_format:Y-m-d H:i:s',
            'end' => 'required|date_format:Y-m-d H:i:s|after:start',
            'event_id' => 'required|event_exists:'.$user->current_branch_id
        ]);
        if ($validator->fails()) {
            return response()->json([
                'hasErrors' => true,
                'errors' => $validator->errors(),
            ]);
        }

        $event = Event::where('id', $request->input('event_id'))->first();

        $event->update([
           'user_id' => $event->user_id,
           'start' => $request->input('start'),
           'end' => $request->input('end'),
           'active' => false
        ]);

        return response()->json([
            'hasErrors' => false,
            'errors' => [],
            'event' => $event->toArray()
        ]);
    }

    public function activateEvents(Request $request)
    {
        $user = $request->user();

        $start = Carbon::createFromTimestamp($request->input('start'));
        $end = Carbon::createFromTimestamp($request->input('end'));
        $timeDifferenceDays = $end->diffInDays($start);
        if ($timeDifferenceDays > 62) {
            return response()->json([
                'hasErrors' => true,
                'errors' => [
                    'time' => 'Tijdsverschil mag niet meer zijn dan 62 dagen'
                ]
            ], 500);
        }

        Event::select('events.id')
            ->where('branch_id', $user->current_branch_id)
            ->whereBetween('start', array($start, $end))
            ->where('removed', 1)->delete();

        Event::select('user_id', 'branch_id', 'start', 'end', 'events.id as event_id', 'events.active')
            ->where('branch_id', $user->current_branch_id)
            ->whereBetween('start', array($start, $end))->update(['active' => true]);

        return response()->json([
           'hasErrors' => false,
           'errors' => [],
        ]);
    }

    public function newEvent(Request $request)
    {
        $user  = $request->user();

        $validator = Validator::make($request->all(), [
            'start' => 'required|date_format:Y-m-d H:i:s',
            'end' => 'required|date_format:Y-m-d H:i:s|after:start',
            'user_id' => 'required|valid_employee:'.$user->current_branch_id,
        ]);
        if ($validator->fails()) {
            return response()->json([
                'hasErrors' => true,
                'errors' => $validator->errors(),
            ]);
        }

        $event = Event::create([
            'start' => $request->input('start'),
            'end' => $request->input('end'),
            'branch_id' => $user->current_branch_id,
            'user_id' => $request->input('user_id'),
            'active' => false
        ]);

        return response()->json([
            'hasErrors' => false,
            'errors' => [],
            'event' => $event->toArray()
        ]);
    }

    public function copyFromLastWeek($start, $end, Request $request)
    {
        $user = $request->user();

        $timeDifferenceDays = Carbon::createFromTimestamp($end)->diffInDays(Carbon::createFromTimestamp($start));
        if ($timeDifferenceDays > 8) {
            return response()->json([
                'hasErrors' => true,
                'errors' => [
                    'time' => 'Tijdsverschil mag niet meer zijn dan 8 dagen'
                ]
            ], 500);
        }

        $thisWeekStart = Carbon::createFromTimestamp($start);
        $thisWeekEnd = Carbon::createFromTimestamp($end);

        // delete possible old events
        Event::where('branch_id', $user->current_branch_id)
            ->where('start', '>=', $thisWeekStart)
            ->where('end', '<=', $thisWeekEnd)->delete();

        $lastWeekStart = Carbon::createFromTimestamp($start)->subDay(7);
        $lastWeekEnd = Carbon::createFromTimestamp($end)->subDay(7);

        $newEvents = Event::select('user_id', 'branch_id', 'start', 'end', 'events.id as event_id', 'events.active')
            ->where('branch_id', $user->current_branch_id)
            ->where('start', '>=', $lastWeekStart)
            ->where('end', '<=', $lastWeekEnd)->get();

        // create new events
        foreach ($newEvents as $event) {
            Event::create([
                'user_id' => $event->user_id,
                'branch_id' => $user->current_branch_id,
                'start' => Carbon::createFromTimestamp(strtotime($event->start))->addDay(7),
                'end' => Carbon::createFromTimestamp(strtotime($event->end))->addDay(7),
                'active' => 0,
            ]);
        }

        return response()->json([
            'hasErrors' => false,
            'errors' => [],
            'duplicatedEvents' => $newEvents->toArray()
        ]);
    }

    public function deleteEventsTimestamp($start, $end, Request $request)
    {
        $user = $request->user();

        $timeDifferenceDays = Carbon::createFromTimestamp($end)->diffInDays(Carbon::createFromTimestamp($start));
        if ($timeDifferenceDays > 8) {
            return response()->json([
                'hasErrors' => true,
                'errors' => [
                    'time' => 'Tijdsverschil mag niet meer zijn dan 8 dagen'
                ]
            ], 500);
        }

        $thisWeekStart = Carbon::createFromTimestamp($start);
        $thisWeekEnd = Carbon::createFromTimestamp($end);

        // delete possible old events
        Event::where('branch_id', $user->current_branch_id)
            ->where('start', '>=', $thisWeekStart)
            ->where('end', '<=', $thisWeekEnd)->delete();

        return response()->json([
            'hasErrors' => false,
            'errors' => [],
        ]);
    }


    public function deleteEvent(Request $request)
    {
        $user  = $request->user();

        $validator = Validator::make($request->all(), [
            'event_id' => 'required|event_exists:'.$user->current_branch_id
        ]);
        if ($validator->fails()) {
            return response()->json([
                'hasErrors' => true,
                'errors' => $validator->errors(),
            ]);
        }

        $event = Event::where('id', $request->input('event_id'))->first();
        $event->delete();

        return response()->json([
            'hasErrors' => false,
            'errors' => []
        ]);
    }
}
