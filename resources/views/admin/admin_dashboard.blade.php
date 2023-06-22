@extends('layouts.app-admin')

@php
    $studentCount = app('App\Http\Controllers\CardsController')->getStudentCount();
    $schoolCount = app('App\Http\Controllers\CardsController')->getSchoolCount();
    $adminCount = app('App\Http\Controllers\CardsController')->getAdminCount();
    $schoolSelectionCount = app('App\Http\Controllers\CardsController')->getSchoolSelectionCount();
@endphp

@section('content')
            <!-- content starts here -->
            <div class="cards">

                            <!-- card STUDENTS -->
                            <a href="{{ route('admin.students') }}">
                    <div class="card card-1">
                        <div class="card--title">
                            <span class="card--icon icon"><i class="fa-solid fa-people-group"></i></span>
                            <span>Students</span>
                        </div>
                        <h3 class="card--value">{{ $studentCount }} <i class="ri-arrow-up-circle-fill up"></i></h3>
                        <h5 class="more"></h5>
                        <div class="chart">
                            <canvas id="sales"></canvas>
                        </div>
                    </div>
                </a>
 

              <!-- card FOR SCHOOLS -->
              <a href="{{ route('admin.schools') }}">
                <div class="card card-2">
                    <div class="card--title">
                        <span class="card--icon icon"><i class="fa-solid fa-school"></i></span>
                        <span>Schools</span>
                    </div>
                    <h3 class="card--value">{{ $schoolCount }}<i class="ri-arrow-down-circle-fill down"></i></h3>
                    
                    <div class="chart">
                        <canvas id="orders"></canvas>
                    </div>
                </div>
                </a>

                <!-- ADMINS CARDS -->
                <a href="{{ route('admin.admins') }}">
                <div class="card card-3">
                    <div class="card--title">
                        <span class="card--icon icon"><i class="fa-solid fa-crown"></i></span>
                        <span>Admins</span>
                    </div>
                    <h3 class="card--value">{{ $adminCount }}<i class="ri-arrow-up-circle-fill up"></i></h3>
                    
                    <div class="chart">
                        <canvas id="products"></canvas>
                    </div>
                </div>
                </a>

                <!-- card for SCHOOL SELECTION -->
                <a href="{{ route('admin.schoolSelection') }}">
                <div class="card card-4">
                    <div class="card--title">
                        <span class="card--icon icon"><i class="ri-user-line"></i></span>
                        <span>Sellections</span>
                    </div>
                    <h3 class="card--value">{{ $schoolSelectionCount }}<i class="ri-arrow-down-circle-fill down"></i></h3>
                    <div class="chart">
                        <canvas id="customers"></canvas>
                    </div>
                </div>
                </a> 
            </div>
              
            <div class="table">
            <div class="section--title">
                <h3 class="title">Recent Logins</h3>
            </div>
            <table>
    <thead>
        <tr>
            <th>Student name</th>
            <th>User ID</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Gender</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($loggedAdmins as $admin)
            <tr>
                <td>{{ $admin->first_name }}</td>
                <td>#{{ $admin->id }}</td>
                <td>{{ $admin->phone_number }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->gender }}</td>
                <td>
                    <span class="dot green"></span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


        </div>


            <!-- content area ends -->
@endsection