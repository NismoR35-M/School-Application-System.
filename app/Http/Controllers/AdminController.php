<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Models\School;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\View\View;
use AuthenticatesAdmins;

use Spatie\Activitylog\Models\Activity;

class AdminController extends Controller
{
    public function dashboard()
    {
        //Retrieve total number of students
        $totalStudents = User::count();

        //Retrieve the total number of schools
        $totalSchools = School::count();

        // Retrieve the recent students
        $recentStudents = User::orderBy('created_at', 'desc')->take(5)->get();

        //Recent schools
        $topSchools = School::orderBy('created_at', 'desc')->take(5)->get();

        // Retrieve currently logged in admins
        $loggedAdmins = Activity::where('log_name', 'Admin Login')
            ->where('created_at', '>=', now()->subMinutes(config('session.lifetime')))
            ->pluck('causer_id');

            $admins = Admin::whereIn('id', $loggedAdmins)->get();




        // Return the dashboard view with the necessary data
        return view('admin.admin_dashboard', [
        'totalStudents' => $totalStudents,
        'totalSchools' => $totalSchools,
        'recentStudents' => $recentStudents,
        'topSchools' => $topSchools,
        'loggedAdmins' => $admins,
    ]);
    }

    //Register admin
    public function register(Request $request)
    {    

        
        // Validate the registration form data
         $request->validate([
            'first_name' => 'required',
            'middle_name'=> 'required',
            // 'last_name' => 'required',
            'phone_number'=> 'required',
            'email' => 'required|email|unique:admin',
            'password' => 'required|min:8',
        ]);

        // Create a new admin instance
        $admin = Admin::create([
            'first_name' => $request['first_name'],
            'middle_name' => $request['middle_name'],
            // 'last_name' => $request['last_name'],
            'email' => $request['email'],
            'phone_number' => $request['phone_number'],
            'password' => bcrypt($request['password']),
        ]);
                  
        // Redirect to the admin dashboard 
        return redirect()->route('admin.login')->with('success', 'Registration successful');
    }

    //4 registration form
    public function showRegistrationForm()
    {
    return view('admin.admin-register');
    }

    public function showLoginForm()
    {
    return view('admin.admin-login');
    }



// ...

    public function login(Request $request)
    {
        // Validate the login form data
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the admin credentials
        if (Auth::guard('admin')->attempt($validatedData)) {
            // Get the authenticated admin
            $admin = Auth::guard('admin')->user();

            // Store the admin's ID in the session
            Auth::guard('admin')->loginUsingId($admin->id);

            // Log the admin login activity
            activity()
                ->performedOn($admin)
                ->causedBy($admin)
                ->log('Admin Login');

            // Redirect to the admin dashboard or any other desired page
            return redirect()->route('admin.dashboard');
        }

        // Authentication failed, redirect back to the login form with an error message
        return redirect()->back()->withErrors(['message' => 'Invalid credentials']);
    }



    //Logout the admin
    public function logout()
    {
        // Log out the admin
        Auth::guard('admin')->logout();

        // Redirect to the login page or any other desired page
        return redirect()->route('admin.login');
    }

    public function students()
    {
        // Retrieve all students from the database
        $students = User::all();

        // Pass the students data to the view
        return view('admin.students', compact('students'));
    }

    public function schools()
    {
        // Retrieve all schools from the database
        $schools = School::all();

        // Pass the schools data to the view
        return view('admin.schools', compact('schools'));
    }

    public function createSchool()
    {
        // Return the view for creating a new school
        return view('admin.create_school');
    }

    public function storeSchool(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required',
            'county' => 'required',
            'category' => 'required',
            'gender' => 'required',
            'capacity' => 'required|numeric',
            'boarding_status' => 'required',
            'is_active' => 'required',
        ]);

        // Create a new school instance and save it to the database
        School::create($validatedData);

        // Redirect back to the schools list
        return redirect()->route('admin.schools')->with('success', 'School created successfully');
    }

    //upload profile image 
    
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images'), $imageName);

            // Update the admin's profile image in the database if needed
            // ...

            return redirect()->back()->with('success', 'Image uploaded successfully.');
        }

        return redirect()->back()->with('error', 'Failed to upload image.');
    }

    public function adminProf()
    {
        $admin = auth()->guard('admin') -> user();
       
        return view('admin.admin_profile', ['admin' => $admin]);
    }

    
    public function adminUpdate(Request $request, $id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
        // Handle the case when the admin profile is not found
            return redirect()->back()->with('error', 'Admin profile not found.');
        
        }

    // Update the admin's details
    $admin->first_name = $request->input('first_name');
    $admin->middle_name = $request->input('middle_name');
    // $admin->email = $request->input('email');
    $admin->phone_number = $request->input('phone_number');
    // Update other fields as needed

    if ($request->hasFile('profile_picture')) {
        $profilePicture = $request->file('profile_picture');
        $profilePicturePath = $profilePicture->store('profile_pictures', 'public');
        $admin->profile_picture = $profilePicturePath;
    }

    $admin->save();

    return redirect()->back()->with('success', 'Profile updated successfully.');

    }
    
}
