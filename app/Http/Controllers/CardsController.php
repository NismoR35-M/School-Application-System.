<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\School;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CardsController extends Controller
{
    /**
     * Retrieve all available students from the database.
     *
     * @return \Illuminate\Contracts\View\View
     */

    //All students
    // public function students()
    // {
    //     $users = User::all();

    //     return view('admin.admin_students', compact('users'));
    // }

    //All schools
    // public function schools()
    // {
    //     $schools = School::all();

    //     return view('admin.admin_schools', compact('schools'));
    // }

    //Create student
    public function students()
    {
           $users = User::paginate(2);
           return view('admin.admin_students', compact('users'));
    }

    public function createStudent(Request $request)
        {
            // Validate the request data
            $validatedData = $request->validate([
                'first_name' => 'required',
                'middle_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|min:11',
                'gender' => 'required',
                'county' => 'required',
                'primary_school' => 'required',
                // Add more validation rules for other fields
            ]);
    
            // Create a new student record
            $user = new User();
            $user->first_name = $validatedData['first_name'];
            $user->middle_name = $validatedData['middle_name'];
            $user->last_name = $validatedData['last_name'];
            $user->email = $validatedData['email'];
            $user->phone_number=$request->input('phone_number');
            $user->gender=$request->input('gender');
            $user->county=$request->input('county');
            $user->primary_school=$request->input('primary_school');
            // Set other attributes as needed
            $user->save();
    
            return redirect()->route('admin.admin_students')->with('success', 'Student created successfully');
        }
    
        public function updateStudent(Request $request, $id)
        {
            // Find the student record by ID
            $user = User::findOrFail($id);
    
            // Validate the request data
            $validatedData = $request->validate([
                'first_name' => 'required',
                'middle_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|min:11',
                'gender' => 'required',
                'county' => 'required',
                'primary_school' => 'required',
                // Add more validation rules for other fields
            ]);
    
            // Update the student record
            $user->first_name = $validatedData['first_name'];
            $user->middle_name = $validatedData['middle_name'];
            $user->last_name = $validatedData['last_name'];
            $user->email = $validatedData['email'];
            $user->phone_number=$request->input('phone_number');
            $user->gender=$request->input('gender');
            $user->county=$request->input('county');
            $user->primary_school=$request->input('primary_school');
            // Update other attributes as needed
            $user->save();
    
            return redirect()->route('admin.admin_students')->with('success', 'Student updated successfully');
        }
    
        public function deleteStudent($id)
        {
            // Find the student record by ID
            $user = User::findOrFail($id);
    
            // Delete the student record
            $user->delete();
    
            return redirect()->route('admin.admin_students')->with('success', 'Student deleted successfully');
        }
        //count the number of students
        public function getStudentCount()
        {
            $count = User::count();
            return $count;
        }

            //ALL SCHOOLS
        public function schools()
        {
            $schools = School::paginate(5);
            $schools->onEachSide(3);
            return view('admin.admin_schools', compact('schools'));
        }

        public function createSchool(Request $request)
        {
            // Validate the request data
            $validatedData = $request->validate([
                'name' => 'required',
                'county' => 'required',
                'category' => 'required',
                'capacity' => 'required',
                'gender' => 'required',
                // Add more validation rules for other fields
            ]);
        
            // Create a new school record
            $school = new School();
            $school->name = $validatedData['name'];
            $school->county = $validatedData['county'];
            $school->gender = $request->input('gender');
            $school->category = $request->input('category');
            $school ->capacity = $request ->input('capacity');
            // Set other attributes as needed
            $school->save();
        
            return redirect()->route('admin.schools.update')->with('success', 'School created successfully');
        }

        //show create school form
        public function showCreateSchoolForm()
        {
            return view('admin.create_school');
        }


        public function updateSchool(Request $request, $id)
        {
            // Find the student record by ID
            $school = School::findOrFail($id);

            // Validate the request data
            $validatedData = $request->validate([
                'name' => 'required',
                'county' => 'required',
                'category' => 'required',
                'capacity' => 'required',
                'gender' => 'required',
                // Add more validation rules for other fields
            ]);

            // Update the student record
            $school->name = $validatedData['name'];
            $school->county = $validatedData['county'];
            $school->gender=$request->input('gender');
            $school->county=$request->input('county');
            $school->category=$request->input('category');
            // Update other attributes as needed
            $school->save();

            return redirect()->route('admin.admin_schools')->with('success', 'School updated successfully');
        }

        public function deleteSchool($id)
        {
            // Find the student record by ID
            $school = School::findOrFail($id);

            // Delete the student record
            $school->delete();

            return redirect()->route('admin.admin_schools')->with('success', 'School deleted successfully');
        }
        //count the number of schools
        public function getSchoolCount()
        {
            $count = School::count();
            return $count;
        }

        //Get all the admins
        public function admins()
        {   
            $admins = Admin::paginate(3);
            
            return view('admin.admins', compact('admins'));
        }
        //get number of admins
        public function getAdminCount()
        {
            $count = Admin::count();
            return $count;
        }

        public function schoolSelection(Request $request)
        {
            $searchTerm = $request->input('search');
            
            $users_schools = User::with('schools')
                ->when($searchTerm, function ($query) use ($searchTerm) {
                    $query->whereHas('schools', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', '%' . $searchTerm . '%');
                    });
                })
                ->paginate(5);
            
            return view('admin.admin_school_selection', compact('users_schools'));
        }

        //get number of school selection
        public function getSchoolSelectionCount()
        {
            $studentCount = User::has('schools')->count();
            return $studentCount;
        }
    
        

}   
