<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use DB;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        
        return view('subjects.index', compact('subjects'));
    }

     public function create()
    {
        return view('subjects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject_code' => 'required',
            'subject_name' => 'required',
            
        ]);

        Subject::create([
            'subject_code' => $request->subject_code,
            'subject_name' => $request->subject_name,
        ]);

        return redirect()->route('subjects.index')
                        ->with('success','Subject added successfully.');
    }

    public function show(Subject $subject)
    {
        return view('subjects.show',compact('subject'));
    }

    public function edit(Subject $subject)
    {
        return view('subjects.edit',compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'subject_code' => 'required',
            'subject_name' => 'required',
        ]);

        $subject->update([
            'subject_code' => $request->subject_code,
            'subject_name' => $request->subject_name,
        ]);

        return redirect()->route('subjects.index')
                        ->with('success','Subject updated successfully');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
  
        return redirect()->route('subjects.index')
        
                        ->with('success','Subject deleted successfully');
    }
}