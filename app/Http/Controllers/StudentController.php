<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DB;
use Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::all();
        
        if (!View::exists('students.index')) {
            dd('View file not found at: ' . resource_path('views/students/index.blade.php'));
        }
        
        return view('students.index', compact('students'));
    }

    public function create()
    {
        if (!View::exists('students.create')) {
            dd('View file not found at: ' . resource_path('views/students/create.blade.php'));
        }
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'password' => $request->password,
            'email' => $request->email,
     
        ]);
  
        // User::create($request->all());
   
        return redirect()->route('students.index')
                        ->with('success','Student created successfully.');
    }
    
    public function show(User $student)
    {
        return view('students.show',compact('student'));
    }

    public function edit(User $student)
    {
        return view('students.edit',compact('student'));
    }

    public function update(Request $request, User $student)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        DB::table('users')->where('id',$request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
  
        // $student->update($request->all());
  
        return redirect()->route('students.index')
                        ->with('success','Student updated successfully');
    }

    public function destroy(User $student)
    {
        $student->delete();
  
        return redirect()->route('students.index')
                        ->with('success','Student deleted successfully');
    }
}