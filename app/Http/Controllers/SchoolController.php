<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\School;

class SchoolController extends Controller
{
    public function index()
    {
        // Logic to retrieve all schools
        $schools = School::all();
        
        // Return the view with the schools data
        return view('schools.index', ['schools' => $schools]);
    }

    public function getSchoolsByType($type)
    {
        // Logic to retrieve schools by type
        $schools = School::where('type', $type)->get();
        
        // Return the view with the filtered schools data
        return view('schools.type', ['schools' => $schools]);
    }

    public function getSchoolsByCategory($type, $category)
    {
        // Logic to retrieve schools by type and category
        $schools = School::where('type', $type)
                         ->where('category', $category)
                         ->get();
        
        // Return the view with the filtered schools data
        return view('schools.category', ['schools' => $schools]);
    }

    public function show($type, $category, $schoolId)
    {
        // Logic to retrieve and show a specific school
        $school = School::findOrFail($schoolId);
        
        // Return the view with the school data
        return view('schools.show', ['school' => $school]);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $schools = School::query();

        if ($search) {
            $schools->where('name', 'like', '%' . $search . '%');
                // ->orWhere('county', 'like', '%' . $search . '%')
                // ->orWhere('boarding_status', 'like', '%' . $search . '%')
                // ->orWhere('gender', 'like', '%' . $search . '%')
                // ->orWhere('capacity', 'like', '%' . $search . '%');
        }

        $schools = $schools->paginate(5);
        $schools->appends(['search' => $search]); // Preserve the search query in the pagination links

        if ($schools->total() == 0) {
            $schools = null;
            $message = 'No records found for the search term: ' . $search;
            return view('admin.admin_schools')->with(['message' => $message, 'schools' => $schools]);
        }

        return view('admin.admin_schools', compact('schools'));
    }
}
