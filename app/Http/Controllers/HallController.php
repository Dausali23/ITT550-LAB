<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use Illuminate\Http\Request;
use DB;

class HallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $halls = Hall::all();
        
        return view('halls.index', compact('halls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('halls.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'lecture_hall_name' => 'required',
            'lecture_hall_place' => 'required', 
        ]);

        Hall::create([
            'lecture_hall_name' => $request->lecture_hall_name,
            'lecture_hall_place' => $request->lecture_hall_place,
        ]);
  
        // User::create($request->all());
   
        return redirect()->route('halls.index')
                        ->with('success','Hall added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function show(Hall $hall)
    {
        return view('halls.show',compact('hall'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function edit(Hall $hall)
    {
        return view('halls.edit',compact('hall'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hall $hall)
    {
        $request->validate([
            'lecture_hall_name' => 'required',
            'lecture_hall_place' => 'required', 
        ]);

        $hall->update([
            'lecture_hall_name' => $request->lecture_hall_name,
            'lecture_hall_place' => $request->lecture_hall_place,
        ]);
  
        // $student->update($request->all());
  
        return redirect()->route('halls.index')
                        ->with('success','Hall updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hall $hall)
    {
        try {
            // First delete related timetables
            DB::table('timetables')->where('hall_id', $hall->id)->delete();
            
            // Then delete the hall
            $hall->delete();
      
            return redirect()->route('halls.index')
                            ->with('success','Hall deleted successfully');
                            
        } catch (\Exception $e) {
            return redirect()->route('halls.index')
                            ->with('error','Cannot delete this hall as it is being used in timetables.');
        }
    }
}