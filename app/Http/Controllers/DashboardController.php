<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use Illuminate\Support\Facades\Auth;



class DashboardController extends Controller
{
    public function index()
{
    // Retrieve the necessary data for the dashboard
    $schools = $this->getSchoolsByGender(auth()->user()->gender);
    $premierNationalSchools = $this->getPremierNationalSchools(auth()->user()->gender);
    $otherNationalSchools = $this->getOtherNationalSchools(auth()->user()->gender);
    $extraCountySchools = $this->getExtraCountySchools(auth()->user()->gender);
    $districtSchools = $this->getDistrictSchools(auth()->user()->gender);

    // Return the dashboard view with the data
    return view('dashboard', [
        'schools' => $schools,
        'premierNationalSchools' => $premierNationalSchools,
        'otherNationalSchools' => $otherNationalSchools,
        'extraCountySchools' => $extraCountySchools,
        'districtSchools' => $districtSchools,
    ]);
}


    private function getSchoolsByGender($gender)
    {
        // Retrieve the schools based on the given gender
        return School::where('gender', $gender)->get();
    }

    private function getPremierNationalSchools($gender)
    {
        // Retrieve the premier national schools based on the gender
        return School::where('category', 'premier')
            ->where('gender', $gender)
            ->where('is_active', true)
            ->get();
    }

    private function getOtherNationalSchools($gender)
    {
        // Retrieve the other national schools based on the gender
        return School::where('category', 'normal')
            ->where('gender', $gender)
            ->where('is_active', true)
            ->get();
    }

    private function getExtraCountySchools($gender)
    {
        // Retrieve the extra county schools based on the gender
        return School::where('category', 'extra_county')
            ->where('gender', $gender)
            ->where('is_active', true)
            ->get();
    }

    private function getDistrictSchools($gender)
    {
        // Retrieve the district schools based on the gender
        return School::where('category', 'district')
            ->where('gender', $gender)
            ->where('is_active', true)
            ->get();
    }

    //save selected school and ready to send to SelectedSchools page
    
    public function saveSelection(Request $request)
    {
        // Retrieve the selected schools from the form
        $premierSchool = $request->input('premier_school');
        $otherSchool = $request->input('other_school');
        $extraCountySchools = $request->input('extra_county_school', []);
        $districtSchools = $request->input('district_school', []);
    
        // Get the authenticated user
        $user = auth()->user();
    
        // Store the selected schools in the pivot table
        $user->schools()->attach([
            (int) $premierSchool => ['type' => 'premier_school'],
            (int) $otherSchool => ['type' => 'normal_national_school'],
        ]);
    
        foreach ($extraCountySchools as $extraCountySchool) {
            $user->schools()->attach([
                (int) $extraCountySchool => ['type' => 'extra_county_school'],
            ]);
        }
    
        foreach ($districtSchools as $districtSchool) {
            $user->schools()->attach([
                (int) $districtSchool => ['type' => 'district_school'],
            ]);
        }
    
        // Redirect to the selected schools page or perform any other action
        return redirect()->route('selectedSchools');
    }


    public function selectedSchools()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Load the user's selected schools with their types
        $selectedSchools = $user->schools()->withPivot('type')->get();

        // Pass the selected schools to the view
        return view('selected-schools', compact('selectedSchools'));
    }
}
