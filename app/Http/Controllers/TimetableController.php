<?php

namespace App\Http\Controllers;

use App\Models\Timetable;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Day;
use App\Models\Hall;
use App\Models\Group;

class TimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $timetables = Timetable::all();
        return view('timetables.index', compact('timetables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $days = Day::pluck('day_name', 'id');
        $halls = Hall::pluck('lecture_hall_name', 'id');
        $subjects = Subject::pluck('subject_name', 'id');
        $groups = Group::pluck('name', 'id');

        return view('timetables.create', compact('days', 'subjects', 'halls', 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'day_id' => 'required|exists:days,id',
            'subject_id' => 'required|exists:subjects,id',
            'hall_id' => 'required|exists:halls,id',
            'group_id' => 'required|exists:groups,id',
            'time_from' => 'required|date_format:H:i',
            'time_to' => 'required|date_format:H:i|after:time_from',
        ]);

        Timetable::create([
            'user_id' => auth()->user()->id,
            'day_id' => $validated['day_id'],
            'subject_id' => $validated['subject_id'],
            'hall_id' => $validated['hall_id'],
            'group_id' => $validated['group_id'],
            'time_from' => $validated['time_from'],
            'time_to' => $validated['time_to'],
        ]);

        return redirect()->route('timetables.index')
            ->with('success','Timetables created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function show(Timetable $timetable)
    {
        return view('timetables.show',compact('timetable'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function edit(Timetable $timetable)
    {
        $days = Day::pluck('day_name', 'id');
        $halls = Hall::pluck('lecture_hall_name', 'id');
        $subjects = Subject::pluck('subject_name', 'id');
        $groups = Group::pluck('name', 'id');
        
        return view('timetables.edit',compact('days', 'subjects', 'halls', 'groups', 'timetable'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timetable $timetable)
    {
        $timetable->update($request->all());

        return redirect()->route('timetables.index')
                        ->with('success','Timetables updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timetable $timetable)
    {
        $timetable->delete();

        return redirect()->route('timetables.index')
                    ->with('success','Timetable deleted successfully');
    }
}