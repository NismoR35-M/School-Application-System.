<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

        <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
    
                <div class="flex justify-center">
                    <form class="pl-6 pr-4"  action="{{ route('saveSelection') }}" method="POST">
                        @csrf
                        <div>
                            <label for="national_school" class="block font-semibold p-4 text-gray-700">{{ __('National Schools') }}</label>
    
                            <div class="flex">
                                <div class="w-1/2 p-4">
                                    <label for="premier_school" class="block font-medium text-gray-700">{{ __('Premier National School') }}</label>
                                    <select id="premier_school" name="premier_school" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-500 focus:outline-none" required autocomplete="premier_school">
                                        <option value="">Select a Premier National School</option>
                                        @isset($premierNationalSchools) 
                                            @foreach ($premierNationalSchools as $school)
                                                <option value="{{ $school->id }}">{{ $school->name }}</option>
                                            @endforeach
                                        @endisset    
                                    </select>
                                    <!-- Add any necessary error handling for premier_school -->
                                </div>
                                <div class="w-1/2 p-4">
                                    <label for="other_school" class="block font-medium text-gray-700">{{ __('Other National School') }}</label>
                                    <select id="other_school" name="other_school" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-500 focus:outline-none" required autocomplete="other_school">
                                        <option value="">Select a Normal National school</option>
                                        @isset($otherNationalSchools)
                                            @foreach ($otherNationalSchools as $school)
                                                <option value="{{ $school->id }}">{{ $school->name }}</option>
                                            @endforeach
                                        @endisset    
                                    </select>
                                    <!-- Add any necessary error handling for other_school -->
                                </div>
                            </div>
                        </div>
    
                        <div class="mt-8">
                            <div class="font-semibold text-gray-700">{{ __('Extra County School') }}</div>
    
                            <div id="extra-county-wrapper">
                                <div class="mt-4 extra-county">
                                    <select name="extra_county_school[]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-500 focus:outline-none" required autocomplete="extra_county_school">
                                        <option value="">Select Extra-County school</option>
                                        @isset($extraCountySchools)
                                            @foreach ($extraCountySchools as $school)
                                                <option value="{{ $school->id }}">{{ $school->name }}</option>
                                             @endforeach
                                        @endisset     
                                    </select>
                                    <!-- Add any necessary error handling for extra_county_school[] -->
                                </div>
                                <div>
                                    <button id="add-extra-county" class="mt-4 px-4 py-2 text-sm font-medium text-gray-800 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring focus:ring-gray-300">Add Extra County School</button>
                                </div>
                            </div>
                        </div>
    
                        <div class="mt-8">
                            <div class="font-semibold text-gray-700">{{ __('District School') }}</div>
    
                            <div id="district-school-wrapper">
                                <div class="mt-4 district-school">
                                    <select name="district_school[]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-500 focus:outline-none" required autocomplete="district_school">
                                        <option value="">Select District School</option>
                                        @isset($districtSchools)
                                            @foreach ($districtSchools as $school)
                                                <option value="{{ $school->id }}">{{ $school->name }}</option>
                                            @endforeach
                                        @endisset    
                                    </select>
                                    <!-- Add any necessary error handling for district_school[] -->
                                </div>
                                <div>
                                    <button id="add-district-school" class="mt-4 px-4 py-2 text-sm font-medium text-gray-800 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring focus:ring-gray-300">Add District School</button>
                                </div>
                            </div>
                        </div>
    
                        <!-- Add hidden input fields for selected schools -->
                        <input type="hidden" name="selected_schools[premier_school][]" id="selected-premier-schools">
                        <input type="hidden" name="selected_schools[district_school][]" id="selected-district-schools">
                        <input type="hidden" name="selected_schools[extra_county_school][]" id="selected-extra-county-schools">

    
                        <div class="mt-12">
                            <x-primary-button>{{ __('Submit') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // JavaScript code for adding extra county schools dynamically
        const extraCountyWrapper = document.getElementById('extra-county-wrapper');
        const addExtraCountyBtn = document.getElementById('add-extra-county');
        let extraCountyCounter = 1;
    
        addExtraCountyBtn.addEventListener('click', () => {
            const newExtraCountyDiv = document.createElement('div');
            newExtraCountyDiv.classList.add('mt-4', 'extra-county');
            newExtraCountyDiv.innerHTML = `
                <select name="extra_county_school[]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-500 focus:outline-none" required autocomplete="extra_county_school">
                    <option value="">Select Extra-County school</option>
                    @isset($extraCountySchools)
                        @foreach ($extraCountySchools as $school)
                            <option value="{{ $school->id }}">{{ $school->name }}</option>
                        @endforeach
                    @endisset    
                </select>
                <!-- Add any necessary error handling for extra_county_school[] -->
            `;
            extraCountyWrapper.appendChild(newExtraCountyDiv);
            extraCountyCounter++;
    
            if (extraCountyCounter === 3) {
                addExtraCountyBtn.style.display = 'none';
            }
        });
    
        // JavaScript code for adding district schools dynamically
        const districtSchoolWrapper = document.getElementById('district-school-wrapper');
        const addDistrictSchoolBtn = document.getElementById('add-district-school');
        let districtSchoolCounter = 1;
    
        addDistrictSchoolBtn.addEventListener('click', () => {
            const newDistrictSchoolDiv = document.createElement('div');
            newDistrictSchoolDiv.classList.add('mt-4', 'district-school');
            newDistrictSchoolDiv.innerHTML = `
                <select name="district_school[]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-500 focus:outline-none" required autocomplete="district_school">
                    <option value="">Select District School</option>
                    @isset($districtSchools)
                        @foreach ($districtSchools as $school)
                            <option value="{{ $school->id }}">{{ $school->name }}</option>
                        @endforeach
                    @endisset    
                </select>
                <!-- Add any necessary error handling for district_school[] -->
            `;
            districtSchoolWrapper.appendChild(newDistrictSchoolDiv);
            districtSchoolCounter++;
    
            if (districtSchoolCounter === 2) {
                addDistrictSchoolBtn.style.display = 'none';
            }
        });
    
        // JavaScript code for updating hidden input fields with selected schools
        const premierSchoolSelect = document.getElementById('premier_school');
        const districtSchoolSelects = document.querySelectorAll('select[name="district_school[]"]');
        const extraCountySchoolSelects = document.querySelectorAll('select[name="extra_county_school[]"]');
        const selectedPremierSchoolsInput = document.getElementById('selected-premier-schools');
        const selectedDistrictSchoolsInput = document.getElementById('selected-district-schools');
        const selectedExtraCountySchoolsInput = document.getElementById('selected-extra-county-schools');
    
        premierSchoolSelect.addEventListener('change', () => {
            selectedPremierSchoolsInput.value = premierSchoolSelect.value;
        });
    
        districtSchoolSelects.forEach(select => {
            select.addEventListener('change', () => {
                const selectedDistrictSchools = Array.from(districtSchoolSelects).map(select => select.value);
                selectedDistrictSchoolsInput.value = JSON.stringify(selectedDistrictSchools.filter(value => value !== ''));
            });
        });
    
        extraCountySchoolSelects.forEach(select => {
            select.addEventListener('change', () => {
                const selectedExtraCountySchools = Array.from(extraCountySchoolSelects).map(select => select.value);
                selectedExtraCountySchoolsInput.value = JSON.stringify(selectedExtraCountySchools.filter(value => value !== ''));
            });
        });
    </script>

</x-app-layout>
