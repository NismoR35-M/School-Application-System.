<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <label for="first_name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">First Name</label>
                    <input type="text" id="first_name" name="first_name" value="{{ $user->first_name }}" disabled class="mt-1 p-2 border border-gray-300 rounded-md w-full bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300 focus:outline-none focus:border-indigo-500">
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <label for="middle_name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Middle Name</label>
                    <input type="text" id="middle_name" name="middle_name" value="{{ $user->middle_name }}" disabled class="mt-1 p-2 border border-gray-300 rounded-md w-full bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300 focus:outline-none focus:border-indigo-500">
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <label for="last_name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Last Name</label>
                    <input type="text" id="last_name" name="last_name" value="{{ $user->last_name }}" disabled class="mt-1 p-2 border border-gray-300 rounded-md w-full bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300 focus:outline-none focus:border-indigo-500">
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" id="email" name="email" value="{{ $user->email }}" disabled class="mt-1 p-2 border border-gray-300 rounded-md w-full bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300 focus:outline-none focus:border-indigo-500">
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <label for="phone_number" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Phone Number</label>
                    <input type="text" id="phone_number" name="phone_number" value="{{ $user->phone_number }}" disabled class="mt-1 p-2 border border-gray-300 rounded-md w-full bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300 focus:outline-none focus:border-indigo-500">
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <label for="gender" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Gender</label>
                    <input type="text" id="gender" name="gender" value="{{ $user->gender }}" disabled class="mt-1 p-2 border border-gray-300 rounded-md w-full bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300 focus:outline-none focus:border-indigo-500">
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <label for="county" class="block font-medium text-sm text-gray-700 dark:text-gray-300">County</label>
                    <input type="text" id="county" name="county" value="{{ $user->county }}" disabled class="mt-1 p-2 border border-gray-300 rounded-md w-full bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300 focus:outline-none focus:border-indigo-500">
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <label for="primary_school" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Primary School</label>
                    <input type="text" id="primary_school" name="primary_school" value="{{ $user->primary_school }}" disabled class="mt-1 p-2 border border-gray-300 rounded-md w-full bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300 focus:outline-none focus:border-indigo-500">
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
