<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        // Retrieve all students from the database
        $students = Users::all();
        
        // Return the view with the student data
        return view('students.index', compact('students'));
    }

    public function create()
    {
        // Return the view for creating a new student
        return view('students.create');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            // Add validation rules for each input field
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            // Add more validation rules as needed
        ]);

        // Create a new student instance with the validated data
        $student = Student::create($validatedData);

        // Redirect to the student's show page
        return redirect()->route('students.show', $student->id);
    }

    public function show($id)
    {
        // Find the student by ID
        $student = Student::findOrFail($id);
        
        // Return the view with the student data
        return view('students.show', compact('student'));
    }

    public function edit($id)
    {
        // Find the student by ID
        $student = Student::findOrFail($id);
        
        // Return the view for editing the student
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        // Find the student by ID
        $student = Student::findOrFail($id);

        // Validate the form data
        $validatedData = $request->validate([
            // Add validation rules for each input field
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            // Add more validation rules as needed
        ]);

        // Update the student's data with the validated data
        $student->update($validatedData);

        // Redirect to the student's show page
        return redirect()->route('students.show', $student->id);
    }

    public function destroy($id)
    {
        // Find the student by ID and delete it
        Student::findOrFail($id)->delete();

        // Redirect to the students index page
        return redirect()->route('students.index');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $users = User::query();

        if ($search) {
            $users->where('first_name', 'like', '%' . $search . '%')
                ->orWhere('middle_name', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%');
                // ->orWhere('county', 'like', '%' . $search . '%')
                // ->orWhere('boarding_status', 'like', '%' . $search . '%')
                // ->orWhere('gender', 'like', '%' . $search . '%');
                
        }

        $users = $users->paginate(5);
        $users->appends(['search' => $search]); // Preserve the search query in the pagination links

        if ($users->total() == 0) {
            $users = null;
            $message = 'No records found for the search term: ' . $search;
            return view('admin.admin_students')->with(['message' => $message, 'users' => $users]);
        }

        return view('admin.admin_students', compact('users'));
    }
}
